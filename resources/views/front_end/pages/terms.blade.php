@extends('front_end.layouts.master')
@section('title','|About')
@section('stylesheet')
<link rel="stylesheet" href="{{asset('front_end/css/about.css')}}">
<style>
    .how-img img{
        height: 200px;
        width: 200px;
        border-radius: 50%;
    }
</style>
@endsection
@section('content') 
<br><br>
<div class="container">
     @foreach($terms as $data)
    <div class="row">
        <div class="col-md-12">
           
          <div class="card">
      <div class="card-body">
        <h3 class="card-title">{{$data->title}}</h3>
        <p class="card-text">{!!$data->description !!}</p>
        
      </div>
    </div>
 
</div>

        </div>
         @endforeach
    </div>
</div>
@endsection