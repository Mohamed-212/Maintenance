@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'rents')


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn btn-round btn-primary buttons-html5"href="{{url('rents/create')}}">
            <span>Add New rents</span>
        </a>
    </div>

</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">

            </div>
            <div class="body">
                <div class="table-responsive">

                    <div class="text-center">
                        <b>Find reservesion in specific interval</b>
                        <form action="{{route('admin.rents.index')}}" method="POST">
                            @csrf
                            <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                   name="from" data-date-format="yyyy-mm-dd" value="{{old('from')}}" placeholder="From" required autocomplete="off">
                            <input data-provide="datepicker" data-date-autoclose="true" class="w-25 p-1 mb-2"
                                   name="to" data-date-format="yyyy-mm-dd" value="{{old('to')}}" placeholder="To" required autocomplete="off">
                            <button class="btn btn-primary btn-xs mb-1">Search</button>
                        </form>
                    </div>

                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Mobile</th>
                                <th>Book from</th>
                                <th>Book To</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rents as $rent)


                            <tr>
                            <td>{{$rent->item->serial_number}}</td>
                            <td>{{$rent->customer->mobile}}</td>
                            <td>{{\Carbon\Carbon::parse($rent->book_date)->format('Y/m/d')}}</td>
                            <td>{{\Carbon\Carbon::parse($rent->deliver_date)->format('Y/m/d')}}</td>
                            <td>{{$rent->status}}</td>
                            <td>
                                <div class="col-12 pl-0">
                                    <a href="{{url("/rents/{$rent->id}/edit")}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
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
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
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
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
