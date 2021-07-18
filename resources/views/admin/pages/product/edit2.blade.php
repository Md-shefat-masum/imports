 @extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">


 <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
     {{csrf_field()}}
     @method('PUT')
          	 	{{csrf_field()}}


                	<div class="form-group">
                		<label for="">Product Category</label>
                		<select name="cat_id" id="" class="form-control" required>
                			<option value="">Select Category</option>
							@foreach($category as $c)
                			<option value="{{$c->id}}" @if($c->id==$product->cat_id) selected @endif>{{$c->cat_name}}</option>
                			@endforeach
                		</select>
                	</div>

                  <div class="form-group">
                    <label for="">Sub Category</label>
                    <select name="sub_cat_id" id="" class="form-control" required>
                      <option value="">Select Sub Category</option>
              @foreach($subCategory as $cc)
                      <option value="{{$cc->id}}" @if($cc->id==$product->sub_cat_id) selected @endif>{{$cc->name}}</option>
                      @endforeach
                    </select>
                  </div>

                	<div class="form-group">
                		<label for="">Product Name</label>
                		<input type="text" name="p_name" class="form-control" value="{{$product->p_name}}">
                	</div>
                	<div class="form-group">
                		<label for="">Product Unit</label>
                		<select name="unit" class="form-control" required>
                			<option value="">Select Category</option>
							@foreach($unit as $u)
                			<option value="{{$u->id}}" @if($u->id==$product->unit) selected @endif >{{$u->unit}}</option>
                			@endforeach
                		</select>
                	</div>
                	<div class="form-group">
                		<label for="description">Product Description</label>
                		<textarea name="p_description" id="description" cols="30" rows="10" class="form-control" required>{{$product->p_description}}</textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Product Link Share</label>
                		<input type="text" name="link" class="form-control" value="{{$product->link}}">
                	</div>
                	<div class="form-group">
                		<label for="">Product Quantity</label>
                		<input type="text" name="p_quientity" class="form-control" value="{{$product->p_quientity}}" required>
                	</div>
                    <div class="form-group">
                        <label for="">Bundle Quantity</label>
                        <input type="number" name="min_quientity" id="min_quientity" class="form-control" value="{{$product->min_quientity}}" required>
                    </div>
                	<div class="form-group">
                		<label for="">Unit Price</label>
                		<input type="number" name="price" id="price" class="form-control" value="{{$product->price}}" required>
                	</div>
                    <div class="form-group">
                        <label for="">Bundle Price</label>
                        <input type="number" name="bundle_price" id="bundle_price" class="form-control" value="{{$product->bundle_price}}" required>
                    </div>

					 <div class="form-group">
						 <label for="">Product Model</label>
						 <input type="text" name="model" class="form-control" value="{{$product->model}}" required>
					 </div>
					 <div class="form-group">
						 <label for="">Product Brand</label>
						 <input type="text" name="brand" value="{{$product->brand}}" class="form-control"  >
					 </div>
                     @if (Auth::user()->group_id !== 5 || Auth::user()->group_id !== 4)
                    	<div class="form-group">
                    		<label for="">Product status</label>
                    		<select name="status" id="" class="form-control" required>
                    			<option value="1" @if($product->status==1) selected @endif>Publish</option>
                    			<option value="0" @if($product->status==0) selected @endif>Unpublish</option>
                    			<option value="2" @if($product->status==2) selected @endif>Sold Out</option>
                    		</select>
                    	</div>
                    @endif
                    @if (Auth::user()->group_id == 5 || Auth::user()->group_id == 4)
                        <input type="hidden" name="status" value="0">
                    @endif
                <div class="input-group control-group increment" >
          <input type="file" name="image[]" class="form-control">
          <div class="input-group-btn">
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="image[]" class="form-control">
            <div class="input-group-btn">
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
              </div>
            <br>
       <div class="form-group">
           <input type="submit" value="Update" class="btn btn-info">
       </div>
</form>
</div>
</div>
<br><br><br>
            @endsection
@section('scripts')
<script type="text/javascript">


$(document).ready(function() {

    $(".btn-success").click(function(){
    var html = $(".clone").html();
    $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){
    $(this).parents(".control-group").remove();

    });

    // Summernote Editor
	$('#description').summernote();

    $("#min_quientity, #price").keyup(function(){
        var minQuientity = $('#min_quientity').val();
        var unitPrice = $('#price').val();
        var bundlePrice = minQuientity * unitPrice
        $('#bundle_price').val(bundlePrice);
    });
});

</script>
@endsection
