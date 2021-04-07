@extends('layouts/contentLayoutMaster')

@if(auth()->check())
@section('title', 'Welcome to Dashboard')
@endif

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="vendors/css/extensions/sweetalert2.min.css">
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> --}}
@endsection

@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/pages/dashboard-analytics.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/pages/card-analytics.css')) }}">
@endsection

@section('content')
@if( session('message'))
<div id="successMessage">
  <p class="alert {{ session('alert-class', 'alert-success') }}">{{ session('message') }}</p>
</div>
@endif
<section id="dashboard-analytics">
  <div class="row">
    @if (auth()->user()->role === "admin")
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="feather icon-user text-info font-medium-5"></i>
              </div>
            </div>
            <h2 class="text-bold-700">{{ $approvedTenant }}</h2>
            <p class="mb-1 line-ellipsis">Approved Tenents</p>
            <h2 class="text-bold-700">{{ $declinedTenant }}</h2>
            <p class="mb-0 line-ellipsis">Declined Tenents</p>
          </div>
        </div>
      </div>
    </div>
    @endif
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="feather icon-globe text-warning font-medium-5"></i>
              </div>
            </div>
            <h2 class="text-bold-700">{{ $company }}</h2>
            <p class="mb-0 line-ellipsis">Companies</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="feather icon-layers text-danger font-medium-5"></i>
              </div>
            </div>
            <h2 class="text-bold-700">{{ $services }}</h2>
            <p class="mb-0 line-ellipsis">Services</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
              <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                <div class="avatar-content">
                    <i class="feather icon-users text-primary font-medium-5"></i>
                </div>
              </div>
              <h2 class="text-bold-700">{{ $service_providers }}</h2>
            <p class="mb-0 line-ellipsis">Service Providers</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-success p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="feather icon-pocket text-success font-medium-5"></i>
              </div>
            </div>
            {{-- @if (auth()->user()->role === "admin") --}}
            <h2 class="text-bold-700">{{ auth()->user()->role === "admin" ? $paid_payment : $user_paid_payment }}</h2>
            <p class="mb-1 line-ellipsis">{{ auth()->user()->role === "admin" ?
             'Paid Payments' : 'Your Paid Payments'}}</p>
            <h2 class="text-bold-700">{{ auth()->user()->role === "admin" ? $pending_payment : $user_pending_payment }}</h2>
            <p class="mb-0 line-ellipsis"> {{ auth()->user()->role === "admin" ? 'Pending Payments' : 'Your Pending Payments' }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="fa fa-bullhorn text-danger font-medium-5"></i>
              </div>
            </div>
            <h2 class="text-bold-700">{{ $announcement }}</h2>
            <p class="mb-0 line-ellipsis">Announcements</p>
          </div>
        </div>
      </div>
    </div>
    @if (auth()->user()->role === "tenant")
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="fa fa-question-circle text-info font-medium-5"></i>
              </div>
            </div>
            <h2 class="text-bold-700">{{ $faqs }}</h2>
            <p class="mb-1 line-ellipsis">FAQ's</p>
          </div>
        </div>
      </div>
    </div>
    @endif
</div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="vendors/js/extensions/sweetalert2.all.min.js"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>
{{-- <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> --}}

<script>
  $(document).ready(function() {
    setTimeout(function() {
      $('#successMessage').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
  });
</script>

@endsection