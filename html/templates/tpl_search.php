<?php function draw_sidebar(){ ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4 mb-3">
      <div class="display-2">
        Browse Auctions
      </div class="display-2">
    </div>
    <div class="col-sm-8 d-flex align-items-center overflow-hidden">
      <div class="row mx-auto gx-4">
        <div class="p-5 col-8 col-sm-6">
          <label for="searchByTags" class="form-label">Search Tags</label>
          <div class="input-group" id="searchByTags">
            <input type="text" class="form-control" placeholder="Try some keywords" aria-label="Input search keywords" aria-describedby="button-search-1">
            <button class="btn btn-outline-secondary" type="button" id="button-search-1">Search</button>
          </div>
        </div>
        <div class="p-5 col-4 col-sm-6">
          <label for="selectOrderResults" class="form-label">Order By</label>
          <select class="form-select" id="selectOrderResults" aria-label="Select order of results">
            <option selected>Ascending Current Bid</option>
            <option value="1">Ascending Current Bid</option>
            <option value="2">Descending Current Bid</option>
            <option value="3">Ending Sooner</option>
            <option value="4">Ending Later</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } ?>

