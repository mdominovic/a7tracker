@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My devices</div>

                    <div class="panel-body">

                        <table class="table table-hover">

                            <thead>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Edit
                                </th>
                                <th>
                                    Delete
                                </th>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <tr>
                                        <td>
                                            <a href="{{ route('location.show', ['id' => $device->id ]) }}">{{ $device->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('device.edit', ['device' => $device->id ]) }}" class="btn btn-xs btn-info">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('device.destroy', ['device' => $device->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection