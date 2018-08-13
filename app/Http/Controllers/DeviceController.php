<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Notification;
use Carbon\Carbon;
use App\Device;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'serial_number' => 'required',
            'imei' => 'required',
            'name' => 'required'
        ]);

        $device = Device::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'imei' => $request->imei,
            'user_id' => Auth::id(),
            'contact_1' => $request->contact_1,
            'contact_2' => $request->contact_2,
            'contact_3' => $request->contact_3,
            'center_lat' => $request->center_lat,
            'center_lng' => $request->center_lng,
            'radius' => $request->radius,
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
    public function show(Device $device)
    {
        //
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
        $device = Device::find($id);

        $device->name = $request->name;
        $device->serial_number = $request->serial_number;
        $device->imei = $request->imei;
        $device->contact_1 = $request->contact_1;
        $device->contact_2 = $request->contact_2;
        $device->contact_3 = $request->contact_3;
        $device->center_lat = $request->center_lat;
        $device->center_lng = $request->center_lng;
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

    public static function messageSent($id, $state) {
        $device = Device::find($id);

        $device->message_sent = $state;
        $device->last_message_sent = Carbon::now()->toDateTimeString();

        $device->save();

        return 0;
    }
}
