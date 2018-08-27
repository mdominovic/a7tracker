@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new device to your account</div>

                    <div class="panel-body">
                        <form action="{{ route('device.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                <label for="serial_number">Serial number</label>
                                <input type="text" name="serial_number" value="{{ old('serial_number') }}" class="form-control">
                                <label for="imei">IMEI</label>
                                <input type="text" name="imei" value="{{ old('imei') }}" class="form-control">
                                <label for="contact_1">Contact #1</label>
                                <input type="text" name="contact_1" value="{{ old('contact_1') }}" class="form-control">
                                <label for="contact_2">Contact #2</label>
                                <input type="text" name="contact_2" value="{{ old('contact_2') }}" class="form-control">
                                <label for="contact_1">Contact #3</label>
                                <input type="text" name="contact_3" value="{{ old('contact_1') }}" class="form-control">

                                {{--<label for="center_lat">Home latitude</label>--}}
                                {{--<input type="text" name="center_lat" value="{{ old('center_lat') }}" class="form-control">--}}
                                {{--<label for="center_lng">Home longitude</label>--}}
                                {{--<input type="text" name="center_lng" value="{{ old('center_lng') }}" class="form-control">--}}


                                <label for="location">Home location</label>
                                <input name="location" type="text" id="txtPlaces" class="form-control">

                                <label for="radius">Radius</label>
                                <input type="text" name="radius" value="{{ old('radius') }}" class="form-control">

                                {{--<label for="term"> Find your home place </label>--}}
                                {{--<input name="term" type="text" id="search_term" placeholder="Search...">--}}


                            </div>


                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                        Add new device
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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDggCeAeLImQC-_UVJmlMSiWSDTgTeor5E&libraries=places"></script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });
</script>

