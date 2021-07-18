@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <form action="{{route('reset_now')}}" method="POST">
      @csrf
      <div class="card">
        <div class="card-header header-part">
          <div class="row">
            <div class="col-md-6 card_header_title">
              <h3><i class="fa fa-gg-circle"></i> Reset Now
                {{-- ({{Carbon\Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at)->format('h:i a')}})
              </h3> --}}
            </div>
            <div class="col-md-6 text-right card_header_btn">
            </div>
          </div>
        </div>
        <div class="card-body">

          <div class="form-group row custom_form">
            <label class="col-sm-3 col-form-label">Reset Biding Price:</label>
            <div class="col-sm-8">
              
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                Biding Price Reset Now
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Confirm Message</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" style="text-transform: capitalize;">
                      Are you sure you want to reset all bidding price is 0?
                    </div>
                    <div class="modal-footer">
                        <button type="Submit" class="btn btn-primary">Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




        </div>
        <div class="card-footer header-part text-center">

        </div>
      </div>
    </form>
  </div>
</div>

@endsection
@section('scripts')

@endsection