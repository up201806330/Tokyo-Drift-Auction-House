@extends('layouts.app')

@section('head')
    <script src="{{ asset('js/PasswordInput.js')}}"></script>
@endsection

@section('content')

<div class="sign-in-container">

    <div class="modal modal-dialog modal-dialog-centered" id="sign-up-content">
        <div class="modal-content">

            <div class="modal-header sign-in-header">
                <h2 class="modal-title mx-auto fw-bold" id="exampleModalLabel">Reset password</h2>
            </div>

            <hr class="bg-dark border-5 border-top border-dark">

            <div class="row">
                <div class="col">
                    <div id="ui">

                        <form class="form-group" method="post" action="{{ route('password.reset') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ request()->token }}">

                            <input type="hidden" name="email" value="{{ request()->email }}">

                            <div class="form-floating mb-3">
                            <input required type="password" name="password" class="form-control" placeholder="Password">
                                <span>
                                    <i class="fa fa-eye" id="font3" onclick="PasswordInput.toggle(this, 'password');" aria-hidden="true"></i>
                                </span>
                                <label for="floatingPassword3">Password</label> 
                            </div>  

                            <div class="form-floating mb-3">
                                <input required type="password" name="password_confirmation" class="form-control" placeholder="Password">
                                <span>
                                    <i class="fa fa-eye" id="font2" onclick="PasswordInput.toggle(this, 'password_confirmation');" aria-hidden="true"></i>
                                </span>
                                <label for="floatingPasswordConfirmation">Confirm Password</label> 
                            </div>  

                            <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                                <button class="btn rounded-pill w-75 fw-bold" href="../pages/profile.php">
                                    Reset password
                                </button>
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
