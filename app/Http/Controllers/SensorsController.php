<?php

namespace App\Http\Controllers;

use App\Http\Traits\CRC;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SensorsController extends Controller
{
    use CRC;
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
    public function store(Request $request)
    {
        // 1. Decode the data from base64 string
        $content = file($request->file('data'));
        foreach ($content as $index => $line) {
            $decoded_data = base64_decode($line);
            // Check for CRC validity by moving the first two bytes to the end of the payload 
            // and calculate the CRC for the whole new string
            $payload = substr($decoded_data, 2, 45) . substr($decoded_data, 0, 2);
            if ($this->crc16Calc($payload) != 0) {
                print "In valid data for index " . $index . "\xA";
            } else { // valid data, accumlate it into a temporary file
                $sensor = $this->initSensorObject($decoded_data);
                $sensor->save();
            }
            
        }
    }
    private function initSensorObject($binary_data){
        $sensor = new Sensor();
        $sensor->sv = unpack('C', substr($binary_data, 4, 1))[1];
        $sensor->hw_version = unpack('v', substr($binary_data, 5, 2))[1];
        $sensor->fw_version = unpack('v', substr($binary_data, 7, 2))[1];
        $sensor->device_status = unpack('C', substr($binary_data, 9, 1))[1];
        $sensor->serial_number = unpack('V', substr($binary_data, 10, 4))[1];
        $sensor->battery = unpack('v', substr($binary_data, 14, 2))[1];
        $sensor->solar = unpack('v', substr($binary_data, 16, 2))[1];
        $sensor->precipitation = unpack('v', substr($binary_data, 18, 2))[1];
        $sensor->avg_air_temp = unpack('v', substr($binary_data, 20, 2))[1];
        $sensor->min_air_temp = unpack('v', substr($binary_data, 22, 2))[1];
        $sensor->max_air_temp = unpack('v', substr($binary_data, 24, 2))[1];
        $sensor->avg_humidity = unpack('v', substr($binary_data, 26, 2))[1];
        $sensor->min_humidity = unpack('v', substr($binary_data, 28, 2))[1];
        $sensor->max_humidity = unpack('v', substr($binary_data, 30, 2))[1];
        $sensor->avg_deltaT = unpack('s', substr($binary_data, 32, 2))[1];
        $sensor->min_deltaT = unpack('s', substr($binary_data, 34, 2))[1];
        $sensor->max_deltaT = unpack('s', substr($binary_data, 36, 2))[1];
        $sensor->avg_dewpoint = unpack('s', substr($binary_data, 38, 2))[1];
        $sensor->min_dewpoint = unpack('s', substr($binary_data, 40, 2))[1];
        $sensor->avg_vpd = unpack('v', substr($binary_data, 42, 2))[1];
        $sensor->min_vpd = unpack('v', substr($binary_data, 44, 2))[1];
        $sensor->leaf_wetness = unpack('C', substr($binary_data, 46, 1))[1];
        return $sensor;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
