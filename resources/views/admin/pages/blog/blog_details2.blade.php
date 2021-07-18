
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
                @php
                    $user = DB::table('users')->where('id' , $blog->user_id)->first();
                @endphp

          		<form>
                	<div class="form-group text-center">
                        <h3>{!!$blog->title!!}</h3>
                        <br>
                        <br>
                        <img src="{{url('/')}}/public/images/blog/{{$blog->image}}" alt="IMAGE" style="width: 100%; height: auto;">
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
               </form>


		</div>
		<!-- /.box -->
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
