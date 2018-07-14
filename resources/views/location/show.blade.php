@extends('layouts.app')


{{--<style>--}}
    {{--#map {--}}
        {{--height: 400px;--}}
        {{--width: 100%;--}}
    {{--}--}}

{{--</style>--}}

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
                    </div>


                </div>
            </div>
        </div>
    </div>


    {{--<script>--}}
        {{--function initMap() {--}}
            {{--map = new google.maps.Map(document.getElementById('map'), {--}}
                {{--center: {lat: 45.55111, lng: 18.69389},--}}
                {{--zoom: 8,--}}
                {{--mapTypeId: 'terrain'--}}
            {{--});--}}

            {{--// Add the circle for this city to the map.--}}
            {{--let cityCircle = new google.maps.Circle({--}}
                {{--strokeColor: '#FF0000',--}}
                {{--strokeOpacity: 0.8,--}}
                {{--strokeWeight: 2,--}}
                {{--fillColor: '#FF0000',--}}
                {{--fillOpacity: 0.35,--}}
                {{--map: map,--}}
                {{--center: {lat: 45.55111, lng: 18.69389},--}}
                {{--radius: 100000--}}
            {{--});--}}
        {{--}--}}

    {{--</script>--}}
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArwnkumGSSbcGCPUWdJQ4ZepcT0v4lW48&callback=initMap"--}}
            {{--async defer></script>--}}
@endsection
