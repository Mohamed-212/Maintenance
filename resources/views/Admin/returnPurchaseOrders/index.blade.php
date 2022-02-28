@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('returns.return_purchase_orders'))


@section('content')
    <div class="row justify-content-end">
        <div class="col-3">
            <a class="btn rounded w-100 btn-success buttons-html5" href="{{url('purchaseOrders/returns/create')}}">
                <span>@lang('returns.add_return_purchase_order')</span>
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
                                <th>@lang('returns.purchase_order_id')</th>
                                <th>@lang('returns.supplier')</th>
                                <th>@lang('returns.employee')</th>
                                <th>@lang('returns.inventory_name')</th>
                                <th>@lang('general.date/time')</th>
                                <th>@lang('general.options')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchaseOrders as $index => $purchaseOrder)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>
                                        <a href="{{url("/purchaseOrders/{$purchaseOrder->id}")}}">{{$purchaseOrder->id}}</a>
                                    </td>
                                    <td>
                                        <a href="{{url("/suppliers/{$purchaseOrder->supplier->id}/edit")}}">{{$purchaseOrder->supplier->company_name}}</a>
                                    </td>
                                    <td>{{$purchaseOrder->user->name}}</td>
                                    <td>{{$purchaseOrder->inventory->name}}</td>
                                    <td>{{$purchaseOrder->created_at}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                                @lang('general.options')
                                            </button>
                                            <div class="dropdown-menu row">
                                                <div class="col-12 ml-2">
                                                    <a href="{{url("/purchaseOrders/returns/show/{$purchaseOrder->id}")}}"><i
                                                            class="fa fa-eye"></i>@lang('general.show')</a>
                                                </div>
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
