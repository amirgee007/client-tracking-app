@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    Nu binnen
                </div>
                <div class="card-body">
                    <h1 class="card-title" style="font-size: 7.25rem; margin-top: 15px; margin-bottom: 15px;"><span id="currentCounter">{{$counter->counter}}</span></h1>
                </div>
                <div class="card-footer text-muted">
                    <small>
                        <a id="refreshBtn" style="color: red" href="javascript:void(0)" title="Refresh Now"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        <span id="lastRefresh">Last refresh at {{now()}}</span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>

        $( document ).ready(function() {
            setInterval(getLatestClients, 300000);

            $("#refreshBtn").click(function(){
                getLatestClients();
            });
        });

        function getLatestClients(){
            $.ajax({
                url: "{{ route('getLatestCount') }}",
                method: 'get',
                success: function (responseHtml) {
                    $('#currentCounter').text(responseHtml.counter);
                    $('#lastRefresh').text(responseHtml.message);
                    //currentCounter
                }
            });
        }
    </script>

@stop
