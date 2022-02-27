@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('inventories.edit_inventory'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('inventories.edit_inventory')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.inventories.update',['inventory'=>$inventory->id])}}"
                    id="advanced-form" data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('inventories.responsible_employee')</label>
                                <select name="emp_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">@lang('general.choose_option')</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"
                                        {{$inventory->emp_id==$employee->id ?'selected':''}}>{{$employee->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('emp_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('inventories.telephone_number')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="number" class="form-control key" placeholder="0212345678"
                                        name="tel_no" value="{{$inventory->tel_no}}" pattern="^[0-9]\d{1,10}$" required>
                                </div>
                                @error('tel_no')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('general.name')</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control key" placeholder="@lang('inventories.name_holder')"
                                        name="name" value="{{$inventory->name}}" required>
                                </div>
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('general.address')</label>
                                <textarea class="form-control" name="address" rows="5" cols="30"
                                    required>{{$inventory->address}}</textarea>
                                @error('address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto">@lang('general.update')</button>
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
