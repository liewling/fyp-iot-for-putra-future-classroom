@extends('layouts.default')
@section('content')


<div id="pageTitle">
    <h4>Manage Actuator</h4>
</div>


<div class="card shadow-sm">
    <div class="col-md-12" id="actuatortable">

        {{-- Sensor Table --}}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Actuator Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Script Assigned</th>
                    <th scope="col">Pin</th>
                    <th scope="col">Venue</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($actuators as $key=>$actuator)
                <tr>

                    <th scope="row">{{$actuator->id}}</th>
                    <td>{{$actuator->name}}</td>
                    <td>{{$actuator->type->name}}</td>
                    <td>{{$actuator->script->name}}</td>
                    <td>{{$actuator->pin_number}}</td>
                    <td>{{$actuator->venue_id}}</td>

                    <td>

                        <form action="{{ route('actuators.destroy', $actuator->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <a href="{{route('actuators.edit', $actuator->id)}}">
                                <button type="button" class="btn btn-default btn-sm" id="updatebtn">
                                    <i class="fas fa-edit"></i></button></a>
                            <button type="submit" class="btn btn-default btn-sm">
                                <i class="fas fa-trash"></i></button>

                    </td>
                    </form>
                </tr>

                @endforeach

            </tbody>
        </table>

        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal">Add
            Actuator</button>

    </div>
</div>


{{-- Add Sensor Form --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Actuator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('actuators.create') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="actuatorname" class="col-form-label">Actuator Name:</label>
                        <input type="text" class="form-control" id="actuatorname" name="actuatorname">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="actuatortype" class="col-form-label">Type:</label>
                            <select class="form-control selectpicker" id="selectType" name="actuatortype">
                                @foreach($actuatortypes as $actuatortype)
                                <option value="{{$actuatortype->id}}">{{$actuatortype->name}}</option>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@stop