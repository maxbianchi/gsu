@extends('app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <img src="{{ URL::asset('images/logo.png') }}">
            </div>
            <div class="col-md-offset-6 col-md-3">
                <img src="{{ URL::asset('images/logo_unigate.png') }}">
            </div>
        </div>


        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Portale UniWeb 4.0 <span class="pull-right"></span></div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-2">
                                <button type="button" class="btn btn-primary">MOBILE</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" onclick="location.href='{{url('/gsu/index')}}'">GSU</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary">UNIGATE</button>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>

@endsection