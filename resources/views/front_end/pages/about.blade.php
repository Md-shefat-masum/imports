@extends('front_end.layouts.master')
@section('title','|About')

@section('content')
<div class="about_bg_area">
    <div class="container">

        @foreach($aboutOne as $data)
        <section class="about_section">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <figure>
                        <div class="about_thumb">
                            <img src="/images/about/{{$data->image}}" alt="">
                        </div>

                    </figure>
                </div>
                <div class="col-lg-6 col-md-6">
                    <figure>

                        <figcaption class="about_content">
                            <div class="section_title">
                                <h2>{{$data->title}}</h2>
                            </div>
                            <p style="text-align: left;">{!! $data->description !!}</p>

                        </figcaption>
                    </figure>
                </div>
            </div>
        </section>
        @endforeach
        @foreach($aboutThree as $data)
        <section class="about_section" style="margin: 0px 0px 30px 0px;">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <figure>

                        <figcaption class="about_content">
                            <h4 style="color: #ffa500;
                            font-weight: bold;
                            font-size: 30px;
                            padding: 10px 0px;
                            line-height: 30px;">{{$data->title}}</h4>
                            <h1>{{$data->project_name}}</h1>
                            <p>{!! $data->details !!}</p>

                        </figcaption>
                    </figure>
                </div>
                <div class="col-lg-6 col-md-6">
                    <figure>
                        <div class="about_thumb">
                            <img src="/images/about3/{{$data->image}}" alt="">
                        </div>

                    </figure>
                </div>
            </div>
        </section>

        @endforeach



    </div>
</div>

@endsection
