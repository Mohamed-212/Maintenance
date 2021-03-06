@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('payments.show_sales'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('payments.show_sales')</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>@lang('payments.sales_order')</label>
                            <input disabled type="text" name="so_id" class="form-control"
                                value="{{$salesPayment->so_id}}" >
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>@lang('payments.payment_type')</label>
                            <input disabled type="text" name="payment_type" class="form-control"
                                value="{{__('general.'.$salesPayment->payment_type)}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>@lang('payments.paid')</label>
                            <input disabled type="text" name="paid" class="form-control" value="{{$salesPayment->paid}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="file_attachment">@lang('payments.attachment')</label>
                            <div>
                                <img src="{{$salesPayment->file_attachment}}" width="300px">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>@lang('general.comments')</label>
                            <textarea disabled class="form-control" name="comments" rows="5"
                                cols="30">{{($salesPayment->comments)}}</textarea>
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
