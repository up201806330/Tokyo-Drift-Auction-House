-- Create

DROP DOMAIN IF EXISTS PASTTIMESTAMP     CASCADE;
DROP DOMAIN IF EXISTS FUTURETIMESTAMP   CASCADE;
DROP DOMAIN IF EXISTS EURO_T            CASCADE;
DROP DOMAIN IF EXISTS EMAIL_T           CASCADE;
DROP DOMAIN IF EXISTS VATNUMBER_T       CASCADE;
DROP TYPE   IF EXISTS CONDITION_T       CASCADE;
DROP TYPE   IF EXISTS AUCTIONTYPE_T     CASCADE;
DROP TYPE   IF EXISTS BANTYPE_T         CASCADE;

DROP TABLE IF EXISTS "user"                 CASCADE;
DROP TABLE IF EXISTS "global_mod"           CASCADE;
DROP TABLE IF EXISTS "admin"                CASCADE;
DROP TABLE IF EXISTS "seller"               CASCADE;
DROP TABLE IF EXISTS "vehicle"              CASCADE;
DROP TABLE IF EXISTS "auction"              CASCADE;
DROP TABLE IF EXISTS "auction_mod"          CASCADE;
DROP TABLE IF EXISTS "image"                CASCADE;
DROP TABLE IF EXISTS "invoice"              CASCADE;
DROP TABLE IF EXISTS "vehicle_image"        CASCADE;
DROP TABLE IF EXISTS "auction_user"         CASCADE;
DROP TABLE IF EXISTS "favourite_auction"    CASCADE;
DROP TABLE IF EXISTS "comment"              CASCADE;
DROP TABLE IF EXISTS "ban"                  CASCADE;
DROP TABLE IF EXISTS "bid"                  CASCADE;

CREATE DOMAIN   PASTTIMESTAMP   AS TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK(VALUE <= CURRENT_TIMESTAMP);
CREATE DOMAIN   FUTURETIMESTAMP AS TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP;
CREATE DOMAIN   EURO_T          AS NUMERIC(17, 2) NOT NULL;
CREATE DOMAIN   EMAIL_T         AS TEXT         CHECK(VALUE LIKE '_%@_%.__%');
CREATE DOMAIN   VATNUMBER_T     AS CHAR(16);
CREATE TYPE     CONDITION_T     AS ENUM ('Mint', 'Clean', 'Average', 'Rough');
CREATE TYPE     AUCTIONTYPE_T   AS ENUM ('Public', 'Private');
CREATE TYPE     BANTYPE_T       AS ENUM ('BuyerBan', 'SellerBan', 'AllBan', 'AuctionBan');

CREATE TABLE image (
    id      SERIAL  PRIMARY KEY,
    path    TEXT    NOT NULL
);

CREATE TABLE "user" (
    id              SERIAL          PRIMARY KEY,
    firstName       TEXT            NOT NULL,
    lastName        TEXT            NOT NULL,
    email           EMAIL_T         NOT NULL UNIQUE,
    username        TEXT            NOT NULL UNIQUE,
    password        TEXT            NOT NULL,
    location        TEXT            ,
    about           TEXT            ,
    registeredOn    PASTTIMESTAMP   ,
    profileImage    INTEGER         REFERENCES "image"(id)
);

