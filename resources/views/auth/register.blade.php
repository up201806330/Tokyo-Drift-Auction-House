@extends('layouts.app')

@section('content')

<div class="container-fluid sign-in-container fill-height px-0" style="flex: 1;">

    <div class="modal modal-dialog modal-dialog-centered" id="sign-in-content">
        <div class="modal-content">

            <div class="modal-header sign-in-header">
                <h2 class="modal-title mx-auto fw-bold" id="exampleModalLabel">Sign Up</h2>
            </div>

            <hr class="bg-dark border-5 border-top border-dark">

            <div class="row">
                <div class="col">
                    <div id="ui">

                        <form class="form-group" method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="row" style="--bs-gutter-x:0;">
                                <div class="col form-floating mb-3 align-self-start">
                                    <input required type="text" name="firstname" class="form-control" id="floatingInput" placeholder="Jeff">
                                    <label for="floatingInput">First Name</label>

                                    {{-- @if ($errors->has('name'))
                                    <span class="error">
                                        {{ $errors->first('name') }}
                                    </span>
                                    @endif --}}
                                </div>

                                <div class="col form-floating mb-3 ">
                                    <input type="text" name="lastname" class="form-control" id="floatingInput" placeholder="Bezos">
                                    <label for="floatingInput">Last Name</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input required type="text" name="username" class="form-control" id="floatingInput" placeholder="jeffBezzie">
                                <label for="floatingInput">Username</label>

                                {{-- @if ($errors->has('username'))
                                <span class="error">
                                    {{ $errors->first('username') }}
                                </span>
                                @endif --}}
                            </div>

                            <div class="form-floating mb-3">
                                <input required type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email Address</label>
                                
                                {{-- @if ($errors->has('email'))
                                <span class="error">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif --}}

                            </div>

                            <div class="row" style="--bs-gutter-x:0;">
                                <div class="col form-floating mb-3">
                                    <input required type="password" name="password" class="form-control" id="floatingPassword3" placeholder="Password">
                                    <span>
                                        <i class="fa fa-eye" id="font3" onclick="togglePw3()" aria-hidden="true"></i>
                                    </span>
                                    <label for="floatingPassword3">Password</label> 
                                </div>  

                                <div class="col form-floating mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" id="floatingPasswordConfirmation" placeholder="Password">
                                    <span>
                                        <i class="fa fa-eye" id="font2" onclick="togglePw2()" aria-hidden="true"></i>
                                    </span>
                                    <label for="floatingPasswordConfirmation">Confirm Password</label> 
                                </div>  
                            </div>
                            <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                                <button class="btn rounded-pill w-75 fw-bold" href="../pages/profile.php">
                                    Sign up
                                </button>
                            </div>

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

@if($errors->any())
    <div class="notification red-notif">
        <div class="row align-items-center">
            <div class="col-2 rounded-circle cross-container d-flex align-items-center justify-content-center">
                <i class="fa fa-times"></i>
            </div>
            <div class="col justify-content-center">
                {{$errors->first()}}
            </div>
        </div>        
    </div>
@else
    @if(session('success'))
        <div class="notification green-notif">
            <div class="row align-items-center">
                <div class="col-2 rounded-circle cross-container d-flex align-items-center justify-content-center">
                    <i class="fa fa-check"></i>
                </div>
                <div class="col justify-content-center">
                    {{session('success')}}
                </div>
            </div>        
        </div>
    @endif
@endif

@endsection
