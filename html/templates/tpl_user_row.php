<?php function draw_user_row() { ?>

<div class="user_row d-flex justify-content-between align-items-center">
    <a href="../pages/profile.php" class="profile_text">
        <div class="d-flex justify-content-start align-items-center">
            <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture_comment" alt="Hanna Green"> 
                <h6 class="m-3">Hanna Green</h6>
        </div>
    </a>
    <div class="moderator area text-center">
        <div class="form-group form-check form-switch">
            <input class="form-check-input" type="checkbox" id="private">
        </div>
    </div>
</div>

<?php } ?>