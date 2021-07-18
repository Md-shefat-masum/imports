@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::has('danger'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    {{ Session::get('danger') }}
                </div>
            @endif
            <div class="box">
                <div class="box-header with-border">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <tr>
                                <th style="">#</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Social Link</th>
                                <th>Action</th>
                            </tr>
                            <?php $i=0; ?>
                            @forelse ($quickContact as $contact)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        {{ $contact->address_first }} <br>
                                        {{ $contact->address_second }} <br>
                                        {{ $contact->address_third }}
                                    </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>
                                        <b>Facebook </b><br>
                                        {{ substr($contact->facebook, 0, 43) }}<br>
                                        <b>Twitter </b><br>
                                        {{ substr($contact->twitter, 0, 43) }}<br>
                                        <b>Gmail </b><br>
                                        {{ substr($contact->gmail, 0, 43) }}<br>
                                        <b>Linkedin </b><br>
                                        {{ substr($contact->linkedin, 0, 43) }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('editQuickContact', $contact->id) }}">Edit</a>
                                    </td>

                                </tr>
                            @empty

                            @endforelse
                        </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
