<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sikosan - Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="h-100">

    @include('layouts.preloader')

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center">
                                    <h4>SiKosan</h4>
                                </a>

                                <form class="mt-5
                                    mb-5 login-input" method="POST"
                                    action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control @error('email')
                                            is-invalid
                                        @enderror"
                                            name="email" value="{{ old('email') }}" placeholder="Email" required
                                            autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group" x-data="{ show: false }" style="position: relative;">
                                        <input :type="show ? 'text' : 'password'"
                                            class="form-control @error('password')
                                            is-invalid
                                        @enderror"
                                            placeholder="Password" name="password" required
                                            autocomplete="current-password">
                                        <button class="btn btn-outline-secoondary"
                                            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); padding: 0 10px; height: 100%;"
                                            type="button" @click="show = !show">
                                            <span x-text="show ? 'Hide' : 'Show'"></span>
                                        </button>
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Sign In</button>
                                </form>
                                <p class="mt-5
                                        login-form__footer">Dont have
                                    account? <a href="page-register.html" class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.script')
</body>

</html>
