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
