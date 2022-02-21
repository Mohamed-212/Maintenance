@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Safe Transaction')


@section('content')

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <div class="text-center p-3 mb-2" style="border-radius: 5px; border: 1px solid #e25985">
                            <b class="mr-5">Current Balance : {{$currentSafe}}</b>
                            <b class="mr-5 ml-5">Cash : {{$cashSafe}}</b>
                            <b class="mr-5 ml-5">Visa : {{$visaSafe}}</b>
                        </div>
                        <div class="text-center">
                            <form action="{{route('admin.report.safe')}}" method="GET">
                                @csrf
                                <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                       name="from" data-date-format="yyyy-mm-dd" value="{{old('from')}}" placeholder="From" autocomplete="off">
                                <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                       name="to" data-date-format="yyyy-mm-dd" value="{{old('to')}}" placeholder="To" autocomplete="off">
                                <select name="status" class="w-25 mb-2" id="status" style="padding: 0.35rem!important;">
                                    <option value="">Status</option>
                                    <option value="in">In</option>
                                    <option value="out">Out</option>
                                </select>
                                <button class="btn btn-primary btn-xs mb-1">Search</button>
                            </form>
                        </div>
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Transaction Type</th>
                                <th>Status</th>
                                <th>Payment Type</th>
                                <th>Date/Time</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($safes as $safe)
                                <tr
                                    data-status="{{$safe->type=='sales_order'||$safe->type=='sales_payment'||$safe->type=='rent'||$safe->type=='maintenance'||$safe->type=='insurance'?'in':'out'}}">
                                    <td>{{$safe->id}}</td>
                                    <td>{{$safe->amount}}</td>
                                    <td>{{$safe->type}}</td>
                                    <td>{{$safe->status}}</td>
                                    <td>{{$safe->payment_type}}</td>
                                    <td>{{$safe->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-left">
                            <b class="mr-5">Total Amount : {{$totalAmount}}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
    <link rel=" stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
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
@stop

@section('page-script')
    <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/table-filter.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@stop
