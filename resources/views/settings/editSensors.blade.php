@extends('layouts.default')
@section('content')

<div id="pageTitle">
<h4><button type="button" class="btn btn-link backbtn" onclick="history.go(-1);"><i
    class="fas fa-chevron-left"></i></button>
    Edit Sensor</h4>
</div>

<form action="{{ route('sensors.update', $sensors->id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    {{-- form only support POST and GET methos so csrf and method field must be added --}}
    <div class="form-group">
        <label for="sensorname" class="col-form-label">Sensor Name:</label>
        <input type="text" class="form-control" id="sensorname" name="sensorname" value="{{$sensors->name}}">
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
                <label for="sensortype" class="col-form-label">Type:</label>
                <select class="form-control selectpicker" id="selectType" name="sensortype">
                    @foreach($sensortypes as $sensortype)
                    <option value="{{$sensortype->id}}">{{$sensortype->name}}</option>
                    @endforeach
                </select>
        </div>

        <div class="col-sm-6">
            <label for="sensorvenue" class="col-form-label">Venue:</label>
            <input type="text" class="form-control" id="sensortype" name="venue" value="">
        </div>

    </div>

    <div class="form-group row">

        <div class="col-sm-6">
            <label for="type" class="col-form-label">GPIO Pin:</label>
            <select class="form-control selectpicker" id="selectPin" name="pin">
                <?php  
                    for($pin=0; $pin<=27; $pin++) {                                        
                    ?>
                <option value="{{$pin}}">{{$pin}}</option>
                <?php  }  ?>
            </select>
        </div>

        <div class="col-sm-6">
                <label for="script" class="col-form-label">Assign Script:</label>
                <select class="form-control selectpicker" id="selectPath" name="scriptpath">
                    @foreach($scripts as $script)
                    <option value="{{$script->id}}">{{$script->path}}</option>
                    @endforeach
                </select>
        </div>

    </div>

    <div class="modal-footer">
        <a href="{{route('sensors.index')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
    document.getElementById("{{$sensors->pin_number}}").selected= true;
    document.getElementById("{{$sensors->script->name}}").selected="true";
    document.getElementById("{{$sensors->type->name}}").selected="true";
</script>
@stop