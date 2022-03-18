@extends('layouts.default')
@section('content')

<div id="pageTitle" style="margin-left: 20px">
<h4>Actuator Types</h4>
</div>

<div class="card shadow-sm">
    <div class="col-md-12" id="actuatortable">

        {{-- Sensor Table --}}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($actuatorTypes as $key=>$actuatorType)
                <tr>

                    {{-- <th scope="row">{{$key+1}}</th> --}}
                    <th scope="row">{{$actuatorType->id}}</th>
                    <td>{{$actuatorType->name}}</td>
                    <td>


                        {{-- <form action="{{ route('actuatorType.destroy', $actuatorType->id)}}" method="post">
                            @method('delete')
                            @csrf --}}
                            <a href="{{route('actuatorType.edit', $actuatorType->id)}}">
                                <button type="button" class="btn btn-default btn-sm" id="updatebtn">
                                    <i class="fas fa-edit"></i></button></a>
                            {{-- <button type="submit" class="btn btn-default btn-sm">
                                <i class="fas fa-trash"></i></button> --}}

                    </td>
                    {{-- </form> --}}
                </tr>

                @endforeach

            </tbody>
        </table>

        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#myModal">Add
            New Type</button>

    </div>
</div>


{{-- Add Sensor Form --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Actuator Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('actuatorType.create') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="actuatorname" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="actuatortypename" name="actuatortypename">
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