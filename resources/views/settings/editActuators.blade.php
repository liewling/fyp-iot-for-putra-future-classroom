@extends('layouts.default')
@section('content')

<div id="pageTitle">
    <h4><button type="button" class="btn btn-link backbtn" onclick="history.go(-1);"><i
                class="fas fa-chevron-left"></i></button>
        Edit Actuator</h4>
</div>

<form action="{{ route('actuators.update', $actuators->id) }}" method="PATCH">
    <div class="form-group">
        <label for="actuatorname" class="col-form-label">Actuator Name:</label>
        <input type="text" class="form-control" id="actuatorname" name="actuatorname" value="{{$actuators->name}}">
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <label for="actuatortype" class="col-form-label">Type:</label>
            <input type="text" class="form-control" id="actuatortype" name="actuatortype"
                value="{{$actuators->actuator_type_id}}">
        </div>

        <div class="col-sm-6">
            <label for="actuatorvenue" class="col-form-label">Venue:</label>
            <input type="text" class="form-control" id="actuatortype" name="venue" value="">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6">
            {{-- <label for="pin" class="col-form-label">Pin:</label> --}}
            <label for="type" class="col-form-label">GPIO Pin:</label>
            <select class="form-control selectpicker" id="selectPin" name="pin">

                <?php
                        for($pin=0; $pin<=27; $pin++) {                                        
                        ?>

                <option value="{{$actuators->pin_number}}" selected>{{$pin}}</option>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

@stop