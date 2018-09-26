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

                        @if(!is_null($device->contact_1))
                        <li class="list-group-item">
                            Contact #1: {{ $device->contact_1 }}
                        </li>
                        @endif

                        @if(!is_null($device->contact_2))
                        <li class="list-group-item">
                            Contact #2: {{ $device->contact_2 }}
                        </li>
                        @endif

                        @if(!is_null($device->contact_3))
                        <li class="list-group-item">
                            Contact #3: {{ $device->contact_3 }}
                        </li>
                        @endif

                        <li class="list-group-item">
                            Home location: {{ $device->home_location }}
                        </li>
                        <li class="list-group-item">
                            Boundary radius: {{ $device->radius }} m
                        </li>
                    </ul>
                </div>


                @if(!empty($location))
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Altitude: {{ number_format($location->altitude, 0, '.', ',') }} m
                        </li>
                        <li class="list-group-item">
                            Speed: {{ $location->speed }} km/h
                        </li>
                        <li class="list-group-item">
                            Satellites: {{ $location->satellites }}
                        </li>

                        @if(Carbon\Carbon::parse($location->created_at)->addHours(2)->addMinutes(15) > Carbon\Carbon::now()->addHours(2))
                        <li class="list-group-item" >
                        @else
                        <li class="list-group-item" style="background-color: grey; color: white;">
                        @endif
                            Last update: {{ Carbon\Carbon::parse($location->created_at)->addHours(2) }}
                        </li>
                    </ul>
                </div>
                @endif
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


                    <div class="panel-heading">Location</div>



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
