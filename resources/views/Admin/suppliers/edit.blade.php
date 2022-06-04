@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('suppliers.edit_supplier'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('suppliers.edit_supplier')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.suppliers.update',['supplier'=>$supplier->id])}}"
                    id="advanced-form" data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row col-md-12 m-0 p-0">
                        <div class="card">
                            <div class="header text-primary">@lang('suppliers.company_information')</div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('suppliers.supplier_company_name')</label>
                                            <input type="text" class="form-control" placeholder="@lang('suppliers.company_name_holder')"
                                                name="company_name" value="{{$supplier->company_name}}" required><br>
                                            @error('company_name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('suppliers.company_telephone_number')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <input type="number" class="form-control key"
                                                    placeholder="0212345678" name="company_tel_no"
                                                    value="{{$supplier->company_tel_no}}" required>
                                            </div>
                                            @error('company_tel_no')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('suppliers.company_email')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                                </div>
                                                <input type="text" class="form-control key"
                                                    placeholder="company@test.com" name="email"
                                                    value="{{$supplier->email}}">
                                            </div>
                                            @error('email')
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
                                                required>{{$supplier->address}}</textarea>
                                            @error('address')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12 m-0 p-0">
                        <div class="card">
                            <div class="header text-primary">@lang('suppliers.contact_person_information')</div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('suppliers.contact_person_name')</label>
                                            <input type="text" class="form-control"
                                                placeholder="@lang('suppliers.person_name_holder')" name="contact_person_name"
                                                value="{{$supplier->contact_person_name}}" required><br>
                                            @error('contact_person_name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('suppliers.contact_person_mobile')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <input type="number" class="form-control key"
                                                    placeholder="0212345678" name="contact_person_mobile"
                                                    value="{{$supplier->contact_person_mobile}}" required>
                                            </div>
                                            @error('contact_person_mobile')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>@lang('suppliers.contact_person_email')</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                                </div>
                                                <input type="text" class="form-control key"
                                                    placeholder="company@test.com" name="contact_person_email"
                                                    value="{{$supplier->contact_person_email}}">
                                            </div>
                                            @error('contact_person_email')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
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
