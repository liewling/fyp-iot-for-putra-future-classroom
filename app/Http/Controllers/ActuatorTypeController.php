<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ActuatorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $request = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuatorType');
        $data = $request->getBody();
        $actuatorTypes = json_decode($data);
        return view('settings.actuatorType', compact('actuatorTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        $name = $request->get('actuatortypename');
    
         $client->request(
            'POST',
            'https://pure-headland-78653.herokuapp.com/api/resources/actuatorType',
            [
                'form_params' => [
                    'name' => $name,

                ]
            ]
        );
        
        return redirect('actuatorType');
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
            'https://pure-headland-78653.herokuapp.com/api/resources/actuatorType/'.$id
        );
        $data = $request->getBody();
        $actuatorTypes = json_decode($data);
        return view('settings.editActuators', compact('actuatorTypes'));
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
        $name = $request->get('actuatortypeame');
    
        $client->request(
            'PUT',
            'https://pure-headland-78653.herokuapp.com/api/resources/actuatorType/'.$id,
            [
                'form_params' => [
                    'name' => $name,
                ]
            ]
        );
        // var_dump($updateRequest->getStatusCode());
        // return $updateRequest->getStatusCode();
        return redirect('actuatorType');
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
        $client->delete('https://pure-headland-78653.herokuapp.com/api/resources/actuatorType/' . $id);
        return redirect('actuatorType');
    }
}
