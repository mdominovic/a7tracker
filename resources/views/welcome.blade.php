<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            #first {
                color: #fff;
            }

            #second {
                color: red;
            }

            #sub1 {
                color: #fff;
                font-size: 19px;
            }

            #sub2 {
                color: red;
                font-size: 19px;
            }
            #bg1 {
                position: fixed;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
            }
            #bg1 img {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                margin: auto;
                min-width: 50%;
                min-height: 50%;
            }

            html, body {
                /*background: url('/css/images/home.png');*/
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 600;
                height: 100vh;
                margin: 0;
            }

            /*html {*/
                /*background: url(images/home.jpg) no-repeat center center fixed;*/
                /*-webkit-background-size: cover;*/
                /*-moz-background-size: cover;*/
                /*-o-background-size: cover;*/
                /*background-size: cover;*/
            /*}*/


            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            img.bg {
                /* Set rules to fill background */
                /*min-height: 100%;*/
                min-width: 1024px;

                /* Set up proportionate scaling */
                width: 100%;
                height: auto;

                /* Set up positioning */
                position: fixed;
                top: 0;
                left: 30px;
            }

            @media screen and (max-width: 1024px) { /* Specific to this particular image */
                img.bg {
                    left: 60%;
                    margin-left: -512px;   /* 50% */
                }
            }
        </style>
    </head>
    <body>


    {{--<div id="bg">--}}
        <img class="bg" src="css/images/home.png" alt="">
    {{--</div>--}}


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <span id="first">A7trac</span><span id="second">ker</span>
                </div>

                <div class="links">
                    <span id="sub1">Your best personal trac</span><span id="sub2">ker</span>
                </div>
            </div>
        </div>
    </body>
</html>
