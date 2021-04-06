@extends('layouts/contentLayoutMaster')
@section('title', 'Rent Pay Page')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">

<!-- file uploder vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
<!-- File Uploder Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
<style>
    .ui-datepicker-calendar {
    display: none;
    },
    .ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
	float: left;
    
    },
    .ui-priority-secondary,
.ui-widget-content .ui-priority-secondary,
.ui-widget-header .ui-priority-secondary {
	opacity: .7;
	filter:Alpha(Opacity=70); /* support: IE8 */
	font-weight: normal;
    display: none !important;
}
</style>
@endsection
@section('content')
@if( session('message'))
<div id="successMessage">
  <p class="alert {{ session('alert-class', 'alert-danger') }}">{{ session('message') }}</p>
</div>
@endif
<section class="row flexbox-container">
    <div class="col-xl-6 col-8 d-flex justify-content-center">
        <div class="card flex-fill">
            <div class="row m-0">
                <div class="col-lg-12 col-12 p-0">
                    <div class="card rounded-0 mb-0 p-2">
                        {{-- <div class="card-header pt-50 pb-1">
                          <div class="card-title">
                              <h4 class="mb-0">Update User</h4>
                          </div>
                      </div> --}}
                        <div class="card-content">
                            <div class="card-body pt-0 pb-0 pr-0 pl-0">
                                <form method="POST" action="{{url('/rents/'.$rent->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-label-group mt-1">
                                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                        <input id="card_holder_name" type="text" class="form-control @error('card_holder_name') is-invalid @enderror" name="card_holder_name" placeholder="Card Holder Name" value="{{ old('card_holder_name') }}" autocomplete="card_holder_name">
                                        <label for="card_holder_name">Card Holder Name</label>
                                        @error('card_holder_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group mt-1">
                                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                        <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" placeholder="4242-4242-4242-4242" max="16" value="{{ old('card_number') }}" autocomplete="card_number">
                                        <label for="card_number">Card Number</label>
                                        @error('card_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-label-group mb-0">
                                                <input type='text'
                                                class="form-control date-picker
                                                @error('expiry_date') is-invalid @enderror" id="expiry_date" 
                                                name="expiry_date" placeholder="Month" value="{{ old('expiry_date') }}" 
                                                autocomplete="off"/>
                                                <label for="expiry_date">Expiry date</label>
                                                @error('expiry_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                  @enderror
                                              </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-label-group mb-0">
                                                <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                                <input id="cvv_number" type="password" class="form-control @error('cvv_number') is-invalid @enderror" name="cvv_number" placeholder="CVV" max="3" value="{{ old('cvv_number') }}" autocomplete="cvv_number">
                                                <label for="cvv_number">CVV Number</label>
                                                    @error('cvv_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="flexbox-container">
    <div class="col-12">
        <a href="/rents" class="mr-1 btn btn-outline-warning">Cancel</a>
        <button type="submit" class="btn btn-primary">Pay</button>
    </div>
</div>
</form>
@endsection
@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>

<!-- File Uploder vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
<!-- End File Uploder vendor files -->
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pickers/dateTime/pick-a-datetime.js')) }}"></script>

<!-- File Uploder Page js files -->
<script src="{{ asset(mix('js/scripts/extensions/dropzone.js')) }}"></script>
<!-- End File Uploder Page js files -->

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
        // Month and Year Select Picker
        $(function() {
     $('.date-picker').datepicker(
                    {
                        dateFormat: "mm-yy",
                        changeMonth: true,
                        changeYear: true,
                        showButtonPanel: true,
                        
                        onClose: function(dateText, inst) {


                            function isDonePressed(){
                                return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
                            }

                            if (isDonePressed()){
                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');
                                
                                 $('.date-picker').focusout()//Added to remove focus from datepicker input box on selecting date
                            }
                        },
                        beforeShow : function(input, inst) {

                            inst.dpDiv.addClass('month_year_datepicker')

                            if ((datestr = $(this).val()).length > 0) {
                                year = datestr.substring(datestr.length-4, datestr.length);
                                month = datestr.substring(0, 2);
                                $(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                                $(this).datepicker('setDate', new Date(year, month-1, 1));
                                $(".ui-datepicker-calendar").hide();
                            }
                        }
                    })
});
</script>
@endsection