@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet') @endsection
@section('content')

    <div class="row">
        <div class="col-md-12 ">
            <div class="box">
                <a class="btn" href="{{ route('user-list.create') }}" style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">Add User</a>
                <div class="panel-heading"> User List </div>
                <div style="text-align: center;">
                    <a class="btn" href="{{ route('user-list.index') }}" style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">All List</a>
                    <a class="btn" href="{{ route('verified') }}" style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">Verified</a>
                    <a class="btn" href="{{ route('unverified') }}" style="background: #3C8DBC;color: #ffffff;margin-left: 15px;margin-top: 10px;">Unverified</a>
                </div>
                @if(Session::has('error'))
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('error') !!}
                    </div>
                @endif
                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif

                    <div class="table-responsive">

                        <table id="myTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th> S.N.</th>
                                    <th> Type </th>
                                    <th> Name </th>
                                    <th> email </th>
                                    <th> Email Verify </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp

                                @foreach($user_list as $row)
                                  @if($row->email != 'sohangood12@gmail.com')
                                      @php $i++; @endphp
                                      <tr>
                                          <td>{{$i}}</td>
                                          <td>{{$row->type}}</td>
                                          <td><b>{{$row->first_name}}</b></td>
                                          <td>{{$row->email}}</td>
                                          <td>{{ ($row->email_verified_at == null) ? 'Unverified' : 'Verified' }}</td>
                                          <td>
                                              <a href="{{ url('/user-list/'.$row->id.'/edit') }}" class="btn btn-default"> Edit</a>
                                              @if(Auth::user()->group_id==1)
                                                  <form  class="delete" action="{{ url('/user-list/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" style="display: inline-block;">
                                                      {{method_field('DELETE')}}
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                      <button type="submit" class="btn btn-danger">Delete</button>
                                                  </form>
                                                  <a href="{{ route('resendEmail', $row->id) }}" class="btn btn-primary"> Resend</a>
                                              @endif
                                          </td>
                                      </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{ $user_list }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

@section('scripts') @endsection
@endsection
