@extends('layouts.master')
@section('title', 'Reminders')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Reminders</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Reminders
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <a href="{{ route('reminder.create') }} "> <button type="button" class="btn btn-primary"><i
                                        data-feather="plus"></i> Add Reminders</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            @include('errors.error')
                            <div class="card">
                                <div class="card-datatable">
                                    <table class="datatables-ajax table" id="reminder_table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Schedule At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @include('confirmalert')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#reminder_table');
            table.DataTable({
                lengthMenu: getPageLengthDatatable(),
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: "{{ route('getReminders') }}",
                    type: 'post',
                    data: function(data) {
                        data.fromValues = $("#filterData").serialize();
                    }
                },
                columns: [{
                        data: 'title',
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'scheduled_at',
                    },
                    {
                        data: 'action',
                    },
                    // {data: 'created_at', name: 'created_at'},
                    // { data: 'status', name: 'status' },
                    // {
                    //         data: 'action',
                    //         name: 'action',
                    //         searchable: false,
                    //         sortable: false,
                    //         responsivePriority: - 1
                    // }

                ],
            });
            $("#delete-record").on("click", function() {
                var id = $("#id").val();
                $('#delete-modal').modal('hide');
                    $.ajax({
                    url: 'reminder/' + id,
                    type: "DELETE",
                    dataType: 'json',
                    success: function(data) {                    
                        toastr.success('@lang('message.recordDelete')', '@lang('message.success')');
                        table.DataTable().draw();
                    },                    
                    error: function(data) {
                        toastr.error("@lang('message.oopserror')", "@lang('message.error')");
                    }
                });        
            });
        });
    </script>
@endsection
