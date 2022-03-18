@extends('layouts.default')
@section('content')

<div id="pageTitle">
    <h4>Sensor Types</h4>
</div>

<div class="card shadow-sm">
    <div class="col-md-12" id="sensortable">

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
                @foreach($sensorTypes as $key=>$sensorType)
                <tr>

                    {{-- <th scope="row">{{$key+1}}</th> --}}
                    <th scope="row">{{$sensorType->id}}</th>
                    <td>{{$sensorType->name}}</td>
                    <td>


                        {{-- <form action="{{ route('sensorType.destroy', $sensorType->id)}}" method="post">
                            @method('delete')
                            @csrf --}}
                            <a href="{{route('sensorType.edit', $sensorType->id)}}">
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
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Sensor Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sensorType.create') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="sensorname" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="sensortypename" name="sensortypename">
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