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
        $user = User::find(Auth::id());

        $devices = $user->devices()->get();

        return view('device.index')->with('devices', $devices);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new \GuzzleHttp\Client;

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $request->home_location . '&key=AIzaSyDggCeAeLImQC-_UVJmlMSiWSDTgTeor5E');

        $json = $res->getBody();

        $string = json_decode($json, true);

        $lat = $string['results'][0]['geometry']['location']['lat'];
        $lng = $string['results'][0]['geometry']['location']['lng'];

        $this->validate($request, [
            'serial_number' => 'required',
//            'imei' => 'required',
            'name' => 'required',
            'contact_1' => 'required',
//            'center_lat' => 'required',
//            'center_lng' => 'required',

            'radius' => 'required',
            'home_location' => 'required',
        ]);

        $device = Device::where('serial_number', '=', $request->serial_number)->first();

        if (empty($device)) {
            Session::flash('error', 'Device with serial number ' . $request->serial_number . ' is not found.');

            return redirect()->back();
        }

        if (!empty($device->owner_id)) {
            Session::flash('error', 'Owner of device with serial number ' . $request->serial_number . ' already exitsts.');

            return redirect()->back();
        }

        $device->name = $request->name;
        $device->contact_1 = $request->contact_1;
        $device->contact_2 = $request->contact_2;
        $device->contact_3 = $request->contact_3;
        $device->center_lat = $lat;
        $device->center_lng = $lng;
        $device->owner_id = Auth::id();
        $device->radius = $request->radius;
        $device->home_location = $request->home_location;
        $device->save();

//        $device = Device::create([
//            'name' => $request->name,
//            'serial_number' => $request->serial_number,
//            'imei' => $request->imei,
//            'owner_id' => Auth::id(),
//            'contact_1' => $request->contact_1,
//            'contact_2' => $request->contact_2,
//            'contact_3' => $request->contact_3,
//            'center_lat' => $lat,
////                $request->center_lat,
//            'center_lng' => $lng,
////                $request->center_lng,
//            'radius' => $request->radius,
//            'home_location' => $request->location,
//        ]);

        $device->users()->attach(Auth::id());

        Session::flash('success', 'Device added succesfully!');

        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device $device
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);

        $location = Location::where('device_id', $id)->orderby('created_at', 'desc')->first();

        $location_array = Location::where('device_id', $id)->orderBy('id', 'desc')->take(39)->get();
        //->take(5)

        if (empty($location)) {
            Session::flash('error', 'No location data to show.');
            Mapper::map($device->center_lat, $device->center_lng, ['zoom' => 11, 'type' => 'ROADMAP'])
                ->circle([['latitude' => $device->center_lat, 'longitude' => $device->center_lng]],
                    ['strokeColor' => '#FF0000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF0000', 'radius' => $device->radius]);
            return view('device.show')->with('device', Device::find($id));
        }

        Mapper::map($location->latitude, $location->longitude, ['zoom' => 11, 'type' => 'ROADMAP'])
            ->circle([['latitude' => $device->center_lat, 'longitude' => $device->center_lng]],
                ['strokeColor' => '#FF0000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF0000', 'radius' => $device->radius]);

        if (count($location_array) == 39) {
            Mapper::polyline([['latitude' => $location_array[0]->latitude, 'longitude' => $location_array[0]->longitude],
                ['latitude' => $location_array[1]->latitude, 'longitude' => $location_array[1]->longitude],
                ['latitude' => $location_array[2]->latitude, 'longitude' => $location_array[2]->longitude],
                ['latitude' => $location_array[3]->latitude, 'longitude' => $location_array[3]->longitude],
                ['latitude' => $location_array[4]->latitude, 'longitude' => $location_array[4]->longitude],
                ['latitude' => $location_array[5]->latitude, 'longitude' => $location_array[5]->longitude],
                ['latitude' => $location_array[6]->latitude, 'longitude' => $location_array[6]->longitude],
                ['latitude' => $location_array[7]->latitude, 'longitude' => $location_array[7]->longitude],
                ['latitude' => $location_array[8]->latitude, 'longitude' => $location_array[8]->longitude],
                ['latitude' => $location_array[9]->latitude, 'longitude' => $location_array[9]->longitude],
                ['latitude' => $location_array[10]->latitude, 'longitude' => $location_array[10]->longitude],
                ['latitude' => $location_array[11]->latitude, 'longitude' => $location_array[11]->longitude],
                ['latitude' => $location_array[12]->latitude, 'longitude' => $location_array[12]->longitude],
                ['latitude' => $location_array[13]->latitude, 'longitude' => $location_array[13]->longitude],
                ['latitude' => $location_array[14]->latitude, 'longitude' => $location_array[14]->longitude],
                ['latitude' => $location_array[15]->latitude, 'longitude' => $location_array[15]->longitude],
                ['latitude' => $location_array[16]->latitude, 'longitude' => $location_array[16]->longitude],
                ['latitude' => $location_array[17]->latitude, 'longitude' => $location_array[17]->longitude],
                ['latitude' => $location_array[18]->latitude, 'longitude' => $location_array[18]->longitude],
                ['latitude' => $location_array[19]->latitude, 'longitude' => $location_array[19]->longitude],
                ['latitude' => $location_array[20]->latitude, 'longitude' => $location_array[20]->longitude],
                ['latitude' => $location_array[21]->latitude, 'longitude' => $location_array[21]->longitude],
                ['latitude' => $location_array[22]->latitude, 'longitude' => $location_array[22]->longitude],
                ['latitude' => $location_array[23]->latitude, 'longitude' => $location_array[23]->longitude],
                ['latitude' => $location_array[24]->latitude, 'longitude' => $location_array[24]->longitude],
                ['latitude' => $location_array[25]->latitude, 'longitude' => $location_array[25]->longitude],
                ['latitude' => $location_array[26]->latitude, 'longitude' => $location_array[26]->longitude],
                ['latitude' => $location_array[27]->latitude, 'longitude' => $location_array[27]->longitude],
                ['latitude' => $location_array[28]->latitude, 'longitude' => $location_array[28]->longitude],
                ['latitude' => $location_array[29]->latitude, 'longitude' => $location_array[29]->longitude],
                ['latitude' => $location_array[30]->latitude, 'longitude' => $location_array[30]->longitude],
                ['latitude' => $location_array[31]->latitude, 'longitude' => $location_array[31]->longitude],
                ['latitude' => $location_array[32]->latitude, 'longitude' => $location_array[32]->longitude],
                ['latitude' => $location_array[33]->latitude, 'longitude' => $location_array[33]->longitude],
                ['latitude' => $location_array[34]->latitude, 'longitude' => $location_array[34]->longitude],
                ['latitude' => $location_array[35]->latitude, 'longitude' => $location_array[35]->longitude],
                ['latitude' => $location_array[36]->latitude, 'longitude' => $location_array[36]->longitude],
                ['latitude' => $location_array[37]->latitude, 'longitude' => $location_array[37]->longitude],
                ['latitude' => $location_array[38]->latitude, 'longitude' => $location_array[38]->longitude]]);
        }

