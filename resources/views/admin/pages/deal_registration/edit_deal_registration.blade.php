@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
        <form action="{{route('deal_registration_update',$deal->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Edit Deal Registration</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{ route('deal_registration') }}" class="btn"><i class="fa fa-reply"
									aria-hidden="true"></i>
								Back</a>
						</div>
					</div>
				</div>
				<div class="card-body">
                    @if (Session::has('success'))
					<div class="alert alert-info">{{ Session::get('success') }}</div>
				@endif
				@if (Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error') }}</div>
				@endif


				
            
                    
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="first_name"> First Name *</label>
						<div class="col-sm-8">
                        <input type="text" name="first_name" class="form-control" required value="{{ $deal->first_name }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="last_name"> Last Name *</label>
						<div class="col-sm-8">
                        <input type="text" name="last_name" class="form-control" required value="{{ $deal->last_name }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="email"> Email Address *</label>
						<div class="col-sm-8">
                        <input type="email" name="email" class="form-control" required value="{{ $deal->email }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="job_title"> Job Title *</label>
						<div class="col-sm-8">
                        <input type="text" name="job_title" class="form-control" required value="{{ $deal->job_title }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="company"> Company *</label>
						<div class="col-sm-8">
                        <input type="text" name="company" class="form-control" required value="{{ $deal->company }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="phone"> Phone *</label>
						<div class="col-sm-8">
                        <input type="number" name="phone" class="form-control" required value="{{ $deal->phone }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="website"> Website *</label>
						<div class="col-sm-8">
                        <input type="url" name="website" class="form-control" required value="{{ $deal->website }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="address"> Address *</label>
						<div class="col-sm-8">
                        <textarea name="address" id="my-editor" cols="30" rows="2" class="form-control" required>{{ $deal->address }}</textarea>
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
                        <label class="col-sm-3 col-form-label" for="country"> Country *</label>
						<div class="col-sm-8">
                        <input type="text" name="country" class="form-control" required value="{{ $deal->country }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="headquarters"> Headquarters </label>
						<div class="col-sm-8">
                        <input type="text" name="headquarters" class="form-control">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="indeustry"> Industry *</label>
						<div class="col-sm-8">
                        <select class="form-control" name="indeustry">
                            <option {{ ($deal->indeustry == "Advertising / Performance Mktg / Lead Gen" ) ? 'selected' : '' }} value="Advertising / Performance Mktg / Lead Gen">Advertising / Performance Mktg / Lead Gen</option>
                            <option {{ ($deal->indeustry == "Business Process Outsourcer (BPO)" ) ? 'selected' : '' }} value="Business Process Outsourcer (BPO)">Business Process Outsourcer (BPO)</option>
                            <option {{ ($deal->indeustry == "Business Support Services" ) ? 'selected' : '' }} value="Business Support Services">Business Support Services</option>
                            <option {{ ($deal->indeustry == "Collections" ) ? 'selected' : '' }} value="Collections">Collections</option>
                            <option {{ ($deal->indeustry == "Communications (Telco, Cable, ISP)" ) ? 'selected' : '' }} value="Communications (Telco, Cable, ISP)">Communications (Telco, Cable, ISP)</option>
                            <option {{ ($deal->indeustry == "Consumer Goods & Services" ) ? 'selected' : '' }} value="Consumer Goods & Services">Consumer Goods & Services</option>
                            <option {{ ($deal->indeustry == "Education" ) ? 'selected' : '' }} value="Education">Education</option>
                            <option {{ ($deal->indeustry == "Financial Services" ) ? 'selected' : '' }} value="Financial Services">Financial Services</option>
                            <option {{ ($deal->indeustry == "Government" ) ? 'selected' : '' }} value="Government">Government</option>
                            <option {{ ($deal->indeustry == "Health Insurance" ) ? 'selected' : '' }} value="Health Insurance">Health Insurance</option>
                            <option {{ ($deal->indeustry == "Healthcare Providers & Pharma" ) ? 'selected' : '' }} value="Healthcare Providers & Pharma">Healthcare Providers & Pharma</option>
                            <option {{ ($deal->indeustry == "Manufacturing" ) ? 'selected' : '' }} value="Manufacturing">Manufacturing</option>
                            <option {{ ($deal->indeustry == "Media / Entertainment / Publishing" ) ? 'selected' : '' }} value="Media / Entertainment / Publishing">Media / Entertainment / Publishing</option>
                            <option {{ ($deal->indeustry == "Other" ) ? 'selected' : '' }} value="Other">Other</option>
                            <option {{ ($deal->indeustry == "P & C Insurance" ) ? 'selected' : '' }} value="P & C Insurance">P & C Insurance</option>
                            <option {{ ($deal->indeustry == "Retail / Ecommerce" ) ? 'selected' : '' }} value="Retail / Ecommerce">Retail / Ecommerce</option>
                            <option {{ ($deal->indeustry == "Software" ) ? 'selected' : '' }} value="Software">Software</option>
                            <option {{ ($deal->indeustry == "Technology" ) ? 'selected' : '' }} value="Technology">Technology</option>
                            <option {{ ($deal->indeustry == "Travel / Transportation" ) ? 'selected' : '' }} value="Travel / Transportation">Travel / Transportation</option>
                            <option {{ ($deal->indeustry == "Utilities (Oil, Gas, Electric)" ) ? 'selected' : '' }} value="Utilities (Oil, Gas, Electric)">Utilities (Oil, Gas, Electric)</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="good_relation"> Currently do business with this company *</label>
						<div class="col-sm-8">
                        <select class="form-control" name="good_relation">
                            <option {{ ($deal->good_relation == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->good_relation == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="meeting_scheduled_completed"> Meeting Scheduled or Completed? *</label>
						<div class="col-sm-8">
                        <select class="form-control" name="meeting_scheduled_completed">
                            <option {{ ($deal->meeting_scheduled_completed == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->meeting_scheduled_completed == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>
                    </div>



                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="purchase_time_frame"> Purchase Timeframe? *</label>
						<div class="col-sm-8">
                        <select class="form-control" name="purchase_time_frame">
                            <option {{ ($deal->purchase_time_frame == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->purchase_time_frame == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>
                    </div>

                    <h2>Partner Submitter Information</h1>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="your_full_name"> Your Full Name *</label>
						<div class="col-sm-8">
                        <input type="text" name="your_full_name" class="form-control" required value="{{ $deal->your_full_name }}">
                    </div>
                    </div>
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="your_full_email"> Your Full Email *</label>
						<div class="col-sm-8">
                        <input type="email" name="your_full_email" class="form-control" required value="{{ $deal->your_full_email }}">
                    </div>
                    </div>
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="your_full_phone"> Your Full Phone *</label>
						<div class="col-sm-8">
                        <input type="number" name="your_full_phone" class="form-control" required value="{{ $deal->your_full_phone }}">
                    </div>
                    </div>
                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="fwb_affiliate"> FWB Affiliate / Entrepreneur Company *</label>
						<div class="col-sm-8">
                        <input type="text" name="fwb_affiliate" class="form-control" required value="{{ $deal->fwb_affiliate }}">
                    </div>
                    </div>

                    <div class="form-group row custom_form">
                        <label class="col-sm-3 col-form-label" for="is_the_sales_rep_name"> Is the Sales Rep Name the same as above? *</label>
						<div class="col-sm-8">
                        <select class="form-control" name="is_the_sales_rep_name">
                            <option {{ ($deal->is_the_sales_rep_name == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->is_the_sales_rep_name == "No" ) ? 'selected' : '' }} value="No">No</option>
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
@section('scripts')
	<script type="text/javascript">


		$(document).ready(function() {
				// Summernote Editor
				$('#details').summernote({
					 height: 200,
				});
		});

	</script>
@endsection
@endsection
