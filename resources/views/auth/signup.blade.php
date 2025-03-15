<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
</head>

<body>
    <div class="p-signup">
        <h1 class="p-signup__title">Sign Up</h1>

        <div class="p-signup__container">
            <form method="POST" action="{{ route('signup') }}" class="p-signup__form">
                @csrf

                <div class="p-signup__form-group">
                    <label for="name" class="p-signup__label">Name</label>
                    <input id="name" type="text" class="p-signup__input @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="p-signup__error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="p-signup__form-group">
                    <label for="user_id" class="p-signup__label">User ID</label>
                    <input id="user_id" type="text" class="p-signup__input @error('user_id') is-invalid @enderror"
                        name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id">
                    @error('user_id')
                        <span class="p-signup__error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="p-signup__form-group">
                    <label for="password" class="p-signup__label">Password</label>
                    <input id="password" type="password"
                        class="p-signup__input @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">
                    @error('password')
                        <span class="p-signup__error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="p-signup__button">
                    Sign Up
                </button>

                <div class="p-signup__back">
                    <a href="{{ route('login') }}" class="p-signup__back-link">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
