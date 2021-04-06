@extends('layouts/contentLayoutMaster')

@if(auth()->check())
@section('title', 'Faq')
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
<section id="basic-datatable">
  
        @foreach ($faqs as $faq)
        <div class="row">
          <div class="col-12">
            <div class="card">
          <div class="card-header">
            <b>{{ $faq->question }}?</b>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <p>{{ $faq->answer }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
        @endforeach
        {!! $faqs->links() !!}
</section>
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