<?php

namespace App\Http\Controllers;

use App\SensorType;
use App\Sensor;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SensorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();   
        $requestSensor = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensor');
        $responseSensor = json_decode($requestSensor->getBody());
        $sensors = $responseSensor->data;
    
        $requestType = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensorType');
        $responseTypes = json_decode($requestType->getBody());
        $sensortypes = $responseTypes->data;

        $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script');
        $scripts = json_decode($requestScript->getBody());

        return view('settings.sensors', compact('sensors', 'sensortypes', 'scripts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        $name = $request->get('sensorname');
        $sensor_type = $request->get('sensortype');
        $script_path = $request->get('scriptpath');
        $pin_number = $request->get('pin');
        $venue = $request->get('venue');
         $client->request(
            'POST',
            'https://pure-headland-78653.herokuapp.com/api/resources/sensor',
            [
                'form_params' => [
                    'name' => $name,
                    'sensor_type_id' => $sensor_type,
                    'pin_number' => $pin_number,
                    'script_id' => $script_path,
                    'venue_id' => $venue,
                ]
            ]
        );
        
        return redirect('sensors');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $client = new Client();
        $requestSensor = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensor/'.$id);
        $sensors = json_decode($requestSensor->getBody());
        
        
        $requestType = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensorType');
        $responseTypes = json_decode($requestType->getBody());
        $sensortypes = $responseTypes->data;
  
        $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script');
        $scripts = json_decode($requestScript->getBody());

        return view('settings.editSensors', compact('sensors','sensortypes', 'scripts'));
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
        $client = new Client();
        $name = $request->get('sensorname');
        $sensor_type = $request->get('sensortype');
        $script_path = $request->get('scriptpath');
        $pin_number = $request->get('pin');
        $venue = $request->get('venue');
        $client->request(
            'PUT',
            'https://pure-headland-78653.herokuapp.com/api/resources/sensor/'.$id,
            [
                'form_params' => [
                    'name' => $name,
                    'sensor_type_id' => $sensor_type,
                    'script_id' => $script_path,
                    'pin_number' => $pin_number,
                    'venue_id' => $venue,
                ]
            ]
        );
        // var_dump($updateRequest->getStatusCode());
        // return $updateRequest->getStatusCode();
        return redirect('sensors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new Client();
        $client->delete('https://pure-headland-78653.herokuapp.com/api/resources/sensor/' . $id);
        return redirect('sensors');
    }
}
