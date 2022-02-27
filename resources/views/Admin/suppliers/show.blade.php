@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('suppliers.show_supplier'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('suppliers.show_supplier')</h2>
            </div>
            <div class="body">
                <div class="row col-md-12 m-0 p-0">
                    <div class="card">
                        <div class="header text-primary">@lang('suppliers.company_information')</div>
                        <div class="body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>@lang('suppliers.supplier_company_name')</label>
                                        <input type="text" class="form-control" placeholder="@lang('suppliers.company_name_holder')"
                                            name="company_name" value="{{$supplier->company_name}}" disabled><br>
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
                                                value="{{$supplier->company_tel_no}}" disabled>
                                        </div>
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
                                                value="{{$supplier->email}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('general.address')</label>
                                        <textarea class="form-control" name="address" rows="5" cols="30"
                                            disabled>{{$supplier->address}}</textarea>
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
                                            value="{{$supplier->contact_person_name}}" disabled><br>
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
                                                value="{{$supplier->contact_person_mobile}}" disabled>
                                        </div>
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
                                                value="{{$supplier->contact_person_email}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-md-12 m-0 p-0">
                    <div class="card">
                        <div class="header text-primary">@lang('suppliers.transactions')</div>
                        <div class="body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>@lang('suppliers.total_purchase_orders')</label>
                                        <input type="text" class="form-control"
                                            value="{{$tpo}}" disabled><br>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>@lang('suppliers.total_returns')</label>
                                        <input type="text" class="form-control"
                                            value="{{$tr}}" disabled><br>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>@lang('suppliers.total_transactions_orders')</label>
                                        <input type="text" class="form-control"
                                            value="{{$tt}}" disabled><br>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>@lang('suppliers.total_debt')</label>
                                        <input type="text" class="form-control"
                                            value="{{number_format((float)$td, 2, '.', '')}}" disabled><br>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>@lang('suppliers.total_credit')</label>
                                        <input type="text" class="form-control"
                                            value="{{number_format((float)$tc, 2, '.', '')}}" disabled><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
