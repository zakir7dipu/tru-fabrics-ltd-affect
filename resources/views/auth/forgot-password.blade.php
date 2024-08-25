<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <title>{{ languageValue(websiteSettings()->name) }} | {{translate('Forget Password')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Bizzsol PLC"/>
    <meta name="keywords" content="Bizzsol PLC"/>
    <meta name="description" content="{{ languageValue(websiteSettings()->slogan) }}"/>
    <meta name="author" content="the LaraSoft">
    <meta name="og:title"
          content="{{ languageValue(websiteSettings()->name) }} | Forget Password"/>
    <meta name="og:type" content="website"/>
    <meta name="og:url" content="{{url('/')}}"/>
    <meta name="og:image"
          content="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}"/>
    <meta name="og:site_name" content="bizzsol.com.bd"/>
    <meta name="og:description"
          content="{{ languageValue(websiteSettings()->slogan) }}"/>

    <link rel="shortcut icon" href="{{asset(websiteSettings()->favicon)}}">
    <script src="{{url('backend')}}/assets/js/hyper-config.js"></script>
    <link href="{{url('backend')}}/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{url('backend')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <script async src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="authentication-bg">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-5">
                <div class="card">
                    <div class="card-header pt-4 pb-4 text-center">
                        <a href="{{url('/')}}">
                            <span>
                                <img
                                    src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}"
                                    alt="logo"
                                    height="100">
                            </span>
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">{{translate('Forget Password')}}</h4>
                            <p class="text-muted mb-4">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                        </div>
                        <div class="text-left w-75 m-auto">
                            <x-auth-session-status class="mb-4" :status="session('status')"/>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{translate('Email address')}}</label>
                                <input class="form-control" type="email" id="email" name="email" required
                                       placeholder="Enter your email" value="{{old('email')}}">
                            </div>
                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary"
                                        type="submit">{{translate('Email Password Reset Link')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    @if (Route::has('register'))
                        <div class="col-12 text-center">
                            <p class="text-muted">{{translate('Dont Have Account')}} <a href="{{ route('register') }}"
                                                                                        class="text-muted ms-1"><b>{{translate('SignUp')}}</b></a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer footer-alt">
    © {{date('Y')}} -
    <span>{{ languageValue(websiteSettings()->name) }} v{{ Illuminate\Foundation\Application::VERSION }} </span>
    {{ languageValue(websiteSettings()->name) }}
    . {{translate('Design And Developed By')}} {{translate('Bizz Solutions PLC')}}
    </p>
</footer>
<script src="{{url('backend')}}/assets/js/vendor.min.js"></script>
<script src="{{url('backend')}}/assets/js/app.min.js"></script>
</body>
</html>
