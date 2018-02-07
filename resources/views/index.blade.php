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
                background-color: #ffffff;
                color: #000000;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            
            .booking{
                background: #d9d9d9;
                padding: 10px 20px;
                font-size: 18px;
                font-weight: bold;
                margin-top: 16px;
                display: inline-block;
                display: none;
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

            <div class="container">
                <h3 class="text-center">View Reports</h3>
                <div class="col-sm-6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Start at</td>
                                <td>Booked</td>
                                <td>Account</td>
                                <td>Final Price</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$booking->start_at}}</td>
                                    <td>{{$booking->booked}}</td>
                                    <td>{{$booking->source}}</td>
                                    <td>{{$booking->final_price}}</td>
                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="card text-right">
                            <button class="btn btn-primary" onclick="getTotalBooking()">get total bookings</button>
                        </div>
                        <div class="text-right">
                            <div class="booking">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-right">
                            <p class="lead text-right">
                                Heighst Paid Booking : {{$mostpaidbookings}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="{{url('bootstrap/dist/js/bootstrap.js')}}" type="text/javascript"></script>
        <script>
            function getTotalBooking(){
                if($('.booking')){
                    $('.booking').slideUp();
                    $('.booking p').remove();
                }
                let URL = '{{url("bookingCount")}}';
                console.log(URL);
                $.ajax({
                    url: URL,
                    method: 'GET',
                }).done(function( data ){
                    let html = '';
                    html = '<p class="text-center" style="display:inline-block;"> Bookings = '+ data +'</p>';
                    $('.booking').append(html);
                    $('.booking').slideDown();
                })
            }
        </script>
    </body>
</html>
