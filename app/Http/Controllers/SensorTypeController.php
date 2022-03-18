<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SensorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $request = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensorType');
        $data = $request->getBody();
        $responseTypes = json_decode($data);
        $sensorTypes = $responseTypes->data;
        return view('settings.sensorType', compact('sensorTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        $name = $request->get('sensortypename');
    
         $client->request(
            'POST',
            'https://pure-headland-78653.herokuapp.com/api/resources/sensorType',
            [
                'form_params' => [
                    'name' => $name,

                ]
            ]
        );
        
        return redirect('sensorType');
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
        $request = $client->get(
            'https://pure-headland-78653.herokuapp.com/api/resources/sensorType/'.$id
        );
        $data = $request->getBody();
        $sensorTypes = json_decode($data);
        return view('settings.editSensors', compact('sensorTypes'));
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
        $name = $request->get('sensortypename');
    
        $client->request(
            'PUT',
            'https://pure-headland-78653.herokuapp.com/api/resources/sensorType/'.$id,
            [
                'form_params' => [
                    'name' => $name,
                ]
            ]
        );
        // var_dump($updateRequest->getStatusCode());
        // return $updateRequest->getStatusCode();
        return redirect('sensorType');
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
        $client->delete('https://pure-headland-78653.herokuapp.com/api/resources/sensorType/' . $id);
        return redirect('sensorType');
    }
}
