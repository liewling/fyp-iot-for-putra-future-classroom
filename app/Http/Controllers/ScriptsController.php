<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ScriptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $request = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script');
        $data = $request->getBody();
        $scripts = json_decode($data);
        return view('settings.script', compact('scripts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        $script_name = $request->get('scriptname');
        $script_path = $request->get('scriptpath');
    
         $client->request(
            'POST',
            'https://pure-headland-78653.herokuapp.com/api/resources/script',
            [
                'form_params' => [
                    'name' => $script_name,
                    'path' => $script_path,

                ]
            ]
        );
        
        return redirect('scripts');
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
        $scripts = json_decode($data);
        return view('settings.editScripts', compact('scripts'));
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
        $script_name = $request->get('scriptname');
        $script_path = $request->get('scriptpath');
    
        $client->request(
            'PUT',
            'https://pure-headland-78653.herokuapp.com/api/resources/script/'.$id,
            [
                'form_params' => [
                    'name' => $script_name,
                    'path' => $script_path,
                ]
            ]
        );
        // var_dump($updateRequest->getStatusCode());
        // return $updateRequest->getStatusCode();
        return redirect('scripts');
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
        $client->delete('https://pure-headland-78653.herokuapp.com/api/resources/script/' . $id);
        return redirect('scripts');
    }
}
