<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Session;
use Notification;
use Carbon\Carbon;
use App\Device;
use App\Location;
use Illuminate\Http\Request;
use Mapper;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('device.index')->with('devices', Device::where('user_id', Auth::id())->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('device.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $client = new \GuzzleHttp\Client;

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $request->location . '&key=AIzaSyDggCeAeLImQC-_UVJmlMSiWSDTgTeor5E');

        $json = $res->getBody();

        $string = json_decode($json, true);

        $lat = $string['results'][0]['geometry']['location']['lat'];
        $lng = $string['results'][0]['geometry']['location']['lng'];


        $this->validate($request, [
            'serial_number' => 'required',
            'imei' => 'required',
            'name' => 'required',
            'contact_1' => 'required',
//            'center_lat' => 'required',
//            'center_lng' => 'required',

            'radius' => 'required',
        ]);

        $device = Device::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'imei' => $request->imei,
            'user_id' => Auth::id(),
            'contact_1' => $request->contact_1,
            'contact_2' => $request->contact_2,
            'contact_3' => $request->contact_3,
            'center_lat' => $lat,
//                $request->center_lat,
            'center_lng' => $lng,
//                $request->center_lng,
            'radius' => $request->radius,
            'home_location' => $request->location,
        ]);

        Session::flash('success', 'Device added succesfully!');

        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);

        $location = Location::where('device_id', $id)->orderby('timestamp', 'desc')->first();

        $location_array = Location::orderBy('id', 'desc')->take(5)->get();

        Mapper::map($location->latitude, $location->longitude, ['zoom' => 11, 'type' => 'ROADMAP'])
            ->circle([['latitude' => $device->center_lat, 'longitude' => $device->center_lng]],
                ['strokeColor' => '#FF0000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF0000', 'radius' => $device->radius]);

        if(count($location_array) <= 5) {
            Mapper::polyline([['latitude' => $location_array[0]->latitude, 'longitude' => $location_array[0]->longitude],
                ['latitude' => $location_array[1]->latitude, 'longitude' => $location_array[1]->longitude],
                ['latitude' => $location_array[2]->latitude, 'longitude' => $location_array[2]->longitude],
                ['latitude' => $location_array[3]->latitude, 'longitude' => $location_array[3]->longitude],
                ['latitude' => $location_array[4]->latitude, 'longitude' => $location_array[4]->longitude]]);
        }

        return view('device.show')->with('device', Device::find($id))->with('location', $location)->with('location_array', $location_array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('device.edit')->with('device', Device::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client;

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $request->location . '&key=AIzaSyDggCeAeLImQC-_UVJmlMSiWSDTgTeor5E');

        $json = $res->getBody();

        $string = json_decode($json, true);

        $lat = $string['results'][0]['geometry']['location']['lat'];
        $lng = $string['results'][0]['geometry']['location']['lng'];

        $device = Device::find($id);

        $device->name = $request->name;
        $device->serial_number = $request->serial_number;
        $device->imei = $request->imei;
        $device->contact_1 = $request->contact_1;
        $device->contact_2 = $request->contact_2;
        $device->contact_3 = $request->contact_3;
        $device->center_lat = $lat;
        $device->center_lng = $lng;
        $device->radius = $request->radius;
        $device->save();

        Session::flash('success', 'Device edited successfully!');

        return redirect()->route('device.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Device::destroy($id);

        Session::flash('success', 'Device deleted succesfully!');

        return redirect()->route('device.index');
    }

    public static function outOfBoundary($id, $state) {
        $device = Device::find($id);

        $device->out_of_boundary = $state;

        if($state !== false) {
            $device->last_message_sent = Carbon::now()->toDateTimeString();
        }

        $device->save();

        return 0;
    }
}
