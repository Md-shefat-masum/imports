@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<div class="box">
			<h2 class="text-center">Update Your Product Category</h2>
			<div class="box-header with-border">
				
				
				<!-- modal start -->
				
				<form action="{{route('p_category.update',$cat->id)}}" method="post" id="add_data">
					@csrf
					@method('PUT')
					
					
					<div class="form-group">
						<label for="">Product Category</label>
						<input type="text" name="cat_name" class="form-control" value="{{$cat->cat_name}}" required>
					</div>
					<div class="form-group">
						<label for="">Sub Category</label>
						<select name="sub_cat" id="" class="form-control" required>
                      <option value="">Select Sub Category</option>
                    @foreach($subCategory as $c)
                      <option value="{{$c->id}}" @if($c->id==$cat->sub_cat) selected @endif>{{$c->name}}</option>
                      @endforeach
                    </select>
					</div>
					<div class="form-group">
						<label for="">Category Description</label>
						<textarea name="cat_description" id="" cols="30" rows="10" class="form-control" required>{{$cat->	cat_description}}</textarea>
					</div>
					
					<div class="form-group">
						<select name="status" id="status" class="form-control" required >
							<option value="0" @if($cat->status==0) selected @endif>Unpublish</option>
							<option value="1" @if($cat->status==1)selected @endif>Publish</option>
						</select>
					</div>
					<br>
					<input type="submit" class="btn btn-info" value="Update">
				</form>
				<!-- /.modal-dialog -->
			</div>
			<!-- modal end -->
		</div>
		<!-- /.box-header -->
		
		<!-- /.box-body -->
		
	</div>
	<!-- /.box -->
</div>
</div>
@endsection
@section('scripts')
@endsection