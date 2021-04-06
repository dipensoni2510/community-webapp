@extends('layouts/contentLayoutMaster')
@section('title', 'Maintainance Provider Create Page')
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
                                <form method="POST" action="{{url('/maintainance-providers')}}">
                                    @csrf
                                    <div class="form-label-group mt-1">
                                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Company Name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                        <label for="name">Service Provider Name</label>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                        <!-- <input type="text" id="inputName" class="form-control" placeholder="Name" required> -->
                                        <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" placeholder="Website" value="{{ old('website') }}" autocomplete="website" autofocus>
                                        <label for="website">Website</label>
                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                        <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email" required> -->
                                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" autocomplete="description">{{ old('description') }}</textarea>
                                        <label for="description">Description</label>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                        <!-- <input type="password" id="inputPassword" class="form-control" placeholder="Password" required> -->
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" autocomplete="phone" value="{{ old('phone') }}">
                                        <label for="phone">Phone</label>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-label-group">
                                        <!-- <input type="email" id="inputEmail" class="form-control" placeholder="Email" required> -->
                                        <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" autocomplete="address">{{ old('address') }}</textarea>
                                        <label for="address">Address</label>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-label-group mb-0">
                                        <select class="custom-select form-control @error('maintainance_service_id') is-invalid @enderror" name="maintainance_service_id" value="{{ old('maintainance_service_id') }}">
                                            <option value="">Select Service Type</option>
                                            @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ old('maintainance_service_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label for="maintainance_service_id">Service Type</label>
                                        @error('maintainance_service_id')
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
        <a href="/maintainance-providers" class="mr-1 btn btn-outline-warning">Cancel</a>
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
    $(document).ready(function() {
        // Month and Year Select Picker
        $('.pickadate-months-year').pickadate({
            selectYears: true,
            selectMonths: true,
            formatSubmit: 'yyyy/mm/dd'
        });
    });
</script>
@endsection