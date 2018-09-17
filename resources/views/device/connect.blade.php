@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Connect to existing device</div>

                    <div class="panel-body">
                        <form action="{{ route('device.connectToExisting') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="serial_number">Serial number</label>
                                <input type="text" name="serial_number" value="" class="form-control">
                            </div>


                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                        Connect to device
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
