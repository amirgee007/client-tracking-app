@extends('layouts.app')

@section('styles')
    <style>

        .btn-huge{
            padding:25px;
        }

        .full-height {
            height: 50vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
            margin-top: 50px;
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
@stop

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h3> {{__('client.total_clients')}} </h3>
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
    </div>
@endsection

@section('scripts')

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

@stop
