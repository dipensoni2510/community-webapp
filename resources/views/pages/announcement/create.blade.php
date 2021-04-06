@extends('layouts/contentLayoutMaster')
@section('title', 'Announcement Create Page')
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
                            <form method="POST" action="{{route('announcements.store')}}">
                              @csrf
                                <div class="form-label-group mt-1">
                                    <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title" value="{{ old('title') }}" autocomplete="title" autofocus>
                                    <label for="title">title</label>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                  <label for="type">Type</label>
                                  <select class="custom-select form-control @error('type') is-invalid @enderror" name="type"
                                  value="{{ old('type') }}">
                                      <option value="">Select Type</option>
                                      <option value="maintainance" {{ old('type') === "maintainance" ? 'selected' : '' }}>
                                        Maintainance    
                                      </option>
                                      <option value="event" {{ old('type') === "event" ? 'selected' : '' }}>
                                        Event    
                                      </option>     
                                  </select>
                                  @error('type')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                                <div class="form-label-group">
                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" value="{{ old('description') }}"  autocomplete="description"></textarea>
                                    <label for="description">Description</label>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-label-group">
                                  <input type='text'
                                  class="form-control datepicker
                                  @error('date') is-invalid @enderror" id="date" 
                                  name="date" placeholder="Start Date" value="{{ old('date') }}" />
                                  <label for="date">Start Date</label>
                                  @error('date')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="form-label-group mt-1">
                                  <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                  <input type='text' class="form-control pickatime timepicker @error('time') is-invalid @enderror" name="time" id="time" placeholder="Select Time" value="{{ old('time') }}" step="1" />
                                  <label for="time">Time</label>
                                  @error('time')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                                <div class="form-label-group mt-1 mb-0">
                                  <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                  <input type='number' class="form-control @error('days') is-invalid @enderror" name="days" max="365" id="days" placeholder="Days" value="{{ old('days') }}" />
                                  <label for="days">Days</label>
                                  @error('days')
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
    <a href="/announcements" class="mr-1 btn btn-outline-warning">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
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

      // $(document).ready(function(){
      //   $('.timepicker').pickatime({
      //     formatSubmit: 'HH:i',
      //     hiddenName: true
      //   });
      // });
</script>
@endsection