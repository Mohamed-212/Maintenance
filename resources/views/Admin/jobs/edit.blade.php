@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('employees.edit_job'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('employees.edit_job')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.jobs.update',['job'=>$job->id])}}" id="advanced-form"
                    data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="text-input1">@lang('employees.position')</label>
                        <input type="text" id="text-input1" class="form-control" name="position"
                            value="{{$job->position}}">
                        @error('position')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
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
