@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-3">

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Name: {{ $device->name }}
                        </li>
                        <li class="list-group-item">
                            Contact #1: {{ $device->contact_1 }}
                        </li>
                        <li class="list-group-item">
                            Contact #2: {{ $device->contact_2 }}
                        </li>
                        <li class="list-group-item">
                            Contact #3: {{ $device->contact_3 }}
                        </li>
                    </ul>
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Altitude: {{ $location->altitude }}
                        </li>
                        <li class="list-group-item">
                            Speed: {{ $location->speed }} km/h
                        </li>
                        <li class="list-group-item">
                            Satellites: {{ $location->satellites }}
                        </li>
                        <li class="list-group-item">
                            Last update: {{ $location->timestamp }}
                        </li>
                    </ul>
                </div>
            </div>

            {{--@foreach($location_array as $object)--}}
                {{--{{ $object->altitude }} <br>--}}
                {{--{{ $object->speed }}    <br>--}}
                {{--{{ $object->satellites }}<br>--}}
                {{--{{ $object->timestamp }}<br>--}}
                {{--{{ $object->latitude }}<br>--}}
                {{--{{ $object->longitude }}<br>--}}

            {{--@endforeach--}}

            <div class="col-md-9">



                <div class="panel panel-default">


                    <div class="panel-heading">Dashboard</div>



                    <div class="panel-body">
                        {{--<div id="map" style="width: 800px; height: 400px;">&nbsp;</div>--}}

                        <div style="width: auto; height: 700px;">
                            {!! Mapper::render() !!}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
