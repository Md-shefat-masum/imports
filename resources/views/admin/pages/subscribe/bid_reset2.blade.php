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
                    <h3 class="box-title">bid reset time ({{Carbon\Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at)->format('h:i a')}})</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{route('bid_reset_submit')}}" method="POST">
                        @csrf
                        <input type="time" class="form-control" name="reset_time">
                        <br>
                        <button class="btn btn-success mt-3 d-block">Set</button>
                    </form>
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
