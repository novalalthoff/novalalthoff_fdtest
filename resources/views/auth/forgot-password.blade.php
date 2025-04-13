@extends('layouts/auth')

@section('css-library')
@endsection

@section('css-custom')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div class="mb-4 col-12 text-center">
                        <a href="{{ url('') }}">
                            <img class="img-fluid for-light" src="{{ asset('favicon.png') }}" width="20%" alt="home">
                        </a>
                    </div>
                    <div class="login-main">
                        <form id="main-form" class="theme-form" action="{{ route('auth.forgot') }}" method="POST">
                            @csrf

                            <h4 class="mb-4">Create an Account</h4>

                            <div class="form-group">
                                <label class="col-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                <input class="form-control" id="email" type="email" name="email" placeholder="example@mail.com" required>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Verification Code <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="code" placeholder="Check your email✨" required>
                            </div>

                            <p class="mb-0">
                                <a href="#!" id="resend-button" class="ms-2" type="button">
                                    Resend code?
                                </a>
                            </p>

                            <div class="form-group">
                                <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password" placeholder="___" required>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="___" required>
                            </div>

                            <div class="mt-4 col-12">
                                <button id="submit-button" class="btn btn-primary btn-block w-100" type="submit">Submit</button>
                            </div>

                            <p class="mt-4 mb-0 text-center">
                                Already configured?
                                <a class="ms-2" href="{{ route('login') }}">Sign in</a>
                            </p>
                        </form>
                        <form id="resend-code-form" action="{{ route('auth.verifyResend') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="url" value="forgot-password">
                            <input type="hidden" id="email2" name="email" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        $('#main-form').on('submit', function(e) {
            e.preventDefault();
            submitForm($(this), $('#submit-button'));
        });
        $('#resend-button').on('click', function(e) {
            e.preventDefault();
            $('#email2').val($('#email').val());
            document.getElementById('resend-code-form').submit();
        });
    });
</script>
@endsection
