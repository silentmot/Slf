<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>SLF Client Logs</title>

        <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAABP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABAAAQAAAAABEAABEAAAABEAAAARAAABEAEAAAEQABEAARAAABEBEAAAEQAAARARAAABEAARAAEQAAAQARAAABEAAAARAAAAARAAARAAAAAAEAABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" />
        <link href="{{ asset('css/css.css') }}" rel="stylesheet">
        <link href="{{ asset('css/css2.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 crossorigin="anonymous">

        <style>
            body {
                font-family: 'Press Start 2P', cursive;
            }
            table {
                font-size: 12px;
            }
            .row {
                margin: 0px!important;
            }
            .slf-header {
                background: linear-gradient(330deg, #e05252 0%, #99e052 25%, #52e0e0 50%, #9952e0 75%, #e05252 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .slf-header, .slf-header:hover {
                text-decoration: none !important;
            }
            .slf-home-header {
                background: linear-gradient(330deg, #e05252 0%, #99e052 25%, #52e0e0 50%, #9952e0 75%, #e05252 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .ascii {
                font-family: 'Roboto', sans-serif;
                font-size: 10px;
                padding-left: 35%;
                line-height: 9px;
                background: linear-gradient(330deg, #e05252 0%, #99e052 25%, #52e0e0 50%, #9952e0 75%, #e05252 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .ascii pre {
                margin-bottom: 0px;
            }
            .ascii-home {
                font-family: 'Roboto', sans-serif;
                font-size: 25px;
                background: linear-gradient(330deg, #e05252 0%, #99e052 25%, #52e0e0 50%, #9952e0 75%, #e05252 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .ascii-home pre {
                margin-bottom: 0px;
            }
            .logo {
                max-height: 50px;
                max-width: 200px;
            }
        </style>
    </head>
    <body class="text-light bg-dark">
        <div class="container mt-3 mb-5">
            @yield('content')
        </div>
         <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
         <script src="{{ asset('js/popper.min.js') }}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
         <script src="{{ asset('js/bootstrap.min.js') }}" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>
