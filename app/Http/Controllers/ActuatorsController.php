<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class ActuatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $requestActuators = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuator');
        $actuators = json_decode($requestActuators->getBody());
 
        $requestType = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuatorType');
        $actuatortypes = json_decode($requestType->getBody());

        $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script');
        $scripts = json_decode($requestScript->getBody());

        return view('settings.actuators', compact('actuators', 'actuatortypes', 'scripts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        $name = $request->get('actuatorname');
        $actuator_type = $request->get('actuatortype');
        $script_path = $request->get('scriptpath');
        $pin_number = $request->get('pin');
        $venue = $request->get('venue');
        $client->request(
            'POST',
            'https://pure-headland-78653.herokuapp.com/api/resources/actuator',
            [
                'form_params' => [
                    'name' => $name,
                    'actuator_type_id' => $actuator_type,
                    'pin_number' => $pin_number,
                    'script_id' => $script_path,
                    'venue_id' => $venue
                ]
            ]
        );

        return redirect('actuators');

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
            'https://pure-headland-78653.herokuapp.com/api/resources/actuator/'.$id
        );
        $actuators = json_decode($request->getBody());
        
        $requestType = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuatorType');
        $actuatortypes = json_decode($requestType->getBody());

        $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script');
        $scripts = json_decode($requestScript->getBody());

        
        return view('settings.editActuators', compact('actuators', 'actuatortypes', 'scripts'));
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
        $name = $request->get('actuatorname');
        $actuator_type = $request->get('actuatortype');
        $script_path = $request->get('scriptpath');
        $pin_number = $request->get('pin');
        $venue = $request->get('venue');

        $client->put(
            'https://pure-headland-78653.herokuapp.com/api/resources/actuator/' . $id,
            [
                'form_params' => [
                    'name' => $name,
                    'actuator_type_id' => $actuator_type,
                    'script_id' => $script_path,
                    'pin_number' => $pin_number,
                    'venue_id' => $venue
                ]
            ]
        );
     
        return redirect('actuators');
   
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
        $client->delete('https://pure-headland-78653.herokuapp.com/api/resources/actuator/' . $id);
        return redirect('actuators');
    
    }
}
