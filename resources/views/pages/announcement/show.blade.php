@extends('layouts/contentLayoutMaster')
@section('title', 'Announcement View')
@section('page-style')
<style>
  table td{ 
    vertical-align: baseline;
    padding-bottom: 0.8rem;
    min-width: 140px;
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
              <td class="font-weight-bold">Title</td>
              <td> {{ $announcement->title }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Date</td>
              <td> {{ $announcement->date }} </td>
            </tr>
            <tr>
              <td class="font-weight-bold">Description</td>
              <td> {{ $announcement->description }} </td>
            </tr>
          </table>
        </div>
        <div class="col-md-6 col-12">
          <table>
            <tr>
              <td class="font-weight-bold">Type</td>
              <td>{{ $announcement->type }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Time</td>
              <td>{{ $announcement->time }}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Days</td>
              <td>{{ $announcement->days }}</td>
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
    <a href="/announcements" class="btn btn-outline-dark">Back</a>
  </div>
</div>
<!-- account end -->
@endsection