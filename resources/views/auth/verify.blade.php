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
                                <span id="loading-text" class="text-muted ms-2"></span>
                                <a href="javascript:void(0);" id="resend-button" class="ms-2" style="display:none;" type="button">
                                    Resend code?
                                </a>
                                <span id="countdown-text" class="text-muted ms-2" style="display:none;"></span>
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
    const RESEND_COOLDOWN_SECONDS = 60;
    const STORAGE_KEY = 'resend_cooldown_expires_at';

    function startCountdown(expiryTimestamp) {
        const $resendBtn = $('#resend-button');
        const $countdownText = $('#countdown-text');
        const interval = setInterval(() => {
            const now = Date.now();
            const secondsLeft = Math.floor((expiryTimestamp - now) / 1000);
            if (secondsLeft <= 0) {
                clearInterval(interval);
                localStorage.removeItem(STORAGE_KEY);
                $countdownText.hide();
                $resendBtn.show();
            } else {
                $countdownText.html(`<span class="text-info">Resend available in</span> ${secondsLeft}s`).show();
                $resendBtn.hide();
            }
        }, 1000);
    }

    $(function () {
        $('#main-form').on('submit', function(e) {
            e.preventDefault();
            submitForm($(this), $('#submit-button'));
        });

        const existingExpiry = localStorage.getItem(STORAGE_KEY);

        const $loadingText = $('#loading-text');
        let loadingTimeLeft = 3;
        const loadingInterval = setInterval(() => {
            loadingTimeLeft--;
            if (loadingTimeLeft <= 0) {
                clearInterval(loadingInterval);
                if (existingExpiry && parseInt(existingExpiry) > Date.now()) {
                    startCountdown(parseInt(existingExpiry));
                } else {
                    $('#resend-button').show();
                }
                $loadingText.hide();
            } else {
                $loadingText.html(`<span class="text-warning">Loading, please wait..</span> ${loadingTimeLeft}s`);
            }
        }, 1000);

        $('#resend-button').on('click', function (e) {
            e.preventDefault();
            const expiry = Date.now() + RESEND_COOLDOWN_SECONDS * 1000;
            localStorage.setItem(STORAGE_KEY, expiry.toString());
            submitForm($('#resend-code-form'), $(this));
            startCountdown(expiry);
        });
    });
</script>
@endsection
