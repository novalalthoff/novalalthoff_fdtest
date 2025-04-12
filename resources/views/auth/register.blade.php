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
                    <div class="login-main">
                        <form id="main-form" class="theme-form" action="{{ route('auth.loginProcess') }}" method="POST">
                            @csrf

                            <h4 class="mb-4">Create an Account</h4>

                            <div class="form-group">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control" type="email" name="email" placeholder="example@gmail.com" required>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <input class="form-control" type="password" name="password" placeholder="*********" required>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="*********" required>
                            </div>

                            <div class="mt-4 col-12">
                                <button id="submit-button" class="btn btn-primary btn-block w-100" type="submit">Sign up</button>
                            </div>

                            <p class="mt-4 mb-0 text-center">
                                Have an account?
                                <a class="ms-2" href="{{ route('auth.login') }}">Sign in</a>
                            </p>
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
    });
</script>
@endsection
