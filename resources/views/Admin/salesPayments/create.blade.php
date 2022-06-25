@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('payments.create_sales'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('payments.create_sales')</h2>
            </div>
            <div class="body">
                <form method="POST" enctype="multipart/form-data" action="{{route('admin.salesPayments.store')}}"
                    id="advanced-form" data-parsley-validate novalidate class="confirm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>@lang('payments.sales_order')</label>
                                <select name="so_id" class="form-control select2 select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">@lang('general.choose_option')</option>
                                    @foreach($salesOrders as $salesOrder)
                                    <option value="{{$salesOrder->id}}">{{$salesOrder->id}}</option>
                                    @endforeach
                                </select>
                                @error('so_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group mb-0">
                                <label>@lang('payments.payment_type')</label>
                                <select class="form-control" name="payment_type">
                                    <option value="">@lang('general.choose_option')</option>
                                    <option value="cash">@lang('general.cash')</option>
                                    <option value="check">@lang('general.check')</option>
                                    <option value="wire_transfer">@lang('general.wire_transfer')</option>
                                </select>
                            </div>
                            @error('payment_type')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>@lang('payments.paid')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control" name="paid" placeholder="99.99"
                                           value="{{old('paid')}}">
                                </div>
                                @error('paid')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="file_attachment">@lang('payments.attachment')</label>
                                <input type="file" class="form-control" name="file_attachment"
                                    placeholder="Enter Attachment" value="{{old('file_attachment')}}">
                                @error('file_attachment')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('general.comments')</label>
                                <textarea class="form-control" name="comments" rows="5"
                                    cols="30">{{old('comments')}}</textarea>
                                @error('comments')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('general.create')</button>
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
