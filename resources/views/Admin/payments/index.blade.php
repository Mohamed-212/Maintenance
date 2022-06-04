@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('payments.purchase_payments'))


@section('content')
    <div class="row justify-content-end">
        <div class="col-3">
            <a class="btn rounded w-100 btn-success buttons-html5" href="{{url('payments/create')}}">
                <span>@lang('payments.add_new_payment')</span>
            </a>
        </div>

    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header"></div>
                <div class="body">
                    <div class="table overflow-auto">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>@lang('general.sn')</th>
                                <th>@lang('payments.purchase_order')</th>
                                <th>@lang('payments.supplier')</th>
                                <th>@lang('payments.type')</th>
                                <th>@lang('general.total')</th>
                                <th>@lang('payments.paid')</th>
                                <th>@lang('payments.remaining')</th>
                                <th>@lang('payments.payment_reason')</th>
                                <th>@lang('general.date/time')</th>
                                <th>@lang('general.options')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payments as $index => $payment)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>
                                        <a href="{{url("/purchaseOrders/{$payment->purchaseOrder->id}")}}">{{$payment->purchaseOrder->id}}</a>
                                    </td>
                                    <td>
                                        <a href="{{url("/suppliers/{$payment->purchaseOrder->supplier->id}/edit")}}">{{$payment->purchaseOrder->supplier->company_name}}</a>
                                    </td>
                                    <td>{{$payment->payment_type}}</td>
                                <!--<td>{{$payment->purchaseOrder->total_amount}}</td>-->
                                    <td>{{number_format((float)$payment->paid + $payment->remaining, 2, '.', '')}}</td>
                                    <td>{{$payment->paid}}</td>
                                    <td>{{$payment->remaining}}</td>
                                    <td>{{($payment->comments == "returned items")? 'refund payment' : ''}}</td>
                                    <td>{{$payment->created_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                @lang('general.options')
                                            </button>
                                            <div class="dropdown-menu row">
                                                <div class="col-12 ml-2">
                                                    <a href="{{url("/payments/{$payment->id}")}}"><i
                                                            class="fa fa-eye"></i>@lang('general.show')</a>
                                                </div>
                                                {{-- <div class="col-12 ml-2">
                                                    <a href="{{url("/payments/{$payment->id}/edit")}}"><i
                                                    class="fa fa-edit"></i>Edit</a>
                                            </div> --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}"/>
    <style>
        td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('../assets/images/details_close.png') no-repeat center center;
        }
    </style>
@stop

@section('page-script')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
