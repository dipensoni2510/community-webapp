@extends('layouts/contentLayoutMaster')
@section('title', 'Maintainance Provider Page')
@section('page-style')
<style>
  table td {
    vertical-align: baseline;
    padding-bottom: 0.8rem;
    min-width: 190px;
    word-break: break-word;
  }
</style>
@endsection
@section('content')
<div class="row">
  <!-- account start -->
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        {{-- <div class="card-title">Account</div> --}}
        <div class="row">
          {{-- <div class="col-2 users-view-image">
            <img src="{{ $user->avatar }}" class="w-100 rounded mb-2"
          alt="avatar">
          <!-- height="150" width="150" -->
        </div> --}}
        <div class="col-sm-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Service Provider Name</td>
              <td> {{ $service->name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Service Type</td>
              <td>{{ $service->maintainance_service->title }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Description</td>
              <td> {{ $service->description }} </td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Phone</td>
              <td> {{ $service->phone }} </td>
            </tr>

            <tr>
              <td class="font-weight-bold">Website</td>
              <td>{{ $service->website }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Address</td>
              <td>{{ $service->address }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="flexbox-container">
  <div class="col-12">
    <a href="/maintainance-providers" class="btn btn-outline-dark">Back</a>
  </div>
</div>
<!-- account end -->
@endsection