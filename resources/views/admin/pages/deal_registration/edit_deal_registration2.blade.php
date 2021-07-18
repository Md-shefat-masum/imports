@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-header with-border">

				@if (Session::has('success'))
					<div class="alert alert-info">{{ Session::get('success') }}</div>
				@endif
				@if (Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error') }}</div>
				@endif
                <h2>Edit Deal Registration</h2>
                <a href="{{ route('deal_registration') }}" class="btn btn-default pull-right">Back</a>
                <br>
                <br>
          	<form action="{{route('deal_registration_update',$deal->id)}}" method="POST" enctype="multipart/form-data">
                	@csrf
                	@method('PUT')



                    <div class="form-group">
                        <label for="first_name"> First Name *</label>
                        <input type="text" name="first_name" class="form-control" required value="{{ $deal->first_name }}">
                    </div>

                    <div class="form-group">
                        <label for="last_name"> Last Name *</label>
                        <input type="text" name="last_name" class="form-control" required value="{{ $deal->last_name }}">
                    </div>

                    <div class="form-group">
                        <label for="email"> Email Address *</label>
                        <input type="email" name="email" class="form-control" required value="{{ $deal->email }}">
                    </div>

                    <div class="form-group">
                        <label for="job_title"> Job Title *</label>
                        <input type="text" name="job_title" class="form-control" required value="{{ $deal->job_title }}">
                    </div>

                    <div class="form-group">
                        <label for="company"> Company *</label>
                        <input type="text" name="company" class="form-control" required value="{{ $deal->company }}">
                    </div>

                    <div class="form-group">
                        <label for="phone"> Phone *</label>
                        <input type="number" name="phone" class="form-control" required value="{{ $deal->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="website"> Website *</label>
                        <input type="url" name="website" class="form-control" required value="{{ $deal->website }}">
                    </div>

                    <div class="form-group">
                        <label for="address"> Address *</label>
                        <textarea name="address" cols="30" rows="2" class="form-control" required>{{ $deal->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="country"> Country *</label>
                        <input type="text" name="country" class="form-control" required value="{{ $deal->country }}">
                    </div>

                    <div class="form-group">
                        <label for="headquarters"> Headquarters </label>
                        <input type="text" name="headquarters" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="indeustry"> Industry *</label>
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
                    <div class="form-group">
                        <label for="good_relation"> Currently do business with this company *</label>
                        <select class="form-control" name="good_relation">
                            <option {{ ($deal->good_relation == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->good_relation == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meeting_scheduled_completed"> Meeting Scheduled or Completed? *</label>
                        <select class="form-control" name="meeting_scheduled_completed">
                            <option {{ ($deal->meeting_scheduled_completed == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->meeting_scheduled_completed == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="purchase_time_frame"> Purchase Timeframe? *</label>
                        <select class="form-control" name="purchase_time_frame">
                            <option {{ ($deal->purchase_time_frame == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->purchase_time_frame == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>

                    <h2>Partner Submitter Information</h1>

                    <div class="form-group">
                        <label for="your_full_name"> Your Full Name *</label>
                        <input type="text" name="your_full_name" class="form-control" required value="{{ $deal->your_full_name }}">
                    </div>
                    <div class="form-group">
                        <label for="your_full_email"> Your Full Email *</label>
                        <input type="email" name="your_full_email" class="form-control" required value="{{ $deal->your_full_email }}">
                    </div>
                    <div class="form-group">
                        <label for="your_full_phone"> Your Full Phone *</label>
                        <input type="number" name="your_full_phone" class="form-control" required value="{{ $deal->your_full_phone }}">
                    </div>
                    <div class="form-group">
                        <label for="fwb_affiliate"> FWB Affiliate / Entrepreneur Company *</label>
                        <input type="text" name="fwb_affiliate" class="form-control" required value="{{ $deal->fwb_affiliate }}">
                    </div>

                    <div class="form-group">
                        <label for="is_the_sales_rep_name"> Is the Sales Rep Name the same as above? *</label>
                        <select class="form-control" name="is_the_sales_rep_name">
                            <option {{ ($deal->is_the_sales_rep_name == "Yes" ) ? 'selected' : '' }} value="Yes">Yes</option>
                            <option {{ ($deal->is_the_sales_rep_name == "No" ) ? 'selected' : '' }} value="No">No</option>
                        </select>
                    </div>
					<br>
					<input type="submit" class="btn btn-success" value="Update">
               </form>


		</div>
		<!-- /.box -->
	</div>
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
