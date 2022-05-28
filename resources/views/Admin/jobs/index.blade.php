@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('employees.jobs'))


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn rounded w-100 btn-success buttons-html5" href="{{url('jobs/create')}}">
            <span>@lang('employees.add_new_job')</span>
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
                                <th>@lang('employees.position')</th>
                                <th>@lang('general.edit')</th>
                                <!--<th>@lang('general.delete')</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr>
                            <td>{{$job->position}}</td>
                            <td><a href="{{url("/jobs/{$job->id}/edit")}}"
                                class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a></td>
                            <!--<td>-->
                            <!--    <form action="{{url("/jobs/{$job->id}")}}" method="post" class="delete">-->
                            <!--        <button class="btn btn-danger btn-xs confirm-del"><i-->
                            <!--            class="fa fa-trash-o"></i></button>-->
                            <!--                @method('DELETE')-->
                            <!--                @csrf-->
                            <!--    </form>-->
                            <!--</td>-->
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
