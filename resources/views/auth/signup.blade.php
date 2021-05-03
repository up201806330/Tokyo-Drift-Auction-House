@extends('layouts.app')

@section('content')

<div class="sign-in-container">

    <div class="modal modal-dialog modal-dialog-centered" id="sign-up-content">
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
                                    <input required type="text" class="form-control" id="floatingInput" placeholder="Jeff">
                                    <label for="floatingInput">First Name</label>
                                </div>

                                <div class="col form-floating mb-3 ">
                                    <input required type="text" class="form-control" id="floatingInput" placeholder="Bezos">
                                    <label for="floatingInput">Last Name</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input required type="text" class="form-control" id="floatingInput" placeholder="jeffBezzie">
                                <label for="floatingInput">Username</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input required type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email Address</label>
                            </div>

                            <div class="row" style="--bs-gutter-x:0;">
                                <div class="col form-floating mb-3">
                                    <input required type="password" name="password3" class="form-control" id="floatingPassword3" placeholder="Password">
                                    <span>
                                        <i class="fa fa-eye" id="font3" onclick="togglePw3()" aria-hidden="true"></i>
                                    </span>
                                    <label for="floatingPassword3">Password</label> 
                                </div>  

                                <div class="col form-floating mb-3">
                                    <input required type="password" name="password2" class="form-control" id="floatingPassword2" placeholder="Password">
                                    <span>
                                        <i class="fa fa-eye" id="font2" onclick="togglePw2()" aria-hidden="true"></i>
                                    </span>
                                    <label for="floatingPassword2">Confirm Password</label> 
                                </div>  
                            </div>
                            <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                                <button class="btn w-75 fw-bold" href="../pages/profile.php">
                                    Sign up
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-5"><hr class="bg-dark border-5 border-top border-dark"></div>
                                <div class="col-2 text-center">or</div>
                                <div class="col-5"><hr class="bg-dark border-5 border-top border-dark"></div>
                            </div>
                            

                            <!-- google button -->
                            <a class="modal-footer justify-content-center login-button pt-3 text-decoration-none" href="../pages/profile.php"> 
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
                            </a>

                            <hr class="bg-dark border-5 border-top border-dark">

                            <div class="modal-footer justify-content-center"> 
                                Already have an account? 
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="blue-text ml-1" role="button">
                                    Log in
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
