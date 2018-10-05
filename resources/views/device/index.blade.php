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
                                <th>
                                    Status
                                </th>
                            </thead>
                            <tbody>

                                @for($i = 0; $i < count($devices); $i++)
                                    <tr>
                                        <td>
                                            <a href="{{ route('device.show', ['id' => $devices[$i]->id ]) }}">{{ $devices[$i]->name }}</a>
                                        </td>

                                        <td>
                                            @if($devices[$i]->owner_id === Auth::id())
                                                <a href="{{ route('device.edit', ['id' => $devices[$i]->id ]) }}" class="btn btn-xs btn-info">Edit</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('device.destroy', ['device' => $devices[$i]->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>

                                        {{--$device->statusRelevancy($device) == 1--}}
                                        <td>
                                            @if(!$devices[$i]->out_of_boundary && Carbon\Carbon::parse($last_locations[$i]->created_at)->addMinutes(15) > Carbon\Carbon::now())
                                                <div style="height: 20px; width: 20px; background-color: #7CFC00; border-radius: 50%; display: inline-block;"></div>
                                            @elseif($devices[$i]->out_of_boundary && Carbon\Carbon::parse($last_locations[$i]->created_at)->addMinutes(15) > Carbon\Carbon::now())
                                                <div style="height: 20px; width: 20px; background-color: red; border-radius: 50%; display: inline-block;"></div>
                                            @elseif(Carbon\Carbon::parse($last_locations[$i]->created_at)->addMinutes(30) < Carbon\Carbon::now())
                                                <div style="height: 20px; width: 20px; background-color: grey; border-radius: 50%; display: inline-block;"></div>
                                            @endif
                                        </td>
                                    </tr>

                                @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection