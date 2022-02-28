@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('customers.customers'))


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn rounded w-100 btn-success buttons-html5" href="{{url('customers/create')}}">
            <span>@lang('customers.add_new_customer')</span>
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
                                <th>@lang('general.name')</th>
                                <th>@lang('general.email')</th>
                                <th>@lang('general.mobile')</th>
                                <th>@lang('general.address')</th>
                                <th>@lang('customers.area')</th>
                                <th>@lang('customers.city')</th>
                                <th>@lang('general.options')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                 <td>{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{optional($customer->area)->name_en}}</td>
                                <td>{{optional($customer->city)->name_en}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                            @lang('general.options')
                                        </button>
                                        <div class="dropdown-menu row">
                                            <div class="col-12 ml-2">
                                                <a href="{{url("/customers/{$customer->id}")}}"><i
                                                        class="fa fa-eye"></i>@lang('general.show')</a>
                                            </div>
                                            <div class="col-12 ml-2">
                                                <a href="{{url("/customers/{$customer->id}/edit")}}"><i
                                                        class="fa fa-edit"></i>@lang('general.edit')</a>
                                            </div>
{{--                                            <div class="col-12">--}}
{{--                                                <form action="{{url("/customers/{$customer->id}")}}" method="post" class="delete">--}}
{{--                                                    <button style="background-color: white;border:thick;"--}}
{{--                                                        class="text-danger">--}}
{{--                                                        <i class="fa fa-trash-o"></i>@lang('general.delete')--}}
{{--                                                    </button>--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    @csrf--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
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
@stop
