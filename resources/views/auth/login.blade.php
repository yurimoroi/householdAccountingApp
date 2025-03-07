<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
</head>

<body>
    <div class="p-login">
        <h1 class="p-login__title">Login</h1>

        <div class="p-login__container">
            <div class="p-login__left">
                <h2 class="p-login__subtitle">For Registered Members</h2>

                <form method="POST" action="{{ route('login') }}" class="p-login__form">
                    @csrf

                    <div class="p-login__form-group">
                        <label for="email" class="p-login__label">Email Address (ID)</label>
                        <input id="email" type="email" class="p-login__input @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="p-login__error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="p-login__form-group">
                        <label for="password" class="p-login__label">Password</label>
                        <input id="password" type="password"
                            class="p-login__input @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="p-login__error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="p-login__show-password">
                        <input type="checkbox" id="show-password" class="p-login__checkbox">
                        <label for="show-password">Show Password</label>
                    </div>

                    <button type="submit" class="p-login__button">
                        Login and Continue
                    </button>
                </form>
            </div>

            <div class="p-login__right">
                <h2 class="p-login__subtitle">For New Users</h2>
                <p class="p-login__text">
                    If you are not registered yet, please proceed to new member registration.
                </p>
                {{-- <a href="{{ route('register') }}" class="p-login__register-button"> --}}
                <a href="#" class="p-login__register-button">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</body>

</html>
