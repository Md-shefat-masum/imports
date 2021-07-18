@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 ">
            <div class="box">

                <div class="panel-heading"> Entrepreneurs Request </div>

                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif


                    {{-- <a class="pull-right btn btn-default" href="{{ url('/user-list/create') }}" >Add New user</a> --}}
                    <div class="table-responsive">                    
                        <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Type </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                        @foreach($user_list as $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row->user_type}}</td>
                                <td><b>{{$row->first_name}} {{$row->last_name}}</b></td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->cell_phone}}</td>
                                <td>
                                    <form class="form-inline" action="{{ route('supEnt-action') }}" method="post" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$row->id}}">
                                        <div class="form-group">
                                          <select class="form-control" id="sel1" name="status">
                                            <option value="pending" {{ ($row->user_action == 'pending') ? 'selected' : '' }}>Pending</option>
                                            <option value="reject" {{ ($row->user_action == 'reject') ? 'selected' : '' }}>Reject</option>
                                            <option value="active" {{ ($row->user_action == 'active') ? 'selected' : '' }}>Active</option>
                                          </select>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                    <form method="POST" action="{{ route('user-delete', $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                         {{ method_field('DELETE') }}
                                         {{ csrf_field() }}
                                         <button type="submit" class="btn btn-danger btn-sm" title="Remove From List" onclick="return confirm(&quot;Confirm Remove?&quot;)">Remove</button>
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

</section>

@section('scripts') @endsection
@endsection
