<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/', function () {
//     return view('welcome');
// });

// Route:: get('/home', function () {
//     return view('pages/home');
// });


// Route:: get('/light', function () {
//     return view('pages/light');
// });
// Route:: get('devices', function () {
//         return view('pages/devices');
//     });

Route::get('/', 'GpioController@index');
Route::get('gpio', 'GpioController@gpioRequestGet');


// Route::get('devices', 'DevicesController@testDevices');
// Route::get('devices/controlDevices', 'DevicesController@controlDevices');
// Route::get('devices/controlDevices/showData', 'DevicesController@showData');
Route::get('devices/control', 'DevicesController@controlDevice');
Route::resource('devices', 'DevicesController');
Route::get('devices/light', 'LightController@index');
Route::get('devices/temperature', 'TempController@index');
Route::get('temperature/showTemp', 'TempController@showTemp');

// Route::get('settings', 'SettingsController@show');
// Route::post('addSensor', 'SettingsController@create');

Route::resource('sensors', 'SensorsController');
Route::resource('sensorType', 'SensorTypeController');
Route::resource('actuators', 'ActuatorsController');
Route::resource('actuatorType', 'ActuatorTypeController');
Route::resource('scripts', 'ScriptsController');

// Route::get('/mqtt/publish/{topic}/{message}', 'DevicesController@SendMsgViaMqtt');                                                                                                       
// Route::get('/mqtt/publish/{topic}', 'DevicesController@SubscribetoTopic');                                                                                                       
// Route::get('/mqtt/subscribe', 'DevicesController@subscribe');                                                                                                       

// Route::get('data', function(){
// //
// $client = new Client();

// $response=$client->request(
//     'POST',
//     'https://pure-headland-78653.herokuapp.com/api/resources/sensorData/2',
//     [
//         'form_params' => [
//             'field'=> "Temperature",
//             'value' => 27,
           
//         ]
//     ]
// );
//  $body=$response->getBody();
//         $html_string = (string) $body;
//         dd($html_string);

// // $client = new Client();
// // $request = $client->get('https://pure-headland-78653.herokuapp.com/api/resources/sensorData/1');
// // $data = $request->getBody();
// // $response = json_decode($data);
// // dd($response);

// });



    

