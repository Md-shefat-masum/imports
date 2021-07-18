@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Subscribes List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">                    
                        <table class="table table-bordered" id="tableData">
                            <thead>
                                <tr>
                                    <th style="">#</th>
                                    <th>Email</th>
                                    <th>Subscribe Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $subscribes = DB::table('subscribes')->get();
                                @endphp
                                <?php $i=0; ?>
                                @foreach($subscribes as $data)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{ date("d-m-Y || H:i A", strtotime($data->created_at)) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableData').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>
@endsection
