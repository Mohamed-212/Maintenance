@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('employees.edit_employee'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('employees.edit_employee')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.employees.update',['employee'=>$employee->id])}}"
                    id="advanced-form" data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>@lang('general.name')</label>
                                <input type="text" class="form-control" placeholder="@lang('employees.emp_name_holder')" name="name"
                                    value="{{$employee->name}}"><br>

                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>@lang('employees.job')</label>
                                <select name="job_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">@lang('general.choose_option')</option>
                                    @foreach($jobs as $job)
                                    <option value="{{$job->id}}" {{$employee->job_id==$job->id ?'selected':''}}>
                                        {{$job->position}}</option>
                                    @endforeach
                                </select>
                                @error('job_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>@lang('employees.salary')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="total"
                                           value="{{$employee->salary}}">
                                </div>
                                @error('salary')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>@lang('employees.start_date')</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                        name="start_date" data-date-format="yyyy-mm-dd"
                                        value="{{$employee->start_date}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('general.update')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
