<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Klanten binnen</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .btn-huge{
                padding:25px;
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
                font-size: 13px;
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
                    @auth
                        <a href="{{ url('/') }}">Live</a>
                        <a href="{{ route('show') }}">Toon</a>
                        <a href="{{ url('/home') }}">Admin</a>
                    @else
                            <a href="{{ url('/') }}">Live</a>
                            <a href="{{ route('show') }}">Toon</a>
                            <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <h3> Klanten binnen </h3>
                <small>
                    <a id="refreshBtn" style="color: red" href="javascript:void(0)" title="Refresh Now"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                    <span id="lastRefresh">Last refresh at {{now()}}</span>
                </small>
                <br><br>
                <div class="links">
                    <div class="row">
                        <div class="col-sm-4"><button data-id="increment" type="button" class="btn btn-success btn-lg btn-huge"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
                        <div class="col-sm-4"> <p style="font-size: 300%; !important;">  <span id="currentCounter">{{$counter->counter}}</span> </p></div>
                        <div class="col-sm-4"><button data-id="decrement" type="button" class="btn btn-danger btn-lg btn-huge"><i class="fa fa-minus" aria-hidden="true"></i></button></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <script>

            $( document ).ready(function() {
                setInterval(getLatestClients, 10000);

                $("#refreshBtn").click(function(){
                    getLatestClients();
                });

                $(".btn-huge").click(function(){
                    var type = $(this).data('id');

                    $.ajax({
                        url: "{{ route('updateCounter') }}",
                        method: 'post',
                        data: {
                            type: type,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data){
                            $('#currentCounter').text(data.counter);
                        }});
                });
            });

            function getLatestClients(){
                $.ajax({
                    url: "{{ route('getLatestCount') }}",
                    method: 'get',
                    success: function (responseHtml) {
                        $('#currentCounter').text(responseHtml.counter);
                        $('#lastRefresh').text(responseHtml.message);
                    }
                });
            }
        </script>
    </body>

</html>
