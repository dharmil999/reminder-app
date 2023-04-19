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
