<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{url('bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet" type="text/css" >
        <link href="{{url('bootstrap/dist/css/bootstrap-theme.css')}}" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Import Excel Sheet.
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <form method="POST" enctype="multipart/form-data" action="{{url('parser')}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="file" name="bookingsheet" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="pull-right">
                                        <input type="submit" value="upload" class="btn btn-primary">                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{url('bootstrap/dist/js/bootstrap.js')}}" type="text/javascript"></script>
    </body>
</html>