CREATE TABLE "global_mod" (
    id INTEGER PRIMARY KEY REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE "admin" (
    id INTEGER PRIMARY KEY REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE "seller" (
    id INTEGER PRIMARY KEY REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE vehicle (
    id          SERIAL      PRIMARY KEY,
    owner       INTEGER     REFERENCES "user"(id) NOT NULL,
    brand       TEXT        NOT NULL,
    model       TEXT        NOT NULL,
    condition   CONDITION_T NOT NULL DEFAULT 'Mint',
    year        INTEGER     NOT NULL CHECK(year <= date_part('year', CURRENT_TIMESTAMP)),
    horsepower  INTEGER     NOT NULL CHECK(horsepower >= 0),
    description TEXT
);


CREATE TABLE auction (
    id              SERIAL          PRIMARY KEY,
    auction_name    TEXT            NOT NULL,
    vehicle_id      INTEGER         NOT NULL REFERENCES "vehicle"(id),
    startingBid     EURO_T          CHECK (startingBid >= 0),
    creationTime    PASTTIMESTAMP   ,
    startingTime    TIMESTAMP       NOT NULL CHECK (startingTime >= creationTime),
    endingTime      TIMESTAMP       NOT NULL CHECK (endingTime >= startingTime + INTERVAL '1 hour'),
    auctionType     AUCTIONTYPE_T   NOT NULL DEFAULT 'Public',
    search TSVECTOR
);

CREATE TABLE "auction_mod" (
	user_id     INTEGER     REFERENCES "user"(id) ON DELETE CASCADE,
    auction_id  INTEGER     REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "invoice" (
    id          SERIAL          PRIMARY KEY,
    user_id     INTEGER         NOT NULL REFERENCES "user"(id),
    createdOn   PASTTIMESTAMP   ,
    vatNumber   VATNUMBER_T     ,
    value       EURO_T          CHECK(value >= 0),
    description TEXT            NOT NULL
);

CREATE TABLE vehicle_image (
    vehicle_id      INTEGER     NOT NULL REFERENCES "vehicle"(id),
    image_id        INTEGER     NOT NULL REFERENCES "image"(id) ON DELETE CASCADE,
    sequence_number INTEGER     NOT NULL CHECK(sequence_number >= 0),
	PRIMARY KEY(vehicle_id, image_id),
    UNIQUE(vehicle_id, sequence_number)
);

CREATE TABLE "auction_user" (
    user_id     INTEGER     REFERENCES "user"(id),
    auction_id  INTEGER     REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "favourite_auction" (
    id          SERIAL      PRIMARY KEY,
    user_id     INTEGER     REFERENCES "user"(id),
    auction_id  INTEGER     REFERENCES "auction"(id),
	UNIQUE(user_id, auction_id)
);

CREATE TABLE comment (
    id          SERIAL          PRIMARY KEY,
    user_id     INTEGER         NOT NULL REFERENCES "user"(id),
    auction_id  INTEGER         NOT NULL REFERENCES "auction"(id),
    createdOn   PASTTIMESTAMP   ,
    content     TEXT            NOT NULL
);

CREATE TABLE "ban" (
    id          SERIAL          PRIMARY KEY,
    user_id     INTEGER         NOT NULL REFERENCES "user"(id),
    createdBy   INTEGER         NOT NULL REFERENCES "user"(id),
    createdOn   PASTTIMESTAMP   ,
    startTime   FUTURETIMESTAMP CHECK(startTime >= createdOn),
    endTime     FUTURETIMESTAMP CHECK(endTime > startTime),
    reason      TEXT            NOT NULL,
    banType     BANTYPE_T       NOT NULL,
    auction_id  INTEGER         REFERENCES "auction"(id)
    CONSTRAINT auction_id CHECK ((banType != 'AuctionBan') OR (banType = 'AuctionBan' AND auction_id IS NOT NULL))
);

CREATE TABLE bid (
    id          SERIAL          PRIMARY KEY,
    user_id     INTEGER         REFERENCES "user"(id) NOT NULL,
    auction_id  INTEGER         REFERENCES "auction"(id) NOT NULL,
    amount      EURO_T          CHECK (amount > 0),
    createdOn   PASTTIMESTAMP
);







-- Indexes

DROP INDEX IF EXISTS user_vehicles      CASCADE;
DROP INDEX IF EXISTS auctions_comments  CASCADE;
DROP INDEX IF EXISTS vehicle_models     CASCADE;
DROP INDEX IF EXISTS auctions_bids      CASCADE;
DROP INDEX IF EXISTS end_auction        CASCADE;
DROP INDEX IF EXISTS search_idx         CASCADE;

CREATE INDEX user_vehicles ON "vehicle"
USING hash(owner); 

CREATE INDEX auctions_comments ON "comment"
USING hash(auction_id);

CREATE INDEX vehicle_models ON "vehicle"
USING hash(model); 

CREATE INDEX auctions_bids ON "bid"
USING hash(auction_id);

CREATE INDEX end_auction ON "auction"
USING btree (endingTime);
 
CREATE INDEX search_idx ON "auction"
USING GIST (search);







-- Triggers

DROP TRIGGER IF EXISTS ban_user                 ON "ban";
DROP TRIGGER IF EXISTS private_auction_users    ON "auction_user";
DROP TRIGGER IF EXISTS cant_bid_own_auction     ON "bid";
DROP TRIGGER IF EXISTS cant_bid_auction_over    ON "bid";
DROP TRIGGER IF EXISTS only_guests_can_bid      ON "bid";
DROP TRIGGER IF EXISTS banned_bids              ON "ban";
DROP TRIGGER IF EXISTS removed_from_guest_list  ON "auction_user";
DROP TRIGGER IF EXISTS new_bid_higher           ON "bid";
DROP TRIGGER IF EXISTS update_fts               ON "auction";

DROP FUNCTION IF EXISTS ban_user               ;
DROP FUNCTION IF EXISTS private_auction_users ;
DROP FUNCTION IF EXISTS cant_bid_own_auction   ;
DROP FUNCTION IF EXISTS cant_bid_auction_over  ;
DROP FUNCTION IF EXISTS only_guests_can_bid    ;
DROP FUNCTION IF EXISTS banned_bids            ;
DROP FUNCTION IF EXISTS removed_from_guest_list;
DROP FUNCTION IF EXISTS new_bid_higher         ;
DROP FUNCTION IF EXISTS update_fts             ;

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



CREATE FUNCTION private_auction_users() RETURNS TRIGGER AS
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
 
CREATE TRIGGER private_auction_users
    BEFORE INSERT OR UPDATE ON "auction_user"
    FOR EACH ROW
    EXECUTE PROCEDURE private_auction_users(); 



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
    ) = 'Private' AND NOT EXISTS (
        SELECT *
        FROM "auction_user"
        WHERE auction_id = NEW.auction_id
        AND user_id = NEW.user_id
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
        WHERE b.user_id = NEW.user_id;
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
    AFTER DELETE ON "auction_user"
    FOR EACH ROW
    EXECUTE PROCEDURE removed_from_guest_list();



CREATE FUNCTION new_bid_higher() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (
        SELECT *
        FROM "bid"
        WHERE auction_id = NEW.auction_id
        AND amount > NEW.amount
    ) THEN
        RAISE EXCEPTION 'Bids must be of a higher amount';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER new_bid_higher
    BEFORE INSERT ON "bid"
    FOR EACH ROW
    EXECUTE PROCEDURE new_bid_higher();



CREATE FUNCTION update_fts() RETURNS TRIGGER AS
$BODY$
DECLARE brand TEXT = (SELECT brand FROM "vehicle" WHERE id = NEW.vehicle_id);
DECLARE model TEXT = (SELECT model FROM "vehicle" WHERE id = NEW.vehicle_id);
BEGIN
	IF TG_OP = 'INSERT' THEN
		NEW.search = setweight(to_tsvector ('english', NEW.auction_name), 'A') || 
                     setweight(to_tsvector ('english', brand), 'B') ||
                     setweight(to_tsvector ('english', model), 'C');
	END IF;
	IF TG_OP = 'UPDATE' THEN
		IF NEW.auction_name <> OLD.auction_name THEN
			NEW.search = setweight(to_tsvector ('english', NEW.auction_name), 'A') || 
                         setweight(to_tsvector ('english', brand), 'B') ||
                         setweight(to_tsvector ('english', model), 'C');
		END IF;
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_fts
    BEFORE INSERT OR UPDATE ON "auction"
    FOR EACH ROW
    EXECUTE PROCEDURE update_fts();







-- Populate

-- Profile Photos --
INSERT INTO "image" (id,path) VALUES
(1, 'profile_photos/1.jpg'),
(2, 'profile_photos/2.jpg'),
(3, 'profile_photos/3.jpg'),
(4, 'profile_photos/4.jpg'),
(5, 'profile_photos/5.jpg'),
(6, 'profile_photos/6.jpg'),
(7, 'profile_photos/7.jpg'),
(8, 'profile_photos/8.jpg'),
(9, 'profile_photos/9.jpg'),
(10, 'profile_photos/10.jpg'),
(11, 'profile_photos/11.jpg'),
(12, 'profile_photos/12.jpg'),
(13, 'profile_photos/13.jpg'),
(14, 'profile_photos/14.jpg'),
(15, 'profile_photos/15.jpg'),
(16, 'profile_photos/16.jpg'),
(17, 'profile_photos/17.jpg'),
(18, 'profile_photos/18.jpg'),
(19, 'profile_photos/19.jpg'),
(20, 'profile_photos/20.jpg');

SELECT pg_catalog.setval(pg_get_serial_sequence('image', 'id'), (SELECT MAX(id) FROM "image")+1);

-- Users --
INSERT INTO "user" (id,profileImage,firstName,lastName,email,username,password,location,about,registeredOn) VALUES
(1,1,'Roth','Hampton','tempor.augue.ac@sitametmetus.edu','roth_hampton','PXA24YEP6CV','Porto','I LOVE CARS and so I decided to build this website so I can share it with everyone else.','2021-03-30 12:38:24'),
(2,2,'Bree','Espinoza','auctor.velit.eget@mollis.ca','bree_espinoza','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W','Muradiye','I love BMWs and I cant help myself when it comes to buying them. My girlfriend doesnt really approve of that so I need to sell some of them','2021-03-30 12:38:24'),
(3,3,'Tanek','Spence','Fusce.dolor@nisi.com','tanek_spence','DTQ16ULU3HP','Barry','Ive been in love with cars ever since I was a 4 year old and now I want to make a living out of it.','2021-03-30 12:38:24'),
(4,4,'Fitzgerald','Cash','dolor.dapibus.gravida@sedduiFusce.edu','cash_fitz','UAU42EDT3XL','Perchtoldsdorf','Cars, cars, cars, You gotta love them.','2021-03-30 12:38:24'),
(5,5,'Aimee','Cortez','nibh@dictum.co.uk','aimee_cortez','XXX07JUG7BH','Sargodha','Life without cars is like Rome without the Pope.','2021-03-30 12:38:24'),
(6,6,'Barclay','Sargent','aliquet.Proin@Praesent.com','barclay','KDI43MJE4FP','Maunath Bhanjan','Just chilling and buying cars.','2021-03-30 12:38:24'),
(7,7,'Fuller','Beck','mi.felis@pedeacurna.com','fuller_beck','NAQ18MSW3TI','Pekanbaru','Just trying to have some fun :)','2021-03-30 12:38:24'),
(8,8,'Ulysses','Bennett','dictum@Donectempor.com','ulysses_bennte','CQW48UUT5TJ','Aylmer','Impulsive car buyer.','2021-03-30 12:38:24'),
(9,9,'Ian','Walsh','nulla@Curabitursed.ca','ian_walsh','LQG38WSJ6NO','Borgomasino','Im a Bad Ass.','2021-03-30 12:38:24'),
(10,10,'Valentine','Boyer','elit.pharetra.ut@aliquetsem.com','valentine_boyer','RIX27PKB7IJ','Sakhalin','Hello! Just loving cars.','2021-03-30 12:38:24'),
(11,11,'Ulysses','Hayes','mauris@metusInnec.co.uk','ulysses_hayes','PPY94UIU8YF','Scala Coeli','Fast and Furious lover. JUst trying to bring things from the screen to real life.','2021-03-30 12:38:24'),
(12,12,'Moses','Stanton','dui.nec.urna@dictumcursus.edu','moses_stanton','NPR54ONU1NS','Tallahassee','Im boreeeeeeeeeeeeeeeeeeeeeeeeeeeeeeed','2021-03-30 12:38:24'),
(13,13,'Silas','Olsen','faucibus.ut.nulla@fermentummetus.net','silas_olsen','MCH94KSM4NQ','Pishin Valley','what am i doing with my life?','2021-03-30 12:38:24'),
(14,14,'Abra','Carson','tempor@pede.co.uk','abra_carson','EWV73ABO7RD','Belogorsk','Fast and furious is the best and you cant change my mind','2021-03-30 12:38:24'),
(15,15,'Montana','Poole','convallis@diamSed.com','montana','EXV51KVN4UG','Saint-Nazaire','just trying to find a nice car for my family','2021-03-30 12:38:24'),
(16,16,'Melvin','Burch','Nulla.tincidunt@nonnisiAenean.org','melvin_b','KJV18FNQ2TA','Bostaniçi','hey everyone. Im new to the car passion thing but i really want to get into business.','2021-03-30 12:38:24'),
(17,17,'Jared','Head','mauris.a.nunc@eu.ca','NBU44UNP0BB','head_jared','Provost','life is boring but cars are not','2021-03-30 12:38:24'),
(18,18,'Yvonne','Odonnell','condimentum@velvulputate.edu','odonnel_y','WYQ13QQL6SR','Saint-Médard-en-Jalles','Renaults are the best cars in the world.','2021-03-30 12:38:24'),
(19,19,'Palmer','Maldonado','Aliquam.tincidunt@orci.com','paler_mal','HTJ05GKL1QF','East Linton','Hey hey hey hey hey hey!','2021-03-30 12:38:24'),
(20,20,'Geraldine','Farrell','tempor.arcu.Vestibulum@Naminterdumenim.co.uk','geraldine','RTV38CTE4GF','Surat','wanna see me playing with cars while wearing nothing? come to this link: geraldine.naked.com','2021-03-30 12:38:24'),
(21,17, 'John', 'Doe','user@example.com', 'johndoe', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'johnlocation', 'i really like cars :)', '2020-05-30 12:38:24');

SELECT pg_catalog.setval(pg_get_serial_sequence('user', 'id'), (SELECT MAX(id) FROM "user")+1);

-- Seller Permissions --
INSERT INTO "seller" (id) VALUES (2),(3),(4),(7);

SELECT pg_catalog.setval(pg_get_serial_sequence('seller', 'id'), (SELECT MAX(id) FROM "seller")+1);

-- Vehicles --
INSERT INTO "vehicle" (id,owner,brand,model,condition,year,horsepower) VALUES
(1,2,'BMW','1 Series','Mint',2008,150),
(2,2,'BMW','3 Series','Mint',2010,200),
(3,2,'BMW','5 Series','Mint',2009,220),
(4,2,'BMW','7 Series','Mint',2012,250),
(5,2,'Mercedes','Class A','Clean',2015,180),
(6,2,'Mercedes','Class C','Average',2015,240),
(7,3,'Rolls Royce','Ghost','Mint',2016,320),
(8,3,'Rolls Royce','Ghost','Clean',2012,320),
(9,3,'Rolls Royce','Dawn','Average',2016,300),
(10,3,'Rolls Royce','Phantom','Rough',2003,380),
(11,3,'Rolls Royce','Ghost','Clean',2014,320),
(12,3,'Rolls Royce','Ghost','Clean',2014,320),
(13,3,'Rolls Royce','Dawn','Mint',2018,400),
(14,3,'Rolls Royce','Phantom','Average',2010,380),
(15,4,'Ferrari','Spider','Average',2016,6800),
(16,4,'Ford','Mustang','Rough',2008,550),
(17,4,'Jaguar','XE','Clean',2019,450),
(18,4,'Lamborguini','Aventador S','Clean',2020,740),
(19,4,'Porsche','Panamera 4 Executive','Mint',2020,450),
(20,4,'Tesla','S','Mint',2021,700);

-- reset the sequence, regardless whether table has rows or not:
SELECT setval(pg_get_serial_sequence('vehicle', 'id'), coalesce(max(id),0) + 1, false) FROM vehicle;

-- Auctions --
INSERT INTO "auction" (id,auction_name,vehicle_id,startingBid,creationTime,startingTime,endingTime,auctionType) VALUES
(1,'BMW 1 Series 2008 Good State',1,8000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2022-05-12 19:00:00','Public'),
(2,'BMW 3 Series 2010 Mint',2,10000,'2021-03-30 12:59:24','2021-05-12 20:00:00','2021-05-15 12:00:00','Public'),
(3,'BMW 5 Series Exclusive',3,15000,'2021-03-30 12:59:24','2021-08-15 12:00:00','2021-08-30 17:00:00','Public'),
(4,'BMW 7 Series Great for Sports People',4,20000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(5,'Mercedes A Clean',5,10000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Private'),
(6,'Mercedes C Average',6,10000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Private'),
(7,'Awesome Rolls Royce Ghost 16',7,30000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(8,'Clean RR Ghost 12',8,25000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(9,'RR Dawn 16 Perfect for Families',9,25000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(10,'Old but never out of Style RR Phantom 03',10,20000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(11,'Clean RR Ghost 14',11,43000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(12,'Fantastic RR Ghost 14',12,48000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(13,'Mint RR Dawn 18',13,60000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-08 12:00:00','Public'),
(14,'10s Phantom for the fearless',14,35000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-08 12:00:00','Public'),
(15,'Exclusive Ferrari Spider',15,180000,'2021-03-30 12:59:24','2021-04-04 12:00:00','2021-04-08 12:00:00','Public'),
(16,'CR7 Old Mustang',16,400000,'2021-03-30 12:59:24','2021-04-04 12:00:00','2021-04-08 12:00:00','Public'),
(17,'Roar with your new Jaguar XE',17,240000,'2021-03-30 12:59:24','2021-04-04 12:00:00','2021-04-08 12:00:00','Public'),
(18,'Luxury Aventador S',18,390000,'2021-03-30 12:59:24','2021-04-05 12:00:00','2021-04-08 12:00:00','Public'),
(19,'New Panamera 4 Executive',19,160000,'2021-03-30 12:59:24','2021-04-05 12:00:00','2021-04-08 12:00:00','Public'),
(20,'Brand New Tesla S',20,230000,'2021-03-30 12:59:24','2021-04-05 12:00:00','2021-04-08 12:00:00','Public');

-- reset the sequence, regardless whether table has rows or not:
SELECT setval(pg_get_serial_sequence('auction', 'id'), coalesce(max(id),0) + 1, false) FROM auction;

-- User Permissions --
INSERT INTO "global_mod" (id) VALUES (2),(5);
INSERT INTO "auction_mod" (user_id,auction_id) VALUES (3,7),(3,8),(3,9),(3,10),(3,11),(3,12),(3,13),(3,14);
INSERT INTO "auction_mod" (user_id,auction_id) VALUES (4,15),(4,16),(4,17),(4,18),(4,19),(4,20);
INSERT INTO "auction_mod" (user_id,auction_id) VALUES (6,15),(6,16),(6,17);
INSERT INTO "admin" (id) VALUES (1);

-- Car Photos --
INSERT INTO "image" (id,path) VALUES
(21, 'car_photos/1/1.jpg'), (22, 'car_photos/1/2.jpg'), (23, 'car_photos/1/3.jpg'),
(24, 'car_photos/2/1.jpg'), (25, 'car_photos/2/2.jpg'),
(26, 'car_photos/3/1.jpg'),
(27, 'car_photos/4/1.jpg'), (28, 'car_photos/4/2.jpg'),
(29, 'car_photos/5/1.jpg'),
(30, 'car_photos/6/1.jpg'),
(31, 'car_photos/7/1.jpg'),
(32, 'car_photos/8/1.jpg'),
(33, 'car_photos/9/1.jpg'),
(34, 'car_photos/10/1.jpg'),
(35, 'car_photos/11/1.jpg'),
(36, 'car_photos/12/1.jpg'),
(37, 'car_photos/13/1.jpg'),
(38, 'car_photos/14/1.jpg'),
(39, 'car_photos/15/1.jpg'),
(40, 'car_photos/16/1.jpg'),
(41, 'car_photos/17/1.jpg'),
(42, 'car_photos/18/1.jpg'),
(43, 'car_photos/19/1.jpg'),
(44, 'car_photos/20/1.jpg');

SELECT pg_catalog.setval(pg_get_serial_sequence('image', 'id'), (SELECT MAX(id) FROM "image")+1);

INSERT INTO "vehicle_image" (vehicle_id,image_id,sequence_number) VALUES
(1,21,1), (1,22,2), (1,23,3),
(2,24,1),(2,25,2),
(3,26,1),
(4,27,1),(4,28,2),
(5,29,1),
(6,30,1),
(7,31,1),
(8,32,1),
(9,33,1),
(10,34,1),
(11,35,1),
(12,36,1),
(13,37,1),
(14,38,1),
(15,39,1),
(16,40,1),
(17,41,1),
(18,42,1),
(19,43,1),
(20,44,1);

-- Public Auction Guests --
INSERT INTO "auction_user" (user_id, auction_id) VALUES
(8,5),(9,5),(10,5),(11,5),(12,5),(13,5),
(11,6),(12,6),(13,6),(14,6),(15,6);

-- Favourite Auctions --
INSERT INTO "favourite_auction" (id, user_id, auction_id) VALUES
(1,8,1),(2,8,2),(3,8,3),(4,8,4),(5,8,5),
(6,9,5),(7,9,6),(8,9,7),(9,9,8),(10,9,9),
(11,10,8),(12,10,9),
(13,11,6),(14,11,5),
(15,12,6),(16,12,11),(17,12,19),(18,12,17),
(19,13,15),(20,13,16);

SELECT pg_catalog.setval(pg_get_serial_sequence('favourite_auction', 'id'), (SELECT MAX(id) FROM "favourite_auction")+1);

-- Auction Comments --
INSERT INTO "comment" (id,user_id,auction_id,createdOn,content) VALUES
(1,8,1,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(2,9,1,'2021-03-31 17:54:38','Lovely Car! Hope I can get it!'),
(3,10,1,'2021-03-31 19:03:38','I love this BMW. It will be the perfect gift for my daughter.'),
(4,8,2,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(5,8,3,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(6,8,4,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(7,8,5,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(8,8,7,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(9,11,6,'2021-03-31 15:27:38','Thank you for inviting me for this auction. I really want this car!'),
(10,13,6,'2021-03-31 13:27:38','Really looking forward for this auction'),
(11,12,6,'2021-03-31 18:27:38','Great Car and great seller. Cant wait for this awesome auction.');

SELECT pg_catalog.setval(pg_get_serial_sequence('comment', 'id'), (SELECT MAX(id) FROM "comment")+1);

-- Banned Users --
INSERT INTO "ban" (id,user_id,createdBy,createdOn,startTime,endTime,reason,banType) VALUES
(1, 20, 1, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'Is a bot.','AllBan'),
(2, 19, 1, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'I dont trust him.','BuyerBan'),
(3, 18, 1, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'I dont want him selling his cars in my website','SellerBan');
INSERT INTO "ban" (id,user_id,createdBy,createdOn,startTime,endTime,reason,banType,auction_id) VALUES
(4, 8, 3, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'I dont trust him for this auction','AuctionBan',14);

SELECT pg_catalog.setval(pg_get_serial_sequence('ban', 'id'), (SELECT MAX(id) FROM "ban")+1);

-- Bids --
INSERT INTO "bid" (id,user_id,auction_id,amount,createdOn) VALUES
(1,5,1,8000,'2021-04-01 17:06:32'),
(2,6,1,8300,'2021-04-01 17:20:32'),
(3,7,1,8500,'2021-04-01 17:45:32'),
(4,5,1,8800,'2021-04-01 17:56:32'),
(5,6,2,10000,'2021-04-01 17:06:32'),
(6,8,2,10500,'2021-04-01 17:20:32'),
(7,6,2,11000,'2021-04-01 17:45:32'),
(8,8,3,15000,'2021-04-01 17:56:32'),
(9,5,4,20000,'2021-04-01 17:06:32'),
(10,7,4,21000,'2021-04-01 17:20:32'),
(11,12,5,10000,'2021-04-01 17:45:32'),
(12,15,6,10000,'2021-04-01 17:56:32'),
(13,11,7,30000,'2021-04-01 17:20:32'),
(14,12,8,25000,'2021-04-01 17:45:32'),
(15,13,9,25000,'2021-04-01 17:56:32');

SELECT pg_catalog.setval(pg_get_serial_sequence('bid', 'id'), (SELECT MAX(id) FROM "bid")+1);

-- Invoices --
INSERT INTO "invoice" (id,user_id,createdOn,vatNumber,value,description) VALUES
(1,2,'2021-02-01 00:00:10','205538451', 500, 'Seller monthly fee'),
(2,2,'2021-03-01 00:00:10','205538451', 500, 'Seller monthly fee'),
(3,2,'2021-04-01 00:00:10','205538451', 500, 'Seller monthly fee'),
(4,3,'2021-04-01 00:00:07','794830202', 500, 'Seller monthly fee'),
(5,4,'2021-04-01 00:00:08','993546321', 500, 'Seller monthly fee'),
(6,7,'2021-04-01 00:00:09','120520673', 500, 'Seller monthly fee');

SELECT pg_catalog.setval(pg_get_serial_sequence('invoice', 'id'), (SELECT MAX(id) FROM "invoice")+1);
