<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
        
.overlay {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 100000;
}

.overlay__inner {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
}

.overlay__content {
    left: 50%;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
}

.spinner {
    width: 75px;
    height: 75px;
    display: inline-block;
    border-width: 2px;
    border-color: rgba(255, 255, 255, 0.05);
    border-top-color: #F05430;
    animation: spin 1s infinite linear;
    border-radius: 100%;
    border-style: solid;
}</style>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
        
        <!-- Scripts -->
        @routes

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body class="font-sans antialiased">
        <div class="overlay">
            <div class="overlay__inner">
                <div class="overlay__content">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <circle cx="27.5" cy="56.5" r="5" fill="#fe718d">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" repeatCount="indefinite" values="56.5;43.5;56.5;56.5" keyTimes="0;0.3;0.6;1" dur="1s" begin="-0.6s"></animate>
                    </circle> <circle cx="42.5" cy="56.5" r="5" fill="#f47e60">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" repeatCount="indefinite" values="56.5;43.5;56.5;56.5" keyTimes="0;0.3;0.6;1" dur="1s" begin="-0.44999999999999996s"></animate>
                    </circle> <circle cx="57.5" cy="56.5" r="5" fill="#f8b26a">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" repeatCount="indefinite" values="56.5;43.5;56.5;56.5" keyTimes="0;0.3;0.6;1" dur="1s" begin="-0.3s"></animate>
                    </circle> <circle cx="72.5" cy="56.5" r="5" fill="#abbd81">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5" repeatCount="indefinite" values="56.5;43.5;56.5;56.5" keyTimes="0;0.3;0.6;1" dur="1s" begin="-0.15s"></animate>
                    </circle>
                </svg>
                </div>
            </div>
        </div>
        @inertia
    </body>
</html>
