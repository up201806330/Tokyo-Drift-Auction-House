<?php function draw_user_row() { ?>

<div class="user_row d-flex justify-content-between align-items-center">
    <a href="../pages/profile.php" class="profile_text">
        <div class="d-flex justify-content-start align-items-center">
            <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture_comment m-2" alt="Hanna Green"> 
                <h5 class="my-3 ms-3">Hanna Green</h5>
                <div class="fs-y6 fst-italic text-muted ms-1">@greenOlives24</div>
        </div>
    </a>
    <div class="moderator area text-center">
        <div class="form-group form-check form-switch">
            <input class="form-check-input" type="checkbox" id="private">
        </div>
    </div>
</div>

<?php } ?>