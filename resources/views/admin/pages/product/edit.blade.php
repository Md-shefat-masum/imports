@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      @method('PUT')
      {{csrf_field()}}
      <div class="card">
        <div class="card-header header-part">
          <div class="row">
            <div class="col-md-6 card_header_title">
              <h3><i class="fa fa-gg-circle"></i> Update Product</h3>
            </div>
            <div class="col-md-6 text-right card_header_btn">
              <a href="{{url('/pages/product')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
                Back</a>
            </div>
          </div>
        </div>
        <div class="card-body">





          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Category</label>
            <div class="col-sm-8">
              <select name="cat_id" id="" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($category as $c)
                <option value="{{$c->id}}" @if($c->id==$product->cat_id) selected @endif>{{$c->cat_name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Sub Category</label>
            <div class="col-sm-8">
              <select name="sub_cat_id" id="" class="form-control" required>
                <option value="">Select Sub Category</option>
                @foreach($subCategory as $cc)
                <option value="{{$cc->id}}" @if($cc->id==$product->sub_cat_id) selected @endif>{{$cc->name}}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Name</label>
            <div class="col-sm-8">
              <input type="text" name="p_name" class="form-control" value="{{$product->p_name}}">
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Unit</label>
            <div class="col-sm-8">
              <select name="unit" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($unit as $u)
                <option value="{{$u->id}}" @if($u->id==$product->unit) selected @endif >{{$u->unit}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label" for="description">Product Description</label>
            <div class="col-sm-8">
              <textarea name="p_description" id="my-editor" cols="30" rows="10" class="form-control"
                required>{{$product->p_description}}</textarea>
                <script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}"></script>
                <script>
                  var options = {
                        width: "100%",
                    };
                    CKEDITOR.replace('my-editor', options);
                </script>
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Link Share</label>
            <div class="col-sm-8">
              <input type="text" name="link" class="form-control" value="{{$product->link}}">
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Quantity</label>
            <div class="col-sm-8">
              <input type="text" name="p_quientity" class="form-control" value="{{$product->p_quientity}}" required>
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Bundle Quantity</label>
            <div class="col-sm-8">
              <input type="number" name="min_quientity" id="min_quientity" class="form-control"
                value="{{$product->min_quientity}}" required>
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Unit Price</label>
            <div class="col-sm-8">
              <input type="number" name="price" id="price" class="form-control" value="{{$product->price}}" required>
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Bundle Price</label>
            <div class="col-sm-8">
              <input type="number" name="bundle_price" id="bundle_price" class="form-control"
                value="{{$product->bundle_price}}" required>
            </div>
          </div>

          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Model</label>
            <div class="col-sm-8">
              <input type="text" name="model" class="form-control" value="{{$product->model}}" required>
            </div>
          </div>
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product Brand</label>
            <div class="col-sm-8">
              <input type="text" name="brand" value="{{$product->brand}}" class="form-control">
            </div>

          </div>
          @if (Auth::user()->group_id !== 5 || Auth::user()->group_id !== 4)
          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Product status</label>
            <div class="col-sm-8">
              <select name="status" id="" class="form-control" required>
                <option value="1" @if($product->status==1) selected @endif>Publish</option>
                <option value="0" @if($product->status==0) selected @endif>Unpublish</option>
                <option value="2" @if($product->status==2) selected @endif>Sold Out</option>
              </select>
            </div>
          </div>
          @endif
          @if (Auth::user()->group_id == 5 || Auth::user()->group_id == 4)
          <input type="hidden" name="status" value="0">
          @endif
          <div class="input-group control-group increment">
            <label class="col-sm-3 col-form-label"></label>
           
              <input type="file" name="image[]" class="form-control">
              <div class="input-group-btn">
                <button class="btn btn-info" type="button"><i class="fa fa-plus"></i> Add</button>
              </div>
            
          </div>
        <div class="clone hide">
          
          <div class="control-group input-group" style="margin-top:10px">
            <label class="col-sm-3 col-form-label"></label>
            <input type="file" name="image[]" class="form-control">
            <div class="input-group-btn">
              <button class="btn btn-danger" type="button"><i class="fa fa-remove"></i> 
                Remove</button>
            </div>
          </div>
        </div>

      </div>
      <div class="card-footer header-part text-center">
        <button type="submit" class="btn btn-info">Update</button>
      </div>
  </div>
  </form>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {

    $(".btn-info").click(function(){
    var html = $(".clone").html();
    $(".increment").after(html);
    });

    $("body").on("click",".btn-danger",function(){
    $(this).parents(".control-group").remove();

    });

    // Summernote Editor

    $("#min_quientity, #price").keyup(function(){
        var minQuientity = $('#min_quientity').val();
        var unitPrice = $('#price').val();
        var bundlePrice = minQuientity * unitPrice
        $('#bundle_price').val(bundlePrice);
    });
});

</script>
@endsection