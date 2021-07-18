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
				
				
          	<form action="{{route('sf.update',$sf->id)}}" method="POST" enctype="multipart/form-data">
                	@csrf
                	@method('PUT')
            
             
                
                	<input type="hidden" name="auther_id" value="{{ Auth::user()->id }} ">
                	
                	<div class="form-group">
                		<label for="">Suppler Forum Title</label>
                		<input type="text" name="title" class="form-control"  value="{{$sf->title}}">
                	</div>
                	<div class="form-group">
                		<label for="">Suppler Forum Details</label>
                		<textarea name="details" id="" cols="30" rows="10" class="form-control">{{$sf->details}}</textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Suppler Forum Category</label>
                		<input type="text" name="category" class="form-control"  value="{{$sf->category}}">
                	</div>
                	
                	<div class="form-group">
                		<label for="">Suppler Forum Status</label>
                		<select name="status" id="" class="form-control">
                				<option value="{{$sf->status}}">
												@if($sf->status==0)
												{{"Unpulish"}}
												@else
												{{"Publish"}}
												@endif
											</option>
											<option>----------------</option>
											<option value="0">Unpublish</option>
											<option value="1">Publish</option>

                		</select>
                	</div>
                	<div class="form-group">
                		<label for="">Suppler Forum File</label>
                		<input type="file" name="image" class="form-control">
                	</div>
					<br>
					<input type="submit" class="btn btn-success" value="Update">
               </form>
        
			
		</div>
		<!-- /.box -->
	</div>
</div>
</div>

@section('scripts')
@endsection
@endsection