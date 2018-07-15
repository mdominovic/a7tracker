@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new device to your account</div>

                    <div class="panel-body">
                        <form action="{{ route('device.update', ['device' => $device->id ]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ $device->name }}" class="form-control">
                                <label for="serial_number">Serial number</label>
                                <input type="text" name="serial_number" value="{{ $device->serial_number }}" class="form-control">
                                <label for="imei">IMEI</label>
                                <input type="text" name="imei" value="{{ $device->imei }}" class="form-control">
                                <label for="contact_1">Contact #1</label>
                                <input type="text" name="contact_1" value="{{ $device->contact_1 }}" class="form-control">
                                <label for="contact_2">Contact #2</label>
                                <input type="text" name="contact_2" value="{{ $device->contact_2 }}" class="form-control">
                                <label for="contact_1">Contact #3</label>
                                <input type="text" name="contact_3" value="{{ $device->contact_3 }}" class="form-control">
                                <label for="center_lng">Home longitude</label>
                                <input type="text" name="center_lng" value="{{ $device->center_lng }}" class="form-control">
                                <label for="center_lat">Home latitude</label>
                                <input type="text" name="center_lat" value="{{ $device->center_lat }}" class="form-control">
                                <label for="radius">Radius</label>
                                <input type="text" name="radius" value="{{ $device->radius }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                        Edit device
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
