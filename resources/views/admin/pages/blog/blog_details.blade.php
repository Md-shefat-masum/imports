
@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-part">
                <div class="row">
                    <div class="col-md-6 card_header_title">
                        <h3><i class="fa fa-gg-circle"></i> View Blog</h3>
                    </div>
                    <div class="col-md-6 text-right card_header_btn">
                        <a href="{{url('/pages/request-blog')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
                            Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
					@php
                    $user = DB::table('users')->where('id' , $blog->user_id)->first();
				@endphp
				<div class="col-md-1"></div>
                    <div class="col-md-10 text-center" id="printableTable">
                        <table cellspacing="0" bordercolor="gray" id="allTable" class="table table-bordered table-striped table-hover custom_view_table">
                            <tr>
								<div class="form-group text-center">
									<h3>{!!$blog->title!!}</h3>
									<br>
									<br>
									<img src="{{url('/')}}/images/blog/{{$blog->image}}" alt="IMAGE" style="width: 100%; height: auto;">
								</div>
								<p><b>Category : </b> {{$blog->category}} <span style="float: right;"><b>Date : </b> {{ date("d-m-Y || H:i A", strtotime($blog->created_at)) }}</span></p>
								<br>
								<div class="form-group">
									<p>{!! $blog->details !!}</p>
								</div>
								<p><b>Author : </b>
									@if (isset($user))
										{{$user->first_name}} {{$user->last_name}}
									@else
										NaN
									@endif
								 </p>
						
			
                            </tr>
                        
                           


                        </table>
                    </div>
					<div class="col-md-1"></div>
                </div>
            </div>
            <div class="card-footer header-part">
                <button onclick="generatePDF()" class="btn btn-sm btn-danger">PDF</button>
                <button onclick="$('table').tblToExcel();" class="btn btn-sm btn-success">EXCEL</button>
                <button id="csv" class="btn btn-sm btn-info">CSV</button>
                <button id="json" class="btn btn-sm btn-warning">JSON</button>
                <button onclick="printDiv()" class="btn btn-sm btn-primary">PRINT</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
	<script type="text/javascript">


		$(document).ready(function() {
				// Summernote Editor
				$('#details').summernote({
					 height: 200,
				});
		});

	</script>
@endsection
@endsection
