@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Expenses')


@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">

            </div>
            <div class="body">
                <div class="table-responsive">
                    <div class="text-center">
                        <form action="{{route('admin.expense')}}" method="GET">
                            @csrf
                            <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                   name="from" data-date-format="yyyy-mm-dd" value="{{old('from')}}" placeholder="From" autocomplete="off">
                            <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                   name="to" data-date-format="yyyy-mm-dd" value="{{old('to')}}" placeholder="To" autocomplete="off">
                            <button class="btn btn-primary btn-xs mb-1">Search</button>
                        </form>
                    </div>
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction Id</th>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Payment Type</th>
                                <th>Date/Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($expenses as $item)

                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->trans_id}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->expense_type->name}}</td>
                                <td>{{$item->total_amount}}</td>
                                <td>{{$item->payment_type}}</td>
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
@stop
