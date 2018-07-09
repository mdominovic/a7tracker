<?php

namespace App\Http\Controllers;

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
        //
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
        $device = Device::find($id);

        return view('location.show')->with('device', $device);

            //->with('best_answer', $best_answer);;
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
}
