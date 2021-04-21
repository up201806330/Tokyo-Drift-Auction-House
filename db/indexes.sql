CREATE INDEX user_vehicles ON "vehicle"
USING hash(owner); 

CREATE INDEX auctions_comments ON "auction_comment"
USING hash(auction); 

CREATE INDEX vehicle_models ON "vehicle"
USING hash(model); 

CREATE INDEX auctions_bids ON "bid"
USING hash(auction ); 

CREATE INDEX end_auction ON "auction"
USING btree (endingTime);
 
CREATE INDEX search_idx ON "auction"
USING GIST (search);
