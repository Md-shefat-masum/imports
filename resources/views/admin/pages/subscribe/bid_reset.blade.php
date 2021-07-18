@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{route('bid_reset_submit')}}" method="POST">
            @csrf
        <div class="card">
          <div class="card-header header-part">
            <div class="row">
              <div class="col-md-6 card_header_title">
                <h3><i class="fa fa-gg-circle"></i> bid reset time ({{Carbon\Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at)->format('h:i a')}})</h3>
              </div>
              <div class="col-md-6 text-right card_header_btn">
              </div>
            </div>
          </div>
          <div class="card-body">
      
            <div class="form-group row custom_form">
              <label class="col-sm-3 col-form-label">Bid Reset Time:</label>
              <div class="col-sm-8">
                <input type="time" class="form-control" name="reset_time">
              </div>
            </div>
  
          
           
  
          </div>
          <div class="card-footer header-part text-center">
            <button type="submit" class="btn btn-info">Set</button>
          </div>
        </div>
      </form>
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
