<?php function draw_login() {
    /**
     * Draws login overlay
     */
    ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header login-close-cross">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-header login-header">
            <h2 class="modal-title mx-auto fw-bold" id="exampleModalLabel">Login</h2>
        </div>

        <hr class="bg-dark border-4 border-top border-dark">

        <div class="modal-body mx-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating">

                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">

                <span>
                    <i class="fa fa-eye" id="font" onclick="togglePw()" aria-hidden="true"></i>
                </span>
                
                <label for="floatingPassword">Password</label> 
            </div>     
        
            <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                <a role="button" class="btn w-100 fw-bold" href="../pages/profile.php">
                    Login
                </a>
            </div>
        </div>

        <hr class="bg-dark border-4 border-top border-dark">

        <div class="modal-footer justify-content-center"> 
            Don't have an account? 
            <a href="../pages/sign-up.php" class="blue-text ml-1">
                Sign up
            </a>
        </div>
    </div>
  </div>
</div>

<?php } ?>