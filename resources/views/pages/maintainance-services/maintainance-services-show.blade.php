@extends('layouts/contentLayoutMaster')
@section('title', 'Maintainance Service View Page')
@section('page-style')
<style>
  table td{ 
    vertical-align: baseline;
    padding-bottom: 0.8rem;
    min-width: 140px;
    word-break: break-word;  
  } 
  .card-img-top {
    width: 100% !important;
  }
  .card {
    width: 50% !important;
  }
  </style>
  @endsection
  @section('content')
  <div class="row">
      <!-- account start -->
      <div class="col-12">
            {{-- <div class="card-title">Account</div> --}}
            <div class="row">
                <div class="col-xl-6 col-sm-12">
                  <div class="card">
                    <div class="card-content">
                    <img class="card-img-top img-fluid" src="{{ $service->image }}" class="w-100 rounded mb-2"
                    alt="image">
                      <div class="card-body">
                        <h4 class="card-title">{{ $service->title }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
      </div>
    <div class="flexbox-container">
      <div class="col-12">
        <a href="/maintainance-services" class="btn btn-outline-dark">Back</a>
      </div>
    </div>
  </div>
<!-- account end -->
@endsection