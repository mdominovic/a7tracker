@extends('layouts.app')

@section('content')

    <style>
        .hg {
         width: 300px;
        }

    </style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--You are logged in!--}}
                {{--</div>--}}


                <div class="panel-body">
                    {{--<a href="{{ route('device') }}"> My devices </a>--}}

                    <div class="row">

                        <a href="{{ route('device.create') }}" class="btn btn-primary btn-lg" role="button" style="margin: 10px 7px; width: 48%; height: 150px; text-align: center; line-height: 125px; font-size: 200%;">Add new device</a>
                        <a href="{{ route('device.index') }}" class="btn btn-primary btn-lg" role="button" style="float: right; margin: 10px 7px; width: 48%; height: 150px; text-align: center; line-height: 125px; font-size: 200%">Your devices</a>
                    </div>
                    <div class="row">
                        <a href="" class="btn btn-primary btn-lg" role="button" style="margin: 10px 7px; width: 48%; height: 150px; text-align: center; line-height: 125px; font-size: 200%">Help</a>
                        <a href="" class="btn btn-primary btn-lg" role="button" style="float: right; margin: 10px 7px; width: 48%; height: 150px; text-align: center; line-height: 125px; font-size: 200%">About</a>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
