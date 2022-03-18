@extends('layouts.default')
@section('content')

<div id="pageTitle" style="margin-left: 20px">
    <h4>Script</h4>
</div>

<div class="card shadow-sm">
    <div class="col-md-12" id="sensortable">

        {{-- Sensor Table --}}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Script Name</th>
                    <th scope="col">Path</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($scripts as $key=>$script)
                <tr>

                    {{-- <th scope="row">{{$key+1}}</th> --}}
                    <th scope="row">{{$script->id}}</th>
                    <td>{{$script->name}}</td>
                    <td>{{$script->path}}</td>
                    <td>


                        {{-- <form action="{{ route('scripts.destroy', $script->id)}}" method="post">
                            @method('delete')
                            @csrf --}}
                            <a href="{{route('scripts.edit', $script->id)}}">
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
            New Script Path</button>

    </div>
</div>


{{-- Add Sensor Form --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Script Path</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('scripts.create') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="scriptname" class="col-form-label">Script Name:</label>
                            <input type="text" class="form-control" id="scriptname" name="scriptname">
                        </div>

                        <div class="col-sm-6">
                            <label for="scriptpath" class="col-form-label">Path:</label>
                            <input type="text" class="form-control" id="scriptpath" name="scriptpath">
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