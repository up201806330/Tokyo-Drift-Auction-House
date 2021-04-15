DROP DOMAIN IF EXISTS PASTTIMESTAMP     CASCADE;
DROP DOMAIN IF EXISTS FUTURETIMESTAMP   CASCADE;
DROP DOMAIN IF EXISTS EUROCENTS         CASCADE;
DROP DOMAIN IF EXISTS EMAIL_T           CASCADE;
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
DROP TABLE IF EXISTS "auction_guest"        CASCADE;
DROP TABLE IF EXISTS "favourite_auction"    CASCADE;
DROP TABLE IF EXISTS "comment"              CASCADE;
DROP TABLE IF EXISTS "ban"                  CASCADE;
DROP TABLE IF EXISTS "bid"                  CASCADE;

CREATE DOMAIN   PASTTIMESTAMP   AS TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP CHECK(VALUE <= CURRENT_TIMESTAMP);
CREATE DOMAIN   FUTURETIMESTAMP AS TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP;
CREATE DOMAIN   EUROCENTS       AS INTEGER      NOT NULL;
CREATE DOMAIN   EMAIL_T         AS TEXT         CHECK(VALUE LIKE '_%@_%.__%');
CREATE TYPE     CONDITION_T     AS ENUM ('Mint', 'Clean', 'Average', 'Rough');
CREATE TYPE     AUCTIONTYPE_T   AS ENUM ('Public', 'Private');
CREATE TYPE     BANTYPE_T       AS ENUM ('BuyerBan', 'SellerBan', 'AllBan', 'AuctionBan');

CREATE TABLE "image" (
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

CREATE TABLE "vehicle" (
    id          SERIAL      PRIMARY KEY,
    owner       INTEGER     REFERENCES "user"(id) NOT NULL,
    brand       TEXT        NOT NULL,
    model       TEXT        NOT NULL,
    condition   CONDITION_T NOT NULL DEFAULT 'Mint',
    year        INTEGER     NOT NULL CHECK(year <= date_part('year', CURRENT_TIMESTAMP)),
    horsepower  INTEGER     NOT NULL CHECK(horsepower >= 0),
    description TEXT        NOT NULL
);

CREATE TABLE "auction" (
    id              SERIAL          PRIMARY KEY,
    auction_name    TEXT            NOT NULL,
    vehicle_id      INTEGER         NOT NULL REFERENCES "vehicle"(id),
    startingBid     EUROCENTS       CHECK (startingBid >= 0),
    creationTime    PASTTIMESTAMP   ,
    startingTime    TIMESTAMP       NOT NULL CHECK (startingTime >= creationTime),
    endingTime      TIMESTAMP       NOT NULL CHECK (endingTime >= startingTime + INTERVAL '1 hour'),
    auctionType     AUCTIONTYPE_T   NOT NULL DEFAULT 'Public'
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
    value       EUROCENTS       CHECK(value >= 0),
    description TEXT            NOT NULL
);

CREATE TABLE "vehicle_image" (
    vehicle_id      INTEGER     NOT NULL REFERENCES "vehicle"(id),
    image_id        INTEGER     NOT NULL REFERENCES "image"(id) ON DELETE CASCADE,
    sequence_number INTEGER     NOT NULL CHECK(sequence_number >= 0),
	PRIMARY KEY(vehicle, image),
    UNIQUE(vehicle, sequence_number)
);

CREATE TABLE "auction_guest" (
    user_id     INTEGER     REFERENCES "user"(id),
    auction_id  INTEGER     REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "favourite_auction" (
    user_id     INTEGER     REFERENCES "user"(id),
    auction_id  INTEGER     REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "comment" (
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

CREATE TABLE "bid" (
    id          SERIAL          PRIMARY KEY,
    user_id     INTEGER         REFERENCES "user"(id) NOT NULL,
    auction_id  INTEGER         REFERENCES "auction"(id) NOT NULL,
    amount      EUROCENTS       CHECK (amount > 0),
    createdOn   PASTTIMESTAMP
);