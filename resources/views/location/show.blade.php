@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-3">

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Name
                        </li>
                        <li class="list-group-item">
                            Contact #1: 0991234567
                        </li>
                        <li class="list-group-item">
                            Contact #2: 0991234567
                        </li>
                        <li class="list-group-item">
                            Contact #3: 0991234567
                        </li>
                    </ul>
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{ $device->altitude }}
                        </li>
                        <li class="list-group-item">
                            Speed: 4 km/h
                        </li>
                        <li class="list-group-item">
                            Satelittes: 4
                        </li>
                        <li class="list-group-item">
                            Last update: 01-04-2018 15:38:42
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">



                <div class="panel panel-default">


                    <div class="panel-heading">Dashboard</div>



                    <div class="panel-body">
                    KARTA
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
