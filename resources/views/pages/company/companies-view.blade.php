@extends('layouts/contentLayoutMaster')
@section('title', 'Company List Page')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="vendors/css/extensions/sweetalert2.min.css">
@endsection

@section('datatable-css')
<link rel="stylesheet" href="vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('content')
@if( session('message'))
<div id="successMessage">
  <p class="alert {{ session('alert-class', 'alert-success') }}">{{ session('message') }}</p>
</div>
@endif

<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="companies/create" class="btn btn-primary">Add Company</a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table id="companyTable" class="table zero-configuration data-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Description</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Actions</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('datatable-js')
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script> --}}

<script src="vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="vendors/js/tables/datatable/datatables.min.js"></script>
<script src="vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $('#companyTable').DataTable({
    processing: true,
    serverSide: true,
    'language': {
      'loadingRecords': '&nbsp;',
      'processing': '<i class="fa fa-spinner" style="color: #7367f0;"></i>'
    },
    ajax: "{{route('companies')}}",
    columns: [{data: 'DT_RowIndex', name: 'DT_Row_Index' , orderable: false, searchable: false},
      {
        data: 'name',
        sWidth: '15%'
      },
      {
        data: 'description'
      },
      {
        data: 'phone'
      },
      {
        data: 'address'
      },
      {
        data: 'type'
      },
      {
        data: 'actions'
      },
    ],
  });

  $(document).ready(function() {
    setTimeout(function() {
      $('#successMessage').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
  });
</script>

@endsection
@section('vendor-script')
<!-- vendor files -->
<script src="vendors/js/extensions/sweetalert2.all.min.js"></script>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/datatables/datatable.js')) }}"></script>
@endsection

<!--
// $(document).on('click', '.button-approve-action', function (e) {
  //           e.preventDefault();
  //           let id = $(this).data('id');
  //           //document.getElementById("user_id").value = id;
  //           console.log(id);
  //           Swal.fire({
  //             title: 'Are you sure?',
  //             text: "You won't be able to revert this!",
  //             type: 'warning',
  //             showCancelButton: true,
  //             confirmButtonColor: '#3085d6',
  //             cancelButtonColor: '#d33',
  //             confirmButtonText: 'Yes, Approve it!',
  //             confirmButtonClass: 'btn btn-primary',
  //             cancelButtonClass: 'btn btn-danger ml-1',
  //             buttonsStyling: false,
  //           }).then(function (result) {
  //               if (result.value) {
  //                 $.ajax({
  //                   url: '/user-approve',
  //                   method: "get",
  //                   data: {
  //                     id:id, 
  //                   },
  //                   success: function(response) {
  //                                 Swal.fire({
  //                                   type: "success",
  //                                   title: 'Approved!',
  //                                   text: 'Tenant Approved.',
  //                                   confirmButtonClass: 'btn btn-success',
  //                                 }).then(function (result) {
  //                                 if (result.value) {
  //                                   console.log(response);
  //                                 //window.location.reload();
  //                                 $('#usersTable').DataTable().ajax.reload();
  //                                 }
  //                                 });
  //                               }
  //                         });
  //                     }
  //                   });
  //               });

  // $(document).on('click', '.button-decline-action', function (e) {
  //           e.preventDefault();
  //           let id = $(this).data('id');
  //           //document.getElementById("user_id").value = id;
  //           console.log(id);
  //           Swal.fire({
  //             title: 'Are you sure?',
  //             text: "You won't be able to revert this!",
  //             type: 'warning',
  //             showCancelButton: true,
  //             confirmButtonColor: '#3085d6',
  //             cancelButtonColor: '#d33',
  //             confirmButtonText: 'Yes, Decline it!',
  //             confirmButtonClass: 'btn btn-primary',
  //             cancelButtonClass: 'btn btn-danger ml-1',
  //             buttonsStyling: false,
  //           }).then(function (result) {
  //               if (result.value) {
  //                 //console.log('inside true');
  //                 $.ajax({
  //                   url: '/user-decline',
  //                   method: "get",
  //                   data: {
  //                     id:id, 
  //                   },
  //                   success: function(response) {
  //                                 Swal.fire({
  //                                   type: "success",
  //                                   title: 'Declined!',
  //                                   text: 'Tenant Declined.',
  //                                   confirmButtonClass: 'btn btn-success',
  //                                 }).then(function (result) {
  //                                 if (result.value) {
  //                                   console.log(response);
  //                                 //window.location.reload();
  //                                 $('#usersTable').DataTable().ajax.reload();
  //                                 }
  //                                 });
  //                               }
  //                         });
  //                     }
  //                   });
  //               });
  -->