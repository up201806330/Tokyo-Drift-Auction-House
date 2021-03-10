<?php function draw_signup() {
    /**
     * Draws sign up page
     */
    ?>

<div class="modal modal-dialog modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header sign-in-header">
            <h2 class="modal-title mx-auto fw-bold" id="exampleModalLabel">Sign Up</h2>
        </div>

        <hr class="bg-dark border-5 border-top border-dark">

        <div class="row">
            <div class="col">
                <div id="ui">

                    <form class="form-group">
                        <div class="row" style="--bs-gutter-x:0;">
                            <div class="col form-floating mb-3 align-self-start">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">First Name</label>
                            </div>

                            <div class="col form-floating mb-3 ">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Last Name</label>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Username</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email Address</label>
                        </div>

                        <div class="row" style="--bs-gutter-x:0;">
                            <div class="col form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <span>
                                    <i class="fa fa-eye" id="font" onclick="togglePw()" aria-hidden="true"></i>
                                </span>
                                <label for="floatingPassword">Password</label> 
                            </div>  

                            <div class="col form-floating mb-3">
                                <input type="password" name="password2" class="form-control" id="floatingPassword2" placeholder="Password">
                                <span>
                                    <i class="fa fa-eye" id="font2" onclick="togglePw2()" aria-hidden="true"></i>
                                </span>
                                <label for="floatingPassword2">Confirm Password</label> 
                            </div>  
                        </div>
                        <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                            <button type="button" class="btn btn-primary w-75 fw-bold">
                                Sign up
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-5"><hr class="bg-dark border-5 border-top border-dark"></div>
                            <div class="col-2 text-center">or</div>
                            <div class="col-5"><hr class="bg-dark border-5 border-top border-dark"></div>
                        </div>
                        

                        <!-- google button -->
                        <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                            <div class='g-sign-in-button'>
                                <div class=content-wrapper>
                                    <div class='logo-wrapper'>
                                        <img src='https://developers.google.com/identity/images/g-logo.png'>
                                    </div>
                                    <span class='text-container'>
                                        <span>Sign in with Google</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <hr class="bg-dark border-5 border-top border-dark">

                        <div class="modal-footer justify-content-center"> 
                            Already have an account? 
                            <a href="#" class="blue-text ml-1">
                                Log in
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>



<?php } ?>