@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard
                        <span class="badge badge-danger float-right">Counter Live: {{$counter->counter}}</span></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resetCounter') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Counter Reset to</label>

                                <div class="col-md-8">
                                    <input id="counter" type="number" class="form-control{{ $errors->has('counter') ? ' is-invalid' : '' }}" name="counter" value="0" min="0" required autofocus>

                                    <small>*If there are already some people in the store use that.</small>
                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Reset Counter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
