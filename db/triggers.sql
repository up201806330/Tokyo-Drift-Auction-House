DROP TRIGGER IF EXISTS ban_user                 ON "ban";
DROP TRIGGER IF EXISTS private_auction_guests   ON "auction_guest";
DROP TRIGGER IF EXISTS cant_bid_own_auction     ON "bid";
DROP TRIGGER IF EXISTS cant_bid_auction_over    ON "bid";
DROP TRIGGER IF EXISTS only_guests_can_bid      ON "bid";
DROP TRIGGER IF EXISTS banned_bids              ON "ban";
DROP TRIGGER IF EXISTS removed_from_guest_list  ON "auction_guest";


DROP FUNCTION IF EXISTS ban_user               ;
DROP FUNCTION IF EXISTS private_auction_guests ;
DROP FUNCTION IF EXISTS cant_bid_own_auction   ;
DROP FUNCTION IF EXISTS cant_bid_auction_over  ;
DROP FUNCTION IF EXISTS only_guests_can_bid    ;
DROP FUNCTION IF EXISTS banned_bids            ;
DROP FUNCTION IF EXISTS removed_from_guest_list;

CREATE FUNCTION ban_user() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.banType = 'AuctionBan' THEN
        IF NOT EXISTS (
            SELECT * FROM "admin" WHERE "admin".id = NEW.createdBy 
            UNION
            SELECT * FROM "global_mod" WHERE "global_mod".id = NEW.createdBy
            UNION
            SELECT user_id FROM "auction_mod" WHERE NEW.auction_id = "auction_mod".auction_id AND "auction_mod".user_id = NEW.createdBy
        ) THEN
            RAISE EXCEPTION 'User must be banned by Authorised Mod or Admin';
        END IF;
    ELSE
        IF NOT EXISTS (SELECT * FROM "admin" WHERE "admin".id = NEW.createdBy) THEN
            RAISE EXCEPTION 'User must be banned by Admin';
        END IF;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER ban_user
    BEFORE INSERT OR UPDATE ON "ban"
    FOR EACH ROW
    EXECUTE PROCEDURE ban_user(); 



CREATE FUNCTION private_auction_guests() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS(
        SELECT *
        FROM "auction"
        WHERE NEW.auction_id = "auction".id AND "auction".auctionType = 'Private'
    ) THEN
        RAISE EXCEPTION 'Auction is not Private';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER private_auction_guests
    BEFORE INSERT OR UPDATE ON "auction_guest"
    FOR EACH ROW
    EXECUTE PROCEDURE private_auction_guests(); 



CREATE FUNCTION cant_bid_own_auction() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.user_id IN (
        SELECT "vehicle".owner
        FROM "auction"
        JOIN "vehicle" ON "auction".vehicle_id = "vehicle".id
        WHERE "auction".id = NEW.auction_id
    ) THEN
        RAISE EXCEPTION 'Bid cannot be placed by auction owner';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER cant_bid_own_auction
    BEFORE INSERT OR UPDATE ON "bid"
    FOR EACH ROW
    EXECUTE PROCEDURE cant_bid_own_auction();



CREATE FUNCTION cant_bid_auction_over() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.createdOn >= (
        SELECT endingTime
        FROM "auction"
        WHERE id = NEW.auction_id
    ) THEN
        RAISE EXCEPTION 'Bid cannot be placed after auction is over';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER cant_bid_auction_over
    BEFORE INSERT OR UPDATE ON "bid"
    FOR EACH ROW
    EXECUTE PROCEDURE cant_bid_auction_over();



CREATE FUNCTION only_guests_can_bid() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (
        SELECT auctionType
        FROM "auction"
        WHERE id = NEW.auction_id
    ) = 'Private' AND NEW.user_id NOT IN (
        SELECT user_id FROM "auction_guest" WHERE auction_id = NEW.auction_id
    ) THEN
        RAISE EXCEPTION 'Bids can only be placed on private auctions by guests of that auction';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER only_guests_can_bid
    BEFORE INSERT OR UPDATE ON "bid"
    FOR EACH ROW
    EXECUTE PROCEDURE only_guests_can_bid();

CREATE FUNCTION banned_bids() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.banType = 'BuyerBan' OR NEW.banType = 'AllBan' THEN
        DELETE FROM "bid" b
        WHERE b.user = NEW.user;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER banned_bids
    AFTER INSERT OR UPDATE ON "ban"
    FOR EACH ROW
    EXECUTE PROCEDURE banned_bids();

CREATE FUNCTION removed_from_guest_list() RETURNS TRIGGER AS
$BODY$
BEGIN
    DELETE FROM "bid" b
    WHERE 
        b.user = OLD.user AND
        b.auction = OLD.auction;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER removed_from_guest_list
    AFTER DELETE ON "auction_guest"
    FOR EACH ROW
    EXECUTE PROCEDURE removed_from_guest_list();
    