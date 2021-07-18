@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">

    <div class="col-md-12">
        @if (Session::has('success'))
        <div class="alert alert-info">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form method="post" action="{{route('b_category_update',$cat->id)}}" id="add_data"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header header-part">
                    <div class="row">
                        <div class="col-md-6 card_header_title">
                            <h3><i class="fa fa-gg-circle"></i> Update Your Forum Category</h3>
                        </div>
                        <div class="col-md-6 text-right card_header_btn">
                            <a href="{{url('/pages/b_category')}}" class="btn"><i class="fa fa-reply"
                                    aria-hidden="true"></i>
                                Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <script>
                        swal({
							  title: "Successfully!",
							  text: "Updated Information.",
							  timer: 5000,
							  icon: "success",
						  });
  
                    </script>
                    @endif
                    @if(Session::has('error'))
                    <script>
                        swal({
							  title: "Opps!",
							  text: "Updated Failed.",
							  timer: 5000,
							  icon: "warning",
						  });
  
                    </script>
                    @endif



                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Product Category</label>
                        <div class="col-sm-8">
                            <input type="text" name="cat_name" class="form-control" value="{{$cat->cat_name}}" required>
                        </div>
                        </div>

                        <div class="form-group row custom_form">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <select name="status" id="status" class="form-control" required>
                                    <option value="0" @if($cat->status==0) selected @endif>Unpublish</option>
                                    <option value="1" @if($cat->status==1)selected @endif>Publish</option>
                                </select>
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
@endsection