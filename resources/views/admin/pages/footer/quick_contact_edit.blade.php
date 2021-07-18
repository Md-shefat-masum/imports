@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('updateQuickContact', $quickContact->id) }}" method="post" id="add_data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header header-part">
                    <div class="row">
                        <div class="col-md-6 card_header_title">
                            <h3><i class="fa fa-gg-circle"></i> Update Your Qucik Contact</h3>
                        </div>
                        <div class="col-md-6 text-right card_header_btn">
                            <a href="{{url('/pages/quick-contact')}}" class="btn"><i class="fa fa-reply"
                                    aria-hidden="true"></i>
                                Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" class="form-control" id="phone"
                                placeholder="Enter Phone number" required value="{{ $quickContact->phone }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Enter email address" required value="{{ $quickContact->email }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Address line 1</label>
                        <div class="col-sm-8">
                            <input type="text" name="address_first" class="form-control" id="address_first"
                                placeholder="Enter street address" required value="{{ $quickContact->address_first }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Address line 2</label>
                        <div class="col-sm-8">
                            <input type="text" name="address_second" class="form-control" id="address_second"
                                placeholder="Enter city address" required value="{{ $quickContact->address_second }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Address line 3</label>
                        <div class="col-sm-8">
                            <input type="text" name="address_third" class="form-control" id="address_third"
                                placeholder="Enter country address" required value="{{ $quickContact->address_third }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Facebook</label>
                        <div class="col-sm-8">
                            <input type="text" name="facebook" class="form-control" id="facebook"
                                placeholder="Enter facebook address" required value="{{ $quickContact->facebook }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Twitter</label>
                        <div class="col-sm-8">
                            <input type="text" name="twitter" class="form-control" id="twitter"
                                placeholder="Enter twitter address" required value="{{ $quickContact->twitter }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Gmail</label>
                        <div class="col-sm-8">
                            <input type="text" name="gmail" class="form-control" id="gmail"
                                placeholder="Enter gmail address" required value="{{ $quickContact->gmail }}">
                        </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label">Linkedin</label>
                        <div class="col-sm-8">
                            <input type="text" name="linkedin" class="form-control" id="linkedin"
                                placeholder="Enter linkedin address" required value="{{ $quickContact->linkedin }}">
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