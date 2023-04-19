@extends('layouts.master')
@section('title', 'Create Reminder')
@section('css')
@endsection
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
                            <h2 class="content-header-title float-left mb-0">Create Reminder</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('reminder.index') }}">Reminders</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Reminder
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="app-user-edit">
                    @include('errors.error')
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <form action="{{ route('reminder.store') }}" method="POST" id="createform" name="createform">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="title" class="form-label">Title</label>
                                                                <input type="text" name="title" class="form-control" placeholder="Enter Title" id="title"
                                                                    value="{{ old('title', isset($reminder->title) ? $reminder->title : '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="description" class="form-label">Description</label>
                                                                <input type="textarea" name="description" class="form-control" placeholder="Enter Description"
                                                                    id="description"
                                                                    value="{{ old('description', isset($reminder->description) ? $reminder->description : '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="scheduled_at" class="form-label">Date And Time</label>
                                                                <div class='input-group date'>
                                                                    <input type='text' name="scheduled_at" class="form-control" id='datetimepicker1' />
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                                @if(isset($reminder->id))
                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 submitbutton" name="submit" value="Submit">
                                                    <span class="indicator-label d-flex align-items-center justify-content-center">Update
                                                        <span class="indicator-progress d-none" id="update-indicator-progress"> &nbsp;&nbsp;&nbsp;
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </span>
                                                </button>&nbsp;
                                                @else
                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 submitbutton" name="submit" value="Submit">
                                                    <span class="indicator-label d-flex align-items-center justify-content-center">Create
                                                        <span class="indicator-progress d-none"> &nbsp;&nbsp;&nbsp;
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </span>
                                                </button>&nbsp;
                                                @endif
                                                <a href="{{ route('reminder.index') }}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" id="timezone" name="timezone">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#timezone').val(tz);
            let currentTime = moment().format('HH:mm')

            flatpickr("#datetimepicker1", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                minTime: currentTime,
                defaultDate: "today",
                minuteIncrement:1
            });
            // $('#datetimepicker1').datetimepicker();
            $("#createform").validate({
                rules: {
                    
                },
                submitHandler: function(form) {
                    if ($("#createform").validate().checkForm()) {
                        $(".submitbutton").attr("type", "submit");
                        $(".cancelbutton").addClass("disabled");
                        $('.submitbutton').attr('disabled', true);
                        $('.indicator-progress').removeClass("d-none");
                        form.submit();
                    }
                }
            });

        });
    </script>
@endsection
