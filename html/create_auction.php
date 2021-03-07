<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS importing -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        
        <!-- Fontawesome Icons importing -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

        <!-- CSS importing -->
        <link rel="stylesheet" type="text/css" href="create_auction.css">
    </head>

    <body>
        <!-- Navbar -->


        <h1>Create Auction</h1>
        <!-- Form -->
        <div class="container w-75">
            <form>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="form-group">
                            <label for="auctionName">Auction Name</label>
                            <input type="text" class="form-control" id="auctionName" placeholder="Auction Name">
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text" class="form-control" id="brand" placeholder="Brand">
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" placeholder="Model">
                        </div>
                    </div>
                    <div class="col">
                        <img src="https://www.automaistv.com.br/wp-content/uploads/2019/04/bmw_i8_roadster_34-990x660.jpg" class="d-block w-75" alt="bmw i8">
                        <div class="form-group">
                            <input type="file" class="form-control" id="imageFile" placeholder="Images Upload" multiple>
                        </div>
                    </div>
                </div>
                
                <div class="row align-items-center">
                    <div class="col">
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="number" min="1950" max="2021" class="form-control" id="year" placeholder="Year">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="horsePower">Horse Power</label>
                            <div class="input-group">
                                <input type="number" min="0" max="2000" class="form-control" id="horsePower" placeholder="Horse Power">
                                <div class="input-group-append">
                                    <span class="input-group-text">hp</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="condition">Condition</label>
                            <select class="form-select" aria-label="condition">
                                <option value="mint" selected>Mint</option>
                                <option value="clean">Clean</option>
                                <option value="average">Average</option>
                                <option value="rough">Rough</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col">
                        <div class="form-group">
                            <label for="startingBid">Starting Bid</label>
                            <div class="input-group">
                                <input type="number" min="0" max="100000000" class="form-control" id="startingBid" placeholder="Starting Bid">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="startingTime">Starting Time</label>
                            <input type="datetime-local" id="startingTime" name="startingTime">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="endingTime">Ending Time</label>
                            <input type="datetime-local" id="endingTime" name="endingTime">
                        </div>
                    </div>
                </div>
  
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Footer -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>

</html>