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


                <div class="panel-body">
                    {{--<a href="{{ route('device') }}"> My devices </a>--}}
                    <a href="{{ route('device.create') }}" class="btn btn-primary btn-lg" role="button">Add new device</a>
                    <a href="" class="btn btn-primary btn-lg" role="button">Your devices</a>
                    <a href="" class="btn btn-primary btn-lg" role="button">Help</a>
                    <a href="" class="btn btn-primary btn-lg" role="button">Contact</a>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
