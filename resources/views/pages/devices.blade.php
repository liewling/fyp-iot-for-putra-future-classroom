@extends('layouts.default')
@section('content')

<div id="pageTitle">
    <h4>IoT Devices</h4>
</div>


<div class="card-deck row">


    @foreach($devices as $device)
    <div class="card text-white bg-info devicecard" id="devicecard" style="max-width: 20rem; min-width: 13rem">

        <div>
            <a href="{{route('devices.edit', $device->id)}}" class="float-right">
                <button type="button" class="btn btn-default btn-sm" id="updatebtn">
                    <i class="fas fa-edit"></i></button>
            </a>
        </div>
        <div class="card-body">
            <div style="padding-left: 12px;">
                {{-- <a href="/devices/light" class="d-flex align-items-baseline"> --}}
                <a href="{{route('devices.show', $device->id)}}">
                    <h4 class="card-title" style="padding-right: 5px"> {{$device->name}} {{$device->id}}</h4>
                </a>

            </div>
        </div>
        <div>
            <form action="{{ route('devices.destroy', $device->id)}}" method="post" class="float-right">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger btn-sm" style="margin-right:10px">
                    Remove</button>
            </form>
        </div>
    </div>

    @endforeach

    <div class="card text-white bg-info d-flex align-items-center justify-content-center"
        style="max-width: 20rem; min-width: 13rem">
        <div class="card-body">

            <button type="button" class="btn btn-default btn-sm newdevice" data-toggle="modal" data-target="#myModal"><i
                    class="fas fa-plus fa-3x"></i>
                <br><br>Configure<br>New Devices</button>

        </div>
    </div>

</div>

{{-- Add Sensor Form --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Configure New Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('devices.create') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="devicename" class="col-form-label">Device Name:</label>
                        <input type="text" class="form-control" id="devicename" name="devicename">
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="sensor" class="col-form-label">Select sensor:</label>
                            <select class="form-control selectpicker" id="selectSensor" name="sensors[]" multiple
                                title="Select all sensors with same script">
                                @foreach($sensors as $sensor)
                                <option value="{{$sensor->id}}">{{$sensor->name}} ({{$sensor->script->path}})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="script" class="col-form-label">Select actuator:</label>
                            <select class="form-control selectpicker" id="selectActuator" name="actuators[]" multiple
                                title="Select all actuators with same script">
                                @foreach($actuators as $actuator)
                                <option value="{{$actuator->id}}">{{$actuator->name}} ({{$actuator->script->path}})
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <p style="font-size: 10px" style="float: left">*To configure correctly, make sure to select all sensors and actuators with same script</p>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>


</script>

@stop