//        $lines = array();
//
//        foreach ($location_array as $loc){
//            array_push($lines, [['latitude' => $loc->latitude, 'longitude' => $loc->longitude], []);
//        }
//
//
//
//        foreach ($lines as $line){
//            dd($line);
//            Mapper::polyline([['latitude' => $line['latitude'], 'longitude' => $line['longitude']]]);
//        }

        return view('device.show')->with('device', Device::find($id))->with('location', $location)->with('location_array', $location_array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device $device
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('device.edit')->with('device', Device::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Device $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = new \GuzzleHttp\Client;

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $request->home_location . '&key=AIzaSyDggCeAeLImQC-_UVJmlMSiWSDTgTeor5E');

        $json = $res->getBody();

        $string = json_decode($json, true);

        $lat = $string['results'][0]['geometry']['location']['lat'];
        $lng = $string['results'][0]['geometry']['location']['lng'];

        $device = Device::find($id);

        $device->name = $request->name;
//        $device->serial_number = $request->serial_number;
//        $device->imei = $request->imei;
        $device->contact_1 = $request->contact_1;
        $device->contact_2 = $request->contact_2;
        $device->contact_3 = $request->contact_3;
        $device->center_lat = $lat;
        $device->center_lng = $lng;
        $device->radius = $request->radius;
        $device->home_location = $request->home_location;
        $device->save();

        Session::flash('success', 'Device edited successfully!');

        return redirect()->route('device.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);

        $device->users()->detach(Auth::id());

        if($device->owner_id === Auth::id()){
            $device->owner_id = null;
            $device->save();
        }

        Session::flash('success', 'Device deleted succesfully!');

        return redirect()->route('device.index');
    }

    public static function outOfBoundary($id, $state)
    {
        $device = Device::find($id);

        $device->out_of_boundary = $state;

        if ($state !== false) {
            $device->last_message_sent = Carbon::now()->toDateTimeString();
        }

        $device->save();

        return 0;
    }


    public function connect()
    {
        return view('device.connect');
    }

    public function connectToExisting(Request $request)
    {

        $device = Device::where('serial_number', '=', $request->serial_number)->first();

        if (empty($device)) {
            Session::flash('error', 'Device with that Serial Number is not found.');
            return redirect()->back();
        }

        $user = User::find(Auth::id());

        $user->devices()->attach($device->id);

        Session::flash('success', 'Existing device added succesfully!');

        return view('home');
    }
}
