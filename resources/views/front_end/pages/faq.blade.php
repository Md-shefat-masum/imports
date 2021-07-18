@extends('front_end.layouts.master')
@section('title','|About')

@section('content')
<!--about bg area start-->
<div class="about_bg_area">
    <div class="container">

        <!--testimonial area start-->
        <div class="faq-client-say-area">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="section_title">
                        <h2>FREQUENTLY ASKED QUESTIONS</h2>
                    </div>
                    <div class="faq-style-wrap" id="faq-five">
                        <div class="row">

                            <div class="col-lg-6" style="height: 500px; overflow-y: scroll;">
                                @php
                                $p=2;
                                
                                @endphp
                                   @foreach($faq as $data)
                                @if ($data->id ==1)


                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a id="octagon" class="collapsed" role="button" data-toggle="collapse"
                                                data-target="#faq-collapse1" aria-expanded="true"
                                                aria-controls="faq-collapse1"> <span
                                                    class="button-faq"></span>{{$data->title}}</a>
                                        </h5>
                                    </div>

                                </div>
                                @endif
                                @if ($data->id > 1)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-target="#faq-collapse2{{ $p }}" aria-expanded="false"
                                                aria-controls="faq-collapse2{{ $p }}"> <span
                                                    class="button-faq"></span>{{$data->title}}</a>
                                        </h5>
                                    </div>

                                </div>
                                @endif
                                @php
                                $p++;
                                @endphp

                                @endforeach
                            </div>
                            <div class="col-lg-6">
                                @php
                                $p=2;
                                @endphp
                                 @foreach($faq as $data)
                                @if ($data->id ==1)
                                <div id="faq-collapse1" class="collapse show" aria-expanded="true" role="tabpanel"
                                    data-parent="#faq-five">
                                    <div class="panel-body">
                                        <p>{!!$data->description!!}</p>

                                    </div>
                                </div>
                                @endif
                                @if ($data->id > 1)
                                <div id="faq-collapse2{{ $p }}" class="collapse" aria-expanded="false" role="tabpanel"
                                    data-parent="#faq-five">
                                    <div class="panel-body">

                                        <p>{!!$data->description!!}</p>
                                    </div>
                                </div>
                                @endif
                                @php
                                $p++;
                                @endphp

                                @endforeach
                            </div>


                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!--testimonial area end-->
    </div>
</div>
<!--about bg area end-->
@endsection
