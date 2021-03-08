<?php function draw_topbar(){ ?>

<div class="container-fluid bg-light">
  <div class="row">
    <div class="col-sm-4 pt-5">
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

<?php function draw_sidebar(){ ?>

  <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item pt-3">
            <div class="display-6">
              Filter results
            </div class="display-6">
          </li>
          
          <li class="nav-item pt-5">
            <label for="selectConditionFilter" class="form-label">Condition</label>
            <select class="form-select" id="selectConditionFilter" aria-label="Filter by condition">
              <option value="1">Mint</option>
              <option value="2">Clean or better</option>
              <option value="3">Average or better</option>
              <option value="4">Rough or better</option>
            </select>
          </li>
          
          <li class="nav-item pt-5">
            <div class="btn-group dropend">
              <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxSports" checked>
                    <label class="form-check-label" for="checkboxSports">
                      Sports
                    </label>
                  </div>
                </a></li>
                <li><a class="dropdown-item" href="#">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxAntiques" checked>
                    <label class="form-check-label" for="checkboxAntiques">
                      Antiques
                    </label>
                  </div>
                </a></li>
                <li><a class="dropdown-item" href="#">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxFamily" checked>
                    <label class="form-check-label" for="checkboxFamily">
                      Family
                    </label>
                  </div>
                </a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</div>

<?php } ?>