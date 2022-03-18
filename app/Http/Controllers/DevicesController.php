<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $requestDevice = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/device');
        $devices = json_decode($requestDevice->getBody());

        $requestSensor = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensor');
        $responseSensor = json_decode($requestSensor->getBody());
        $sensors = $responseSensor->data;

        $requestActuator = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuator');
        $actuators = json_decode($requestActuator->getBody());

        return view('pages.devices', compact('devices', 'sensors', 'actuators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();

        $name = $request->get('devicename');
        $sensors = $request->get('sensors');
        $actuators = $request->get('actuators');

        if (is_null($sensors)) {
            $sensors = array("0");
        }
        foreach ($sensors as $sensor) {
            $sensorarray[] =  [
                'deviceable_type' => 'App\Sensor',
                'deviceable_id' => $sensor,
            ];
        }

        if (is_null($actuators)) {
            $actuators = array("0");
        }

        foreach ($actuators as $actuator) {
            $actuatorarray[] = [
                'deviceable_type' => 'App\Actuator',
                'deviceable_id' => $actuator,

            ];
        }

        $client->post('https://pure-headland-78653.herokuapp.com/api/resources/device', [
            'form_params' => [
                'name' => $name,
                'deviceables' => array_merge($sensorarray, $actuatorarray)

            ]
        ]);

        return redirect('devices');
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
        $client = new Client();
        $requestDevice = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/device/' . $id);
        $device = json_decode($requestDevice->getBody());

        foreach ($device->sensors as $sensor) {
            $sensorid = $sensor->id;
            $requestSensor = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensor/' . $sensorid);
            $sensors[] = json_decode($requestSensor->getBody());
        }

        foreach ($device->sensors as $sensor) {
            $scriptid = $sensor->script_id;
            $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script/' . $scriptid);
            $scripts[] = json_decode($requestScript->getBody());
        }

        foreach ($device->actuators as $actuator) {
            $scriptid = $actuator->script_id;
            $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script/' . $scriptid);
            $scripts[] = json_decode($requestScript->getBody());
        }

        return view('pages.controlDevices', compact('device', 'sensors', 'scripts'));
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
        $requestDevice = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/device/' . $id);
        $device = json_decode($requestDevice->getBody());

        $requestSensor = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensor');
        $responseSensor = json_decode($requestSensor->getBody());
        $sensors = $responseSensor->data;

        $requestActuator = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuator');
        $actuators = json_decode($requestActuator->getBody());

        return view('pages.editDevices', compact('device', 'sensors', 'actuators'));
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

        $name = $request->get('devicename');
        $sensors = $request->get('sensors');
        $actuators = $request->get('actuators');


        if (is_null($sensors)) {
            $sensors = array("0");
        }

        foreach ($sensors as $sensor) {
            $sensorarray[] =  [
                'deviceable_type' => 'App\Sensor',
                'deviceable_id' => $sensor,
            ];
        }

        if (is_null($actuators)) {
            $actuators = array("0");
        }

        foreach ($actuators as $actuator) {
            $actuatorarray[] = [
                'deviceable_type' => 'App\Actuator',
                'deviceable_id' => $actuator,

            ];
        }

        $client->request('PUT', 'https://pure-headland-78653.herokuapp.com/api/resources/device/' . $id, [
            'form_params' => [
                'name' => $name,
                'deviceables' => array_merge($sensorarray, $actuatorarray)

            ]
        ]);

        return redirect('devices');
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
        $client->delete('https://pure-headland-78653.herokuapp.com/api/resources/device/' . $id);
        return redirect('devices');
    }

    public function controlDevice()
    {

        $client = new Client();

        if (isset($_GET["id"])) {
            $id = strip_tags($_GET["id"]);
            $requestActuator = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/actuator/' . $id);
            $actuator = json_decode($requestActuator->getBody());
            $actuator_pin = $actuator->pin_number;

            if (isset($_GET["manualbtn"])) {
                $value_m = strip_tags($_GET["manualbtn"]);

                if ($value_m == "ON") {

                    shell_exec("/usr/bin/gpio -g mode $actuator_pin out");
                    shell_exec("/usr/bin/gpio -g write $actuator_pin 1");
                    echo "$actuator->name is on";
                } else if ($value_m == "OFF") {

                    shell_exec("/usr/bin/gpio -g write $actuator_pin 0");
                    echo "$actuator->name is off";
                }
            }
        }


        if (isset($_GET["deviceid"]) && isset($_GET["scriptid"])) {
            $deviceid = strip_tags($_GET["deviceid"]);
            $scriptid = strip_tags($_GET["scriptid"]);
            $requestDevice = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/device/' . $deviceid);
            $device = json_decode($requestDevice->getBody());
            foreach ($device->sensors as $sensor) {
                $sensoridr[] = $sensor->id;
                $sensorpinr[] = $sensor->pin_number;
            }

            $sensoridj = json_encode($sensoridr);
            $sensorid = str_replace(array('[', ']'), '', $sensoridj);
            $sensorpinj = json_encode($sensorpinr);
            $sensorpin = str_replace(array('[', ']'), '', $sensorpinj);
            var_dump($sensorpin);

            foreach ($device->actuators as $actuator) {

                $actuatorpinr[] = $actuator->pin_number;
            }

            if (isset($actuatorpinr)) {
                $actuatorpinj = json_encode($actuatorpinr);
                $actuatorpin = str_replace(array('[', ']'), '', $actuatorpinj);
            } else {
                $actuatorpin = 0;
            }

            $requestScript = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/script/' . $scriptid);
            $script = json_decode($requestScript->getBody());
            $script_path = $script->path;
            var_dump($script_path);

            if (isset($_GET["sensorbtn"])) {
                $value_s = strip_tags($_GET["sensorbtn"]);
                if ($value_s == "ON") {
                    echo "Script is running.";
                    shell_exec("sudo /usr/bin/python $script_path $sensorpin $actuatorpin $sensorid");
                } else if ($value_s == "OFF") {
                    shell_exec("sudo pkill -SIGINT -f $script_path");
                    echo "Script terminated.";
                }
            }
        }
    }
}
