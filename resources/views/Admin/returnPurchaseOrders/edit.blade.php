@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('returns.create_return_purchase_order'))


@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>@lang('returns.create_return_purchase_order')</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{route('admin.returns.store')}}" id="advanced-form" class="confirm">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="order_id">@lang('returns.purchase_order_id')</label>
                                    <select name="order_id" class="form-control" style="width: 100%;" required id="order_id">
                                        <option value="">@lang('general.choose_option')</option>
                                        @foreach($purchaseOrders as $purchaseOrder)
                                            <option value="{{$purchaseOrder}}">{{$purchaseOrder}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>@lang('returns.items')</h2>
                                    </div>
                                    <div class="body">
                                        <div class="table overflow-auto">
                                            <table class="table" id="table">
                                                <thead>
                                                <tr>
                                                    <th>@lang('general.name')</th>
                                                    <th>@lang('returns.purchased_qty')</th>
                                                    <th>@lang('returns.returned_qty')</th>
                                                    <th>@lang('returns.rate')</th>
                                                    <th>@lang('general.total')</th>
                                                </tr>
                                                </thead>
                                                <tbody id="append_items">
                                                    <tr>
                                                        <td valign="top" colspan="5" class="dataTables_empty text-center">@lang('returns.choose_order')</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <h6>@lang('returns.paid'):</h6>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" min="0" name="paid" class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <h6>@lang('general.total'):</h6>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="hidden" name="total" value="0" id="AllTotalh">
                                                <input id="AllTotal" type="number" disabled class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>@lang('general.comments')</label>
                                    <textarea class="form-control" name="comment" rows="5"
                                        cols="30">{{old('comment')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mx-auto">@lang('general.create')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <style>
        .mul-select {
            width: 100%;
        }
    </style>
@stop

@section('page-script')
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>

    <script>
        $(function () {

            // validation needs name of the element
            $('#food').multiselect();

            // initialize after multiselect
            $('#basic-form').parsley();
            $(".mul-select").select2({
                placeholder: "select Items", //placeholder
                tags: true,
                tokenSeparators: ['/', ',', ';', " "]
            });

        });

        $('body').on('keyup input', '.returnQ', function() {
            var q = $(this).val();
            if(q != ''){
                var cost = $(this).parent().parent().next().find('input').val();
                var total = $(this).parent().parent().next().next().find('input').val((cost * q).toFixed(2));
                var all = 0;
                for(let i = 0; i < $('.tot').length; i++){
                    all += parseInt($('.tot')[i].value);
                }
                all = (all).toFixed(2);
                $('#AllTotal').val(all);
                $('#AllTotalh').val(all);
            }
        });

        $('#order_id').on('change', function (event) {
            $('#append_items').html('');
            $('#AllTotal').val(0.00);
            $('#AllTotalh').val(0);
            var order_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{url('purchaseOrders/returns/getItem/')}}" + "/" + order_id,
                data: "",
                success: function(data) {
                    $.each(data.data, function (key, value) {
                        $('#append_items').append('<tr>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<input type="text" name="item[]" class="form-control" disabled value="' + value['name'] + '">' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<input type="number" name="quantity[]" class="form-control" disabled value="' + value['pivot']['quantity'] + '">' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<input type="number" max="' + parseInt(value['pivot']['quantity']) + '" name="return[]" min="0" class="form-control returnQ" value="0">' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<div class="form-group">' +
                            '<input type="number" name="cost[]" class="form-control" disabled value="' + value['pivot']['cost'] + '">' +
                            '</div>' +
                            '</td>' +
                                                        '<td>' +
                            '<div class="form-group">' +
                            '<input type="number" min="0" class="form-control tot" disabled value="0">' +
                            '</div>' +
                            '</td>' +
                            '</tr>');
                    });
                }
            });

        });
    </script>
@stop
