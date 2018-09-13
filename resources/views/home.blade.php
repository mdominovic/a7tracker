@extends('layouts.app')

@section('content')

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


                <div class="panel-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('device.index') }}" class="btn btn-primary btn-lg" role="button" style="margin: 10px auto;width: 100%; height: 150px; text-align: center; line-height: 125px; font-size: 200%">Your devices</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('help') }}" class="btn btn-primary btn-lg" role="button" style="margin: 10px auto;width: 100%; height: 150px; text-align: center; line-height: 125px; font-size: 200%">Help</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('device.create') }}" class="btn btn-primary btn-lg" role="button" style="margin: 10px auto; width: 100%; height: 150px; text-align: center; line-height: 125px; font-size: 200%;">Add new device</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('device.connect') }}" class="btn btn-primary btn-lg" role="button" style="margin: 10px auto;width: 100%; height: 150px; text-align: center; line-height: 125px; font-size: 180%">Connect to device</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
