@extends('layouts.default')
@section('content')

<div id="pageTitle">
    <h4>Manage Sensor</h4>
</div>

<div class="card shadow-sm">
    <div class="col-md-12" id="sensortable">

        {{-- Sensor Table --}}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Sensor Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Script Assigned</th>
                    <th scope="col">Pin</th>
                    <th scope="col">Venue</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sensors as $key=>$sensor)
                <tr>

                    {{-- <th scope="row">{{$key+1}}</th> --}}
                    <th scope="row">{{$sensor->id}}</th>
                    <td>{{$sensor->name}}</td>
                    <td>{{$sensor->type->name}}</td>
                    <td>{{$sensor->script->name}}</td>
                    <td>{{$sensor->pin_number}}</td>
                    <td>{{$sensor->venue_id}}</td>
                    <td>
                        <form action="{{ route('sensors.destroy', $sensor->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <a href="{{route('sensors.edit', $sensor->id)}}">
                                <button type="button" class="btn btn-default btn-sm" id="updatebtn">
                                    <i class="fas fa-edit"></i></button></a>
                            <a href="{{route('sensors.destroy', $sensor->id)}}">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="fas fa-trash"></i></button></a>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal">Add
            Sensor</button>
    </div>
</div>

{{-- Add Sensor Form --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Sensor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sensors.create') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="sensorname" class="col-form-label">Sensor Name:</label>
                        <input type="text" class="form-control" id="sensorname" name="sensorname">
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
                            <label for="venue" class="col-form-label">Venue:</label>
                            <input type="text" class="form-control" id="venue" name="venue">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="pin" class="col-form-label">GPIO Pin:</label>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@stop