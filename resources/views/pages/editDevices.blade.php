@extends('layouts.default')
@section('content')

<div id="pageTitle">
<h4><button type="button" class="btn btn-link backbtn" onclick="history.go(-1);"><i
    class="fas fa-chevron-left"></i></button>
    Edit Devices</h4>
</div>

<form action="{{ route('devices.update', $device->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    {{-- form only support POST and GET methos so csrf and method field must be added --}}
    <div class="form-group col-sm-6 row">
        <label for="devicename" class="col-form-label">Sensor Name:</label>
        <input type="text" class="form-control" id="devicename" name="devicename" value="{{$device->name}}">
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label for="sensor" class="col-form-label">Select sensor:</label>
            <select class="form-control selectpicker" id="selectSensor" name="sensors[]" multiple>
                @foreach($sensors as $sensor)
                <option value="{{$sensor->id}}">{{$sensor->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-4">
            <label for="script" class="col-form-label">Select actuator:</label>
            <select class="form-control selectpicker" id="selectActuator" name="actuators[]" multiple>
                @foreach($actuators as $actuator)
                <option value="{{$actuator->id}}">{{$actuator->name}}</option>
                @endforeach
            </select>
        </div>

    </div>


    <div class="modal-footer">
        <a href="{{route('devices.index')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
  
</script>
@stop