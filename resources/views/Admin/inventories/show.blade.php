@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Inventory Details')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Inventory Details</h2>
            </div>
            <div class="body">
                <form method="POST"
                    id="advanced-form" data-parsley-validate novalidate class="edit">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="emp_id">Employee Name</label>
                                <select name="emp_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" disabled>
                                    <option value="">Choose</option>

                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}"
                                        {{$inventory->emp_id==$employee->id ?'selected':''}}>{{$employee->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('emp_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tel_no">Telephone Number</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="number" class="form-control key" placeholder="Ex:0212345678"
                                        name="tel_no" value="{{$inventory->tel_no}}" pattern="^[0-9]\d{1,10}$" disabled>
                                </div>
                                @error('tel_no')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tel_no">Inventory Name</label>
                                <div class="input-group mb-3">

                                    <input type="text" class="form-control key" placeholder="Ex: Test"
                                        name="name" value="{{$inventory->name}}" disabled>
                                </div>
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" rows="5" cols="30"
                                disabled>{{$inventory->address}}</textarea>
                                @error('address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2 mb-2">
                      <h4 class="text-info">Inventory Details</h4>
                    </div>
                    <div class="row">
                        <div class="table-responsive p-3">
                            <table class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Item Unit</th>
                                    <th>Item Quantity</th>
                                    <th>Average Cost</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($item_inventories as $item_inventory)
                                    @php
                                        $item=\App\Models\Item::find($item_inventory->item_id);
                                    @endphp
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->unit}}</td>
                                        <td>{{$item_inventory->quantity}}</td>
                                        <td>{{$item_inventory->av_cost}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
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
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
