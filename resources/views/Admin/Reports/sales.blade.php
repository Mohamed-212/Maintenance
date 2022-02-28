@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('reports.sales_order'))


@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header"></div>
                <div class="body">
                    <div class="table overflow-auto">
                        <div class="text-center">
                            <form action="{{route('admin.sale')}}" method="GET">
                                @csrf
                                <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                       name="from" data-date-format="yyyy-mm-dd" value="{{old('from')}}" placeholder="@lang('reports.from')" autocomplete="off">
                                <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                       name="to" data-date-format="yyyy-mm-dd" value="{{old('to')}}" placeholder="@lang('reports.to')" autocomplete="off">
                                <select name="cat" class="w-25 mb-2"
                                        style="padding: 0.35rem!important;" id="cat">
                                    <option value="">@lang('reports.filter_by_category')</option>
                                    @foreach($subCats as $subCat)
                                        <option value="{{$subCat->id}}">{{$subCat->name}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary btn-xs mb-1">@lang('reports.search')</button>
                            </form>
                        </div>
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>@lang('reports.order_id')</th>
                                <th>@lang('reports.customer')</th>
                                <th>@lang('reports.employee')</th>
                                <th>@lang('reports.subtotal')</th>
                                <th>@lang('reports.remaining')</th>
                                <th>@lang('reports.total_taxes')</th>
                                <th>@lang('general.total')</th>
                                <th>@lang('general.date/time')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($salesorders as $item)
                                <tr>
                                    <td><a href="{{url("/invoices/{$item->id}")}}">{{$item->id}}</a></td>
                                    <td><a href="{{url("/customers/{optional($item->customer)->id}")}}">{{optional($item->customer)->name}}</a></td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->sub_total_amount}}</td>
                                    <td>{{$item->remaining}}</td>
                                    <td>{{$item->total_taxes}}</td>
                                    <td>{{$item->total_amount}}</td>
                                    <td>{{$item->created_at}}</td>
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
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}" />
    <style>
        td.details-control {
            background: url('../assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('../assets/images/details_close.png') no-repeat center center;
        }
    </style>
    <style>


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
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function(){
            $('.js-exportabl').DataTable({
                buttons:[
                    'excel',
                ],
            });
        })
        // var table = $('#test').DataTable({
        //     rowReorder: {
        //         selector: 'td:nth-child(2)'
        //     },
        //     destroy: true,
        //     responsive: true
        // });

        //
    </script>
@stop
