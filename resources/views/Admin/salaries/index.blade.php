@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('employees.salaries'))


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn rounded w-100 btn-success buttons-html5" href="{{url('salaries/create')}}">
            <span>@lang('employees.add_new_salary')</span>
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
                                <th>@lang('employees.employee')</th>
                                <th>@lang('general.month')</th>
                                <th>@lang('employees.salary_date')</th>
                                <th>@lang('employees.bonus')</th>
                                <th>@lang('employees.deduction')</th>
                                <th>@lang('employees.loan_deduction')</th>
                                <th>@lang('employees.total_salary')</th>
                                <th>@lang('general.options')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaries as $salary)
                            <tr>
                                <td>{{$salary->employee->name}}</td>
                                <td>{{$salary->month}}</td>
                                <td>{{$salary->salary_date}}</td>
                                <td>{{isset($salary->bonus)?$salary->bonus:0}}</td>
                                <td>{{isset($salary->deduction)?$salary->deduction:0}}</td>
                                <td>{{isset($salary->loan_deduction)?$salary->loan_deduction:0}}</td>
                                <td>{{$salary->total}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                          @lang('general.options')
                                        </button>
                                        <div class="dropdown-menu row">
                                            <div class="col-12 ml-2">
                                                <a href="{{url("/salaries/{$salary->id}/edit")}}"
                                                    ><i class="fa fa-edit"></i>@lang('general.edit')</a>
                                            </div>
                                            <div class="col-12">
                                                <form action="{{url("/salaries/{$salary->id}")}}" method="post" class="delete">
                                                    <button style="background-color: white;border:thick;" class="text-danger">
                                                        <i class="fa fa-trash-o"></i>@lang('general.delete')
                                                    </button>
                                                        @method('DELETE')
                                                         @csrf
                                                </form>
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

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
