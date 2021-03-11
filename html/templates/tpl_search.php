<?php function open_main() { ?>

<div class="container-fluid bg-light" style="flex: auto">
<div class="row h-100">

<?php } ?>

<?php function close_main() { ?>

</div></div>

<?php } ?>


<?php function draw_topbar(){ ?>

<div class="container-fluid bg-dark">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-5 pt-4">
      <div class="display-3 text-white">
        Browse Auctions
      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-7 pb-2">
      <div class="row mx-auto gx-4">
        <div class="pt-4 col-12 col-sm-6">
          <label for="searchByTags" class="form-label text-white">Search Tags</label>
          <div class="input-group" id="searchByTags">
            <input type="text" class="form-control" placeholder="Try some keywords" aria-label="Input search keywords" aria-describedby="button-search-1">
            <button class="btn btn-outline-secondary" type="button" id="button-search-1">Search</button>
          </div>
        </div>
        <div class="col-12 col-sm-6 pt-sm-5 pb-xs-3">
          <div class="dropdown mx-auto d-grid">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="selectOrderResults" data-bs-toggle="dropdown" aria-expanded="false">
              Order By
            </button>
            <ul class="dropdown-menu" aria-labelledby="selectOrderResults">
              <li><a class="dropdown-item" href="#" onclick="updateDropdownOrder(this)">Ascending Current Bid</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdownOrder(this)">Descending Current Bid</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdownOrder(this)">Ending Sooner</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdownOrder(this)">Ending Later</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } ?>

<?php function draw_sidebar(){ ?>

<a class="btn btn-primary d-lg-none" data-bs-toggle="collapse" href="#sidebarMenu" role="button" aria-expanded="true" aria-controls="collapseExample">
   Filter Results
</a>

<nav id="sidebarMenu" class="col-12 col-sm-12 col-md-12 col-lg-3 bg-light border-end border-secondary collapse show">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item pt-3">
        <div class="display-6">
          Filter results
        </div class="display-6">
      </li>
      
      <li class="nav-item pt-5">
        <div class="dropdown mx-auto d-grid gap-2">
            <button class="btn-lg btn btn-secondary dropdown-toggle" type="button" id="selectConditionFilter" data-bs-toggle="dropdown" aria-expanded="false">
            Condition
            </button>
            <ul class="dropdown-menu" aria-labelledby="selectConditionFilter">
              <li><a class="dropdown-item" href="#" onclick="updateDropdownConditions(this)"><b>Mint</b></a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdownConditions(this)"><b>Clean</b> or better</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdownConditions(this)"><b>Average</b> or better</a></li>
              <li><a class="dropdown-item" href="#" onclick="updateDropdownConditions(this)"><b>Rough</b> or better</a></li>
            </ul>
          </div>
      </li>
      
      <li class="nav-item pt-5">
        <div class="d-grid gap-2 col-12 ">
        <div class="btn-group dropdown">
          <button type="button" class="btn-lg btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
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
        </div>
      </li>

      <li class="nav-item pt-5">
        <label class="form-slider-label" for="multiRangeHorsepower">Horsepower (HP)</label>
        <?php draw_multi_range_slider("multiRangeHorsepower", 0, 100); ?>
      </li>
      
      <li class="nav-item pt-4">
        <label class="form-slider-label" for="multiRangeYear">Year of manufacture</label>
        <?php draw_multi_range_slider("multiRangeYear", 0, 100); ?>
      </li>

      <li class="nav-item pt-5">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="switchShowUsedCars" checked>
          <label class="form-check-label" for="switchShowUsedCars">Show Used Cars</label>
        </div>
      </li>
      
      <li class="nav-item pt-4">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="switchFinalizedAuctions">
          <label class="form-check-label" for="switchFinalizedAuctions">Show Finalized Auctions</label>
        </div>
      </li>

    </ul>
  </div>
</nav>


<?php } ?>

<?php function open_card_holder() { ?>

<main class="col ms-sm-auto pt-4 px-md-4">
<p class="fs-3 pt-3"><u>6</u> Results Found</p>
<div class="row row-cols-3 justify-content-start">

<?php } ?>

<?php function close_card_holder() { ?>

</div></main>

<?php } ?>

<!-- From https://codepen.io/glitchworker/pen/XVdKqj -->
<?php function draw_multi_range_slider($id, $min, $max) { ?>

<div slider id="<?=$id?>">
  <div>
    <div inverse-left style="width:70%;"></div>
    <div inverse-right style="width:70%;"></div>
    <div range style="left:30%;right:40%;"></div>
    <span thumb style="left:30%;"></span>
    <span thumb style="left:60%;"></span>
    <div sign style="left:30%;">
      <span id="value">30</span>
    </div>
    <div sign style="left:60%;">
      <span id="value">60</span>
    </div>
  </div>
  <input type="range" tabindex="0" value="30" max="<?=$max?>" min="<?=$min?>" step="1" oninput="
  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[1].style.width=value+'%';
  children[5].style.left=value+'%';
  children[7].style.left=value+'%';children[11].style.left=value+'%';
  children[11].childNodes[1].innerHTML=this.value;" />

  <input type="range" tabindex="0" value="60" max="<?=$max?>" min="<?=$min?>" step="1" oninput="
  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
  var children = this.parentNode.childNodes[1].childNodes;
  children[3].style.width=(100-value)+'%';
  children[5].style.right=(100-value)+'%';
  children[9].style.left=value+'%';children[13].style.left=value+'%';
  children[13].childNodes[1].innerHTML=this.value;" />
</div>

<?php } ?>