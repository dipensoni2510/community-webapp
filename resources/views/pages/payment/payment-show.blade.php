@extends('layouts/contentLayoutMaster')
@section('title', 'Payment Show Page')
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
              <td class="font-weight-bold">Tenant Name</td>
              <td> {{ $payemt->user->first_name.' '.$payemt->user->last_name }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Start Date</td>
              <td>{{ $payemt->start_date }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Monthly Rent</td>
              <td> {{ $payemt->monthly_rent }} </td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Status</td>
              <td> {{ $payemt->status }} </td>
            </tr>

            <tr>
              <td class="font-weight-bold">End Date</td>
              <td>{{ $payemt->end_date }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Monthly Maintainance</td>
              <td>{{ $payemt->monthly_maintainance_rent }}</td>
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
    <a href="/payments" class="btn btn-outline-dark">Back</a>
  </div>
</div>
<!-- account end -->
@endsection