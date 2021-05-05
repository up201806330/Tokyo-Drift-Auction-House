<?php function draw_user_row() { ?>

<div class="user_row d-flex justify-content-between align-items-center">
    <a href="../pages/profile.php" class="profile_text">
        <div class="d-flex justify-content-start align-items-center">
            <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture_comment m-2" alt="Hanna Green"> 
                <h5 class="my-3 ms-3" style="color: rgb(204, 174, 2)">Hanna Green</h5>
                <div class="fs-y6 fst-italic text-muted ms-1 d-none d-sm-inline">@greenOlives24</div>
        </div>
    </a>
    <div class="moderator area text-center">
        <div class="form-group form-check form-switch">
            <input class="form-check-input" type="checkbox" id="private">
        </div>
    </div>
</div>

<?php } ?>

<?php function draw_user_row_alt() { ?>

<div class="user_row d-flex justify-content-between align-items-center">
    <a href="../pages/profile.php" class="profile_text">
        <div class="d-flex justify-content-start align-items-center">
            <img src="https://sunrift.com/wp-content/uploads/2014/12/Blake-profile-photo-square.jpg" class="rounded-circle profile_picture_comment m-2" alt="Hank Geller"> 
                <h5 class="my-3 ms-3">Hank Geller</h5>
                <div class="fs-y6 fst-italic text-muted ms-1 d-none d-sm-inline">@hanky.Pants</div>
        </div>
    </a>
    <div class="moderator area text-center">
        <div class="form-group form-check form-switch">
            <input class="form-check-input" type="checkbox" id="private">
        </div>
    </div>
</div>

<?php } ?>

<?php function draw_user_row_mod($idn) { ?>

<div class="accordion-item">
    <div class="accordion-header" id="heading<?=$idn?>">
        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$idn?>" aria-controls="collapse<?=$idn?>">
            <a class="profile_text">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture_comment m-2" alt="Hanna Green"> 
                        <h5 class="my-3 ms-3" style="color: rgb(204, 174, 2)">Hanna Green</h5>
                        <div class="fs-y6 fst-italic text-muted ms-1 d-none d-sm-inline">@greenOlives24</div>
                </div>
            </a>
        </button>
        <div id="collapse<?=$idn?>" class="accordion-collapse collapse" aria-labelledby = "heading<?=$idn?>" data-bs-parent="#userAccordion">
            <div class="accordion-body">
                <div class="row p-2 rounded mb-1">
                    <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Seller">
                        <i class="fas fa-store fa-3x fs-2"></i>
                    </a>
                    <h5 class="green d-none d-sm-inline col pt-1">Seller privileges</h5>
                    <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                </div>
                <hr/>
                <div class="row p-2 rounded mb-1">
                    <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Buyer">
                        <i class="fas fa-wallet fa-3x fs-2"></i>
                    </a>
                    <h5 class="red d-none d-sm-inline col pt-1">Buyer privileges</h5>
                    <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                </div>
                <hr/>
                <div class="row p-2 rounded mb-1">
                    <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Admin">
                        <i class="fas fa-user-cog fa-3x fs-2"></i>
                    </a>
                    <h5 class="gold d-none d-sm-inline col pt-1">Admin privileges</h5>
                    <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                </div>
                <hr/>
                <div class="row p-2 rounded mb-1">
                    <button type="button" class="btn btn-outline-danger">Ban User</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php function draw_user_row_mod_alt($idn) { ?>

<div class="accordion-item">
    <div class="accordion-header" id="heading<?=$idn?>">
        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$idn?>" aria-controls="collapse<?=$idn?>">
            <a class="profile_text">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="https://sunrift.com/wp-content/uploads/2014/12/Blake-profile-photo-square.jpg" class="rounded-circle profile_picture_comment m-2" alt="Hanna Green"> 
                        <h5 class="my-3 ms-3">Hank Geller</h5>
                        <div class="fs-y6 fst-italic text-muted ms-1 d-none d-sm-inline">@hanky.Pants</div>
                </div>
            </a>
        </button>
        <div id="collapse<?=$idn?>" class="accordion-collapse collapse" aria-labelledby = "heading<?=$idn?>" data-bs-parent="#userAccordion">
            <div class="accordion-body">
            <div class="row p-2 rounded mb-1">
                    <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Seller">
                        <i class="fas fa-store fa-3x fs-2"></i>
                    </a>
                    <h5 class="green d-none d-sm-inline col pt-1">Seller privileges</h5>
                    <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                </div>
                <hr/>
                <div class="row p-2 rounded mb-1">
                    <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Buyer">
                        <i class="fas fa-wallet fa-3x fs-2"></i>
                    </a>
                    <h5 class="red d-none d-sm-inline col pt-1">Buyer privileges</h5>
                    <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                </div>
                <hr/>
                <div class="row p-2 rounded mb-1">
                    <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Admin">
                        <i class="fas fa-user-cog fa-3x fs-2"></i>
                    </a>
                    <h5 class="gold d-none d-sm-inline col pt-1">Admin privileges</h5>
                    <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </div>
                <hr/>
                <div class="row p-2 rounded mb-1">
                    <button type="button" class="btn btn-outline-danger">Ban User</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
