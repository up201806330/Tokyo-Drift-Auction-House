@extends('layouts.app')

@section('title', 'Get password reset link')

@section('head')
    <script src="{{ asset('js/ResetPassword.js') }}"></script>
@endsection

@section('content')

<div class="container-fluid sign-in-container fill-height px-0" style="flex: 1;">

    <div class="modal modal-dialog modal-dialog-centered" id="sign-in-content">
        <div class="modal-content">

            <div class="modal-header sign-in-header">
                <h2 class="modal-title mx-auto fw-bold" id="exampleModalLabel">Get password reset link</h2>
            </div>

            <hr class="bg-dark border-5 border-top border-dark">

            <div class="row">
                <div class="col">
                    <div id="ui">

                        <form class="form-group" onsubmit="let r = ResetPassword.fromForm(this); r.submit().then((response) => { r.processResponse(response); }); return false;">
                            <div class="form-floating mb-3">
                                <input required type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email Address</label>
                            </div>

                            <div class="modal-footer justify-content-center login-button px-5 pt-3"> 
                                <button class="btn rounded-pill w-75 fw-bold" href="../pages/profile.php">
                                    Reset password
                                </button>
                            </div>

                        </form>

                        <div id="password-reset-confirmation" class="text-success" style="display: none">
                            A password recovery email was sent to that address!
                        </div>
                        <div id="password-reset-throttled" class="text-danger" style="display: none">
                            Easy, boy! You have already requested a password reset a while ago, so we throttled this request.
                        </div>
                        <div id="password-reset-generic-error" class="text-danger" style="display: none">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
