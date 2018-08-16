<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Session;
use Notification;
use GuzzleHttp\Client;
use Carbon\Carbon;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $data_array = explode("*", $data, 7);

        if (Device::where('serial_number', $data_array[6])->first() !== null) {
            $data_ts = explode("--", $data_array[4], 2);

            $d = Device::where('serial_number', $data_array[6])->first();

            $location = Location::create([
                'latitude' => $data_array[0],
                'longitude' => $data_array[1],
                'speed' => $data_array[2],
                'altitude' => $data_array[3],
                'timestamp' => $data_ts[0] . " " . $data_ts[1],
                'satellites' => $data_array[5],
                'serial_number' => $data_array[6],
                'device_id' => $d->id
            ]);

            if ($this->distance($d->id) > $d->radius) {

                $devices = Device::where('serial_number', $data_array[6])->get();

                $users = array();
                $phone_numbers = array();

                foreach ($devices as $device) {
                    array_push($users, User::find($device->user_id));

                    if(!is_null($device->contact_1)){
                        array_push($phone_numbers, $device->contact_1);
                    }

                    if (!is_null($device->contact_2)){
                        array_push($phone_numbers, $device->contact_2);
                    }

                    if (!is_null($device->contact_3)){
                        array_push($phone_numbers, $device->contact_3);
                    }

                    if($device->message_sent !== true) {
                        DeviceController::messageSent($device->id, true);
                    }
                }

//                dd($device->last_message_sent, Carbon::now(), Carbon::parse($device->last_message_sent), Carbon::parse($device->last_message_sent)->addHours(2));

                if($d->message_sent !== false && Carbon::parse($device->last_message_sent)->addHours(2)->lt(Carbon::now())) {
                    Notification::send($users, new \App\Notifications\DeviceOutOfBounds());
                    //$this->sendSms($phone_numbers);
                }



            }
            else {
//                dd($this->distance($d->id),'didnt send');

//                $m_sent = DeviceController::messageSent($d->id, false);
                if($d->message_sent !== false) {
                    $m_sent = DeviceController::messageSent($d->id, false);
                }
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);

        $location = Location::where('device_id', $id)->orderby('timestamp', 'desc')->first();

        $location_array = Location::orderBy('id', 'desc')->take(5)->get();

        Mapper::map($location->latitude, $location->longitude, ['zoom' => 11, 'type' => 'ROADMAP'])->circle([['latitude' => $device->center_lat, 'longitude' => $device->center_lng]], ['strokeColor' => '#FF0000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF0000', 'radius' => $device->radius]);

//        Mapper::map(45.523610, 18.563330, ['zoom' => 11, 'type' => 'HYBRID']);



//        $date = Carbon::now()->toDateTimeString();
//        dd(Carbon::now()->addHours(2) > $date);
        return view('location.show')->with('device', Device::find($id))->with('location', $location)->with('location_array', $location_array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }

    public function distance($id)
    {
        $device = Device::find($id);

        $location = Location::where('device_id', $id)->orderby('timestamp', 'desc')->first();

//        dd($device->center_lat, $device->center_lng, $location->latitude, $location->longitude);

        $client = new \GuzzleHttp\Client;
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $device->center_lat . ',' . $device->center_lng . '&destinations=' . $location->latitude . ',' . $location->longitude . '&language=en-EN&key=AIzaSyDggCeAeLImQC-_UVJmlMSiWSDTgTeor5E');

        $json = $res->getBody();

        $string = json_decode($json, true);

        if (array_key_exists('distance', $string['rows'][0]['elements'][0])) {
            return $string['rows'][0]['elements'][0]['distance']['value'];
        } else {
            return 0;

            //TODO: add email for bad latitude and longitude or ZERO_RESULTS
        }
    }

    public function sendSms($phone_numbers){
        $basic  = new \Nexmo\Client\Credentials\Basic('4501eeb9', 'No7YbT9sxvzVW1UL');
        $client = new \Nexmo\Client($basic);


        foreach ($phone_numbers as $phone_number) {
            $message = $client->message()->send([
                'to' => $phone_number,
                'from' => 'a7tracker',
                'text' => 'Your device has left the boundaries.'
            ]);
        }
    }
}
