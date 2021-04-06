@extends('layouts/contentLayoutMaster')
@section('title', 'Payment')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">

<!-- file uploder vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
<!-- File Uploder Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
@endsection
@section('content')
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
                                <form method="POST" action="{{url('/payments')}}">
                                    @csrf
                                    <div class="form-label-group">
                                      <select class="custom-select form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}">
                                          <option value="">Select Tenant</option>
                                          @foreach ($tenants as $tenant)
                                          <option value="{{ $tenant->id }}" {{ old('user_id') == $tenant->id ? 'selected' : '' }}>
                                              {{ $tenant->first_name.' '.$tenant->last_name }}
                                          </option>
                                          @endforeach
                                      </select>
                                      <label for="user_id">Tenant Name</label>
                                      @error('user_id')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                  </div>

                                  <div class="form-label-group">
                                    <input type='text'
                                    class="form-control datepicker
                                    @error('start_date') is-invalid @enderror" id="start_date" 
                                    name="start_date" placeholder="Start Date" value="{{ old('start_date') }}" />
                                    <label for="start_date">Start Date</label>
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                </div>

                                <div class="form-label-group">
                                  <input type='text'
                                  class="form-control datepicker
                                  @error('end_date') is-invalid @enderror" id="end_date" 
                                  name="end_date" placeholder="End Date" value="{{ old('end_date') }}" />
                                  <label for="end_date">End Date</label>
                                  @error('end_date')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>

                                    <div class="form-label-group mt-1">
                                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                        <input id="monthly_rent" type="text" class="form-control @error('monthly_rent') is-invalid @enderror" name="monthly_rent" placeholder="Monthly Rent" value="{{ old('monthly_rent') }}" autocomplete="monthly_rent">
                                        <label for="monthly_rent">Monthly Rent</label>
                                        @error('monthly_rent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                        <input id="monthly_maintainance_rent" type="text" class="form-control @error('monthly_maintainance_rent') is-invalid @enderror" name="monthly_maintainance_rent" placeholder="Maintainance Rent" value="{{ old('monthly_maintainance_rent') }}" autocomplete="monthly_maintainance_rent">
                                        <label for="monthly_maintainance_rent">Maintainance Rent</label>
                                        @error('monthly_maintainance_rent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">    
                                      <div class="flex">
                                          <input id="contract" type="file" class="form-control @error('contract') is-invalid @enderror" name="contract" autocomplete="contract">
                                              <!-- <img id="image" height="40" width="40" /> -->
                                      </div>
                                      <label for="contract" class="custom-control-label">Upload Contract</label>
                                      @error('contract')
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
</section>
<div class="flexbox-container">
    <div class="col-12">
        <a href="/payments" class="mr-1 btn btn-outline-warning">Cancel</a>
        <button type="submit" class="btn btn-primary">Add</button>
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

<script>
        // Month and Year Select Picker
        $('.datepicker').pickadate({
            yearSelector: true,
            monthSelector: true,
            format: 'yyyy-mm-dd'
        });
</script>
@endsection