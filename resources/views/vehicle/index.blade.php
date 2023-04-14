<x-app-layout>
<style>
    body{
      color: white;
    }

  </style>
<div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>VDB</h1>
                    </div>
                    <br>
                    <div class="card-body">
                        <a href="{{ url('/vehicle/create') }}" class="btn btn-success btn-sm" title="Add New Vehicle">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>License Plate</th>
                                        <th>Start location</th>
                                        <th>End destination</th>
                                        <th>status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($vehicle as $item)
                                @if($item->deleted == TRUE)
                                    @continue
                                @endif
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->driver_id }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->license_plate }}</td>
                                        <td>{{ $item->airport_address_id }}</td>
                                        <td>{{ $item->depot_address_id }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ url('/vehicle/' . $item->id) }}" title="View Vehicle"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/vehicle/' . $item->id . '/edit') }}" title="Edit Vehicle"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{ url('/vehicle' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
    </div>
</x-app-layout>