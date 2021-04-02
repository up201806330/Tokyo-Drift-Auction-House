DROP DOMAIN IF EXISTS nowtimestamp CASCADE;
DROP TABLE IF EXISTS "user" CASCADE;
DROP TABLE IF EXISTS "global_mod" CASCADE;
DROP TABLE IF EXISTS "admin" CASCADE;
DROP TABLE IF EXISTS "seller" CASCADE;
DROP TABLE IF EXISTS "vehicle" CASCADE;
DROP TABLE IF EXISTS "auction" CASCADE;
DROP TABLE IF EXISTS "auction_mod" CASCADE;
DROP TABLE IF EXISTS "image" CASCADE;
DROP TABLE IF EXISTS "profile_image" CASCADE;
DROP TABLE IF EXISTS "vehicle_image" CASCADE;
DROP TABLE IF EXISTS "auction_guest" CASCADE;
DROP TABLE IF EXISTS "favourite_auction" CASCADE;
DROP TABLE IF EXISTS "auction_comment" CASCADE;
DROP TABLE IF EXISTS "ban" CASCADE;
DROP TABLE IF EXISTS "bidding" CASCADE;

CREATE DOMAIN nowtimestamp AS timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL;

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    firstName text NOT NULL,
    lastName text NOT NULL,
    email text NOT NULL UNIQUE,
    username text NOT NULL UNIQUE,
    password text NOT NULL,
    location text,
    about text,
    registeredOn nowtimestamp
);

CREATE TABLE "global_mod" (
    id integer PRIMARY KEY REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE "admin" (
    id integer PRIMARY KEY REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE "seller" (
    id integer PRIMARY KEY REFERENCES "user"(id) ON DELETE CASCADE
);

CREATE TABLE "vehicle" (
    id SERIAL PRIMARY KEY,
    owner integer REFERENCES "seller"(id) NOT NULL,
    brand text NOT NULL,
    model text NOT NULL,
    condition text NOT NULL DEFAULT 'Mint' CHECK (condition IN ('Mint', 'Clean', 'Average', 'Rough')),
    manufactureYear integer NOT NULL CHECK (manufactureYear > 1800),
    horsepower integer NOT NULL CHECK (horsepower > 0)
);

CREATE TABLE "auction" (
    id SERIAL PRIMARY KEY,
    auction_name text NOT NULL,
    vehicle integer REFERENCES "vehicle"(id) NOT NULL,
    startingBid integer NOT NULL CHECK (startingBid > 0),
    creationTime nowtimestamp,
    startingTime nowtimestamp CHECK (startingTime >= CURRENT_TIMESTAMP), 
    endingTime timestamp NOT NULL CHECK (endingTime >= startingTime),
    auctionType text NOT NULL DEFAULT 'Public' CHECK (auctionType IN ('Public', 'Private'))
);

CREATE TABLE "auction_mod" (
	user_id integer REFERENCES "user"(id) ON DELETE CASCADE,
    auction_id integer REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "image" (
    id SERIAL PRIMARY KEY,
    path text NOT NULL
);

CREATE TABLE "profile_image" (
    user_id integer PRIMARY KEY REFERENCES "user"(id) NOT NULL,
    image integer REFERENCES image(id) ON DELETE CASCADE NOT NULL
);

CREATE TABLE "vehicle_image" (
    vehicle integer REFERENCES "vehicle"(id) NOT NULL,
    image integer REFERENCES "image"(id) ON DELETE CASCADE NOT NULL,
    sequence_number integer,
	PRIMARY KEY(vehicle, image)
);

CREATE TABLE "auction_guest" (
    user_id integer REFERENCES "user"(id),
    auction_id integer REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "favourite_auction" (
    user_id integer REFERENCES "user"(id),
    auction_id integer REFERENCES "auction"(id),
	PRIMARY KEY(user_id, auction_id)
);

CREATE TABLE "auction_comment" (
    id SERIAL PRIMARY KEY,
    user_id integer REFERENCES "user"(id) NOT NULL,
    auction_id integer REFERENCES "auction"(id) NOT NULL,
    createdOn nowtimestamp,
    content text NOT NULL
);

CREATE TABLE "ban" (
    id SERIAL PRIMARY KEY,
    user_id integer REFERENCES "user"(id) NOT NULL,
    createdBy integer REFERENCES "user"(id) NOT NULL,
    createdOn nowtimestamp,
    startTime nowtimestamp,
    endTime timestamp NOT NULL,
    reason text NOT NULL,
    banType text NOT NULL CHECK (banType IN ('BuyerBan', 'SellerBan', 'AllBan', 'AuctionBan')),
    auction_id integer REFERENCES "auction"(id)
    CONSTRAINT auction_id CHECK ((banType <> 'AuctionBan') OR (banType = 'AuctionBan' AND auction_id IS NOT NULL))
);

CREATE TABLE "bidding" (
    id SERIAL PRIMARY KEY,
    user_id integer REFERENCES "user"(id) NOT NULL,
    auction_id integer REFERENCES "auction"(id) NOT NULL,
    amount integer NOT NULL CHECK (amount > 0),
    createdOn nowtimestamp
);