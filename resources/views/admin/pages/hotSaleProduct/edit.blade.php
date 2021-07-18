@extends('admin.layouts.master')
@section('title','|Slider Product')
@section('stylesheet')
@endsection
@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h4>Slider Product Update</h4>
                <form action="{{route('slider_product.update',$sliderProduct->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}


                    @method('PUT')

                    <div class="form-group">
                        <label for="">Product Category</label>
                        <select name="cat_id" id="" class="form-control" required>
                            <option disabled="" value="">Select Category</option>
                            @foreach($category as $c)
                                <option value="{{$c->id}}" @if($c->id==$sliderProduct->cat_id) selected @endif>{{$c->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Sub Category</label>
                            <select name="sub_cat" id="" class="form-control" required>
                                <option value="">Select Sub Category</option>
                                @foreach($subCategory as $c)
                                    <option value="{{$c->id}}" @if($c->id==$sliderProduct->sub_cat) selected @endif>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Product Unit</label>
                                <select name="unit" id="" class="form-control" required>
                                    <option disabled="" value="">Select Category</option>
                                    @foreach($unit as $u)
                                        <option value="{{$u->id}}" @if($u->id==$sliderProduct->unit) selected @endif>{{$u->unit}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Slider Position</label>
                                    <select name="slider_position" id="" class="form-control" required>
                                        <option value="1" @if($sliderProduct->slider_position==1) selected @endif>Up</option>
                                            <option value="0" @if($sliderProduct->slider_position==0) selected @endif>Down</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Product Name</label>
                                            <input type="text" name="p_name" class="form-control" value="{{$sliderProduct->p_name}}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Product Description</label>
                                            <textarea name="p_description" id="" cols="30" rows="10" class="form-control" required>{{$sliderProduct->p_description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product link</label>
                                            <input type="text" name="link" class="form-control" value="{{$sliderProduct->link}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Quintity</label>
                                            <input type="text" name="p_quientity" class="form-control" value="{{$sliderProduct->p_quientity}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product Price</label>
                                            <input type="number" name="price" class="form-control" value="{{$sliderProduct->price}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Product status</label>
                                            <select name="status" id="" class="form-control" required>
                                                <option value="1" @if($sliderProduct->status==1) selected @endif>Publish</option>
                                                <option value="0" @if($sliderProduct->status==0) selected @endif>Unpublish</option>
                                                <option value="2" @if($sliderProduct->status==2) selected @endif>Sold Out</option>
                                            </select>
                                        </div>

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
                                            <input type="submit" value="Slier Product Update" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br><br>
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

                                });

                            </script>
                        @endsection
