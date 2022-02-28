@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('notifications.over_due_date'))


@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header"></div>
                <div class="body">
                    <div class="table overflow-auto">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>@lang('notifications.order_id')</th>
                                <th>@lang('notifications.type')</th>
                                <th>@lang('notifications.due_date')</th>
                            </tr>
                            </thead>
                            <tbody>
{{--                            @foreach ($rents as $rent)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$rent->id}}</td>--}}
{{--                                    <td>Service Rent</td>--}}
{{--                                    <td>{{$rent->deliver_date}}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{$sale->id}}</td>
                                    <td>@lang('notifications.sales_order')</td>
                                    <td>{{$sale->expected_on}}</td>
                                </tr>
                            @endforeach
                            @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>@lang('notifications.purchases_order')</td>
                                    <td>{{$purchase->expected_on}}</td>
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
