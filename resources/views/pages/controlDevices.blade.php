@extends('layouts.default')
@section('content')

<div id="pageTitle">
    <h4><button type="button" class="btn btn-link backbtn" onclick="history.go(-1);"><i
                class="fas fa-chevron-left"></i></button>
        {{$device->name}} Control
        <a href="{{route('devices.edit', $device->id)}}">
            <button type="button" class="btn btn-link" id="updatebtn">
                <i class="fas fa-edit"></i> Edit</button>
        </a></h4>
</div>

<div class="card shadow-sm">

    <h4>Curent Status:</h4>
    <div class="card bg-light mb-3" style="max-width: 18rem; border: none;">
        <div class="card-body">
            <h3 id="realtimedata"></h3>
        </div>
    </div>
    <div class="row" style="margin-left:5px">Data Storing Status: <p id="storeStatus"> </p>
    </div>


    <hr>
    <form method="get" action="">

        <h5 style="margin: 0">Manual Control</h5>
        <hr>
        <div class="">

            @foreach($device->actuators as $key=>$actuator)
            <b>{{$actuator->name}} {{$key+1}}:</b>
            <div>
                <p style="font-size: 12px; margin: 2px">* Turn sensor off to enable manual control</p>

                <input type="button" value="Turn ON" name="manualbtn" class="btn btn-primary devicebtn" id="manualbtn"
                    onclick="manualControl({{$actuator->id}}, 'ON')">
                <input type="button" value="Turn OFF" name="manualbtn" class="btn btn-primary devicebtn" id="manualbtn"
                    onclick="manualControl({{$actuator->id}}, 'OFF')">
                <br><br>

            </div>
            @endforeach
        </div>
        <hr>
        <h5 style="margin: 0">Automated Sensor Control</h5>
        <hr>
        <div class="">

            <div>
                <b>[Sensor used, Script ID] :</b>
                @foreach($device->sensors as $key=>$sensor)
                [{{$sensor->name}}, {{$sensor->script_id}}],
                @endforeach
            </div>
            <div>
                <b>Script Path:</b>

                <?php 

                  foreach($scripts as $script){
                   $scriptid_r[] = $script->id;
                   $scriptpath_r[] = $script->path;
                  }
             
                  $jsonid = json_encode( array_unique($scriptid_r));
                  $jsonpath = json_encode(array_unique($scriptpath_r));
                  $scriptid = trim($jsonid, '[]');
                  $scriptpath = trim($jsonpath, '[]');
                  echo " [$scriptid]: $scriptpath ";
                ?>

            </div>

        </div>

        <input type="button" value="Run Script" name="sensorbtn" class="btn btn-primary devicebtn"
            onclick="sensorControl({{$device->id}}, {{$scriptid}}, 'ON')">
        <input type="button" value="Terminate Script" name="sensorbtn" class="btn btn-primary devicebtn"
            onclick="sensorControl({{$device->id}}, {{$scriptid}}, 'OFF')">
        <p id="scriptStatus"></p>


        <?php 
        foreach($sensors as $sensor){
            $topicarray[] = $sensor->type->name;
        }
        // $topic = json_encode($topicarray);
        // $topicr = str_replace(array('[', ']'), '', $topicj);
        
        // $topic = str_replace('"', '', $topicj);
       
         ?>

    </form>
</div>

<script>
    function manualControl(id, value){

        $.ajax({
        type: "GET",
        url: "control?id=" + id +  "&manualbtn=" + value,     
        success: function(data) { 
            console.log(data);

        }
    })

    }

 function sensorControl(deviceid, scriptid, value){
            if(value == "ON"){
                var on = "Sensor Control started";
                console.log(on);
                document.getElementById("scriptStatus").innerHTML = on;
            }else if(value == "OFF"){
                var off = "Sensor Control terminated";
                document.getElementById("scriptStatus").innerHTML = off;
            }

        $.ajax({
        type: "GET",
        url: "control?deviceid=" + deviceid + "&scriptid=" + scriptid +  "&sensorbtn=" + value,     
        success: function(data) { 
            console.log(data);

        }
    })

    }

    // Create a client instance
client = new Paho.MQTT.Client("192.168.137.2", Number(1883), "");

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

// connect the client
client.connect({onSuccess:onConnect});


// called when the client connects
function onConnect() {
  // Once a connection has been made, make a subscription and send a message.
  console.log("onConnect");
  var topicj = '<?php echo json_encode($topicarray); ?>';
  var topic = JSON.parse(topicj);

  console.log(topic);
  message = new Paho.MQTT.Message("Real Time Data");
  
  for(var i in topic){
    message.destinationName = topic[i].toString();
    console.log(topic[i].toString());
    client.subscribe(topic[i].toString());   
} 
client.subscribe("storeStatus");
  client.send(message);
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log("onConnectionLost:"+ responseObject.errorMessage);
  }
}

// called when a message arrives
function onMessageArrived(message) {
  console.log("onMessageArrived:"+ message.payloadString);
  if(message.destinationName == "storeStatus"){
       var status = message.payloadString;
         document.getElementById("storeStatus").innerHTML = status;
}
        var data = message.payloadString;
        document.getElementById("realtimedata").innerHTML = data;
  
}
    
</script>

@stop