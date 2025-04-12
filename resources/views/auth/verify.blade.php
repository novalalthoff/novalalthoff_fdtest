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
                        <form id="main-form" class="theme-form" action="{{ route('auth.verifyProcess', ['id' => $user->id]) }}" method="POST">
                            @csrf

                            <h4 class="mb-4">Verify your Account</h4>

                            <div class="form-group">
                                <label class="col-form-label">Email Address <small class="text-danger">(auto)</small></label>
                                <input class="form-control" type="text" name="email" value="{{ $user->email }}" disabled>
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

                            <div class="mt-3 col-12">
                                <button id="submit-button" class="btn btn-primary btn-block w-100" type="submit">Submit</button>
                            </div>
                        </form>

                        <form id="resend-code-form" action="{{ route('auth.verifyResend') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="url" value="verify">
                            <input type="hidden" name="id" value="{{ $user->id }}">
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
            document.getElementById('resend-code-form').submit();
        });
    });
</script>
@endsection
