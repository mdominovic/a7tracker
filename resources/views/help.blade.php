@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Help</div>

                    <div class="panel-body">
                        <p><strong>How to setup device and account</strong></p>

                        <p>After you have registered and added your device turn it on and leave it on for few minutes for location data to fill. In "Your devices" section you can see all your added
                            and connected devices. If you are a owner of a device you can Edit device's settings, or if you don't want to be connected to some of your devices you can press Delete device to remove it from your account.
                            "My devices" table has Status indicator of devices location relevancy. If location data of particular device is not updated in last 30 minutes, it is grey colour. If it is inside of boundary
                            Status indicator is green and if it is outside of given radius it is red.
                        </p>

                        <div style="display: flex; justify-items: center">
                            <div style="height: 20px; width: 20px; background-color: #7CFC00; border-radius: 50%; display: inline-block;"></div>
                            <div style="height: 20px; width: 20px; background-color: red; border-radius: 50%; display: inline-block;"></div>
                            <div style="height: 20px; width: 20px; background-color: grey; border-radius: 50%; display: inline-block;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection