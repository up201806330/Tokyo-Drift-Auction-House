<?php function draw_create_auction() {
    /**
     * Draws sign up page
     */
?>
<div id="create_auction_background">
    <!-- Form -->
    <div class="container-fluid p-5 clearfix text-left border border-1 border-secondary rounded-3" id="create_auction">
        <div class="display-3 text-center">Create Auction</div>
        <hr class="bg-dark border-5 border-top border-dark">
        <form>
            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group">
                        <label for="auctionName">Auction Name</label>
                        <input type="text" class="form-control input_box" id="auctionName" placeholder="Auction Name">
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control input_box" id="brand" placeholder="Brand">
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control input_box" id="model" placeholder="Model">
                    </div>
                </div>
                <div class="col-md m-0">
                    <img src="https://www.automaistv.com.br/wp-content/uploads/2019/04/bmw_i8_roadster_34-990x660.jpg" class="d-block mx-auto mt-3 border border-2 border-secondary rounded-3" id="image_input_preview" alt="bmw i8">
                    <div class="form-group mb-3">
                        <input type="file" class="form-control mx-auto" id="image_input" placeholder="Images Upload" multiple>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" min="1950" max="2021" class="form-control input_box" id="year" placeholder="Year">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="horsePower">Horse Power</label>
                        <div class="input-group">
                            <input type="number" min="0" max="2000" class="form-control input_box text-right" id="horsePower" placeholder="Horse Power">
                            <div class="input-group-append">
                                <span class="input-group-text append_box">hp</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select class="form-select input_box" aria-label="condition">
                            <option value="mint" selected>Mint</option>
                            <option value="clean">Clean</option>
                            <option value="average">Average</option>
                            <option value="rough">Rough</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group">
                        <label for="startingTime">Starting Time</label>
                        <input type="datetime-local" class="form-control input_box" id="startingTime" name="startingTime" value="2021-03-15T19:30">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="endingTime">Ending Time</label>
                        <input type="datetime-local" class="form-control input_box" id="endingTime" name="endingTime" value="2021-03-20T19:30">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="startingBid">Starting Bid</label>
                        <div class="input-group" id="staring_bid_group">
                            <input type="number" min="0" max="100000000" class="form-control input_box text-right" id="startingBid" placeholder="Starting Bid">
                            <div class="input-group-append">
                                <span class="input-group-text append_box">€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a role="button" class="btn float-end clearfix rounded-pill" id="submit_button" href="../pages/auction.php"><b>CREATE AUCTION</b></a>
            </div>
        </form>
    </div>
</div>

<?php } ?>