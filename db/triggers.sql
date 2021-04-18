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
