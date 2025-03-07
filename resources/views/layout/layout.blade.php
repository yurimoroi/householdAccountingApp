<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <title>@yield('title')</title>
</head>

<body class="container">
    <header class="l-header">
        <div class="e-ham">
            <hr>
            <hr>
            <hr>
        </div>

        <h1 class="e-title">HouseHoldExpenses - @yield('display_name')</h1>


        <form role="form" action="{{ route('logout') }}" method="POST" class="e-form">
            @csrf
            <svg class="e-logout" width="80" height="80" viewBox="0 0 80 80" fill="none">
                <path
                    d="M44.9233 70.8167H27.7999C23.4937 71.0136 19.2832 69.5071 16.0792 66.6231C12.8753 63.7392 10.9357 59.7098 10.6799 55.4067V24.5934C10.9357 20.2903 12.8753 16.2609 16.0792 13.377C19.2832 10.493 23.4937 8.98654 27.7999 9.18338H44.9199"
                    stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M69.3166 40H24.8066" stroke="#fff" stroke-width="3" stroke-miterlimit="10"
                    stroke-linecap="round" />
                <path
                    d="M53.6099 57.12L68.2899 42.44C68.9331 41.7908 69.294 40.9139 69.294 40C69.294 39.0861 68.9331 38.2092 68.2899 37.56L53.6099 22.88"
                    stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </form>
    </header>

    <aside class="l-sidebar">
        <div class="e-blank"></div>

        <ul class="e-list">
            <li class="e-item">
                <a href="/dashboard" class="e-link">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path
                            d="M13.3334 26.6667V18.6667H18.6667V26.6667H25.3334V16H29.3334L16 4L2.66669 16H6.66669V26.6667H13.3334Z"
                            fill="#666666" />
                    </svg>

                    <span class="e-link-text">Dashboard</span>
                </a>
            </li>
            <li class="e-item">
                <a href="/report" class="e-link">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M1.14285 1.14288V30.8572H30.8571" stroke="#666666" stroke-width="2.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8 14.8572L13.7143 20.5715L22.8571 6.85718L30.8571 12.5715" stroke="#666666"
                            stroke-width="2.28571" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="e-link-text">Report</span>
                </a>
            </li>
        </ul>
    </aside>

    <main class="l-main @yield('class_name')">
        @section('main') @show
    </main>

    <script src="{{ asset('/js/common.js') }}"></script>
</body>

</html>
