<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Session;
use Notification;
use GuzzleHttp\Client;
use Mapper;
use App\Device;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('location.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $data_array = explode("*", $data, 7);

        if(Device::where('serial_number', $data_array[6])->first() !== null) {
            $data_ts = explode("--", $data_array[4], 2);

            $d = Device::where('serial_number', $data_array[6])->first();


            $kita = $this->distance($d->id);

            dd();

            $location = Location::create([
                'longitude' => $data_array[0],
                'latitude' => $data_array[1],
                'speed' => $data_array[2],
                'altitude' => $data_array[3],
                'timestamp' => $data_ts[0] . " " . $data_ts[1],
                'satellites' => $data_array[5],
                'serial_number' => $data_array[6],
                'device_id' => $d->id
            ]);




//            if( $this->distance($d->id) > $d->radius ) {
//
//                $devices = array();
//                $users = array();
//
//                $devices = Device::where('serial_number', $data_array[6])->get();
//
//                foreach($devices as $device) {
//                    array_push($users, User::find($device->user_id));
//                }
//
//                Notification::send($users, new \App\Notifications\DeviceOutOfBounds());
//            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $this->distance($id);
        $device = Device::find($id);

        $location = Location::where('device_id', $id)->orderby('timestamp', 'desc')->first();

        $location_array = Location::orderBy('id', 'desc')->take(5)->get();

        Mapper::map($location->longitude, $location->latitude, ['zoom' => 15, 'type' => 'HYBRID'])->circle([['latitude' => $device->center_lng, 'longitude' => $device->center_lat]], ['strokeColor' => '#FF0000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF0000', 'radius' => $device->radius]);

        return view('location.show')->with('device', Device::find($id))->with('location', $location)->with('location_array', $location_array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }

    public function distance($id) {

        $device = Device::find($id);

        $location = Location::where('device_id', $id)->orderby('timestamp', 'desc')->first();

        $client = new \GuzzleHttp\Client;
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $device->center_lng . ', ' . $device->center_lat . '&destinations=' . $location->longitude . ', ' . $location->latitude . '&language=en-EN&key=AIzaSyArwnkumGSSbcGCPUWdJQ4ZepcT0v4lW48');

        $json = $res->getBody();


        $string = json_decode($json, true);




        if(array_key_exists( 'distance',$string)) {

            $meters = $string['rows'][0]['elements'][0]['distance']['value'];
            dd($meters);
            return $meters;

        } else {
//            Session::flash('success', 'Longitude or latitude for Home location of this device is not set correctly.');
//
//            return redirect()->back();
        }



    }
}
