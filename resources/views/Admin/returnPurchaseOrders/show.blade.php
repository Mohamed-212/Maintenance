@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Show Return Purchase Order')


@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create New order</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="order_id">Purchase Order ID</label>
                                <select name="order_id" class="form-control" disabled style="width: 100%;"
                                        id="order_id">
                                    <option>{{$purchaseOrder->id}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Items</h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table" id="table">
                                            <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>Purchased Qty</th>
                                                <th>Returned Qty</th>
                                                <th>Rate</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $comments = '';
                                                $total = 0;
                                                @endphp
                                            @foreach($purchaseOrder->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text"  class="form-control" disabled
                                                               value="{{$item->name}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number"  class="form-control"
                                                               disabled value="{{$item->pivot->quantity + $item->pivot->return}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number"
                                                               disabled
                                                                class="form-control" value="{{$item->pivot->return}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number"
                                                               disabled
                                                                class="form-control" value="{{$item->pivot->cost}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number"
                                                               disabled
                                                                class="form-control" value="{{number_format((float)($item->pivot->cost * $item->pivot->return), 2, '.', '')}}">
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                            
                                            $comments = ($item->pivot->comment) ? $item->pivot->comment : $comments ;  
                                            
                                            $total += ($item->pivot->cost * $item->pivot->return) 
                                            @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <h6>Order Debt:</h6>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" value="{{number_format((float)abs($purchaseOrder->total_return), 2, '.', '')}}" disabled class="form-control">
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <h6>Total:</h6>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="number" disabled value="{{number_format((float)$total, 2, '.', '')}}" class="form-control">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" disabled name="comment[]" rows="5"
                                    cols="30">{{$comments}}</textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <style>
        .mul-select {
            width: 100%;
        }
    </style>
@stop

@section('page-script')
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>

    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>

    <script>
        $(function () {

            // validation needs name of the element
            $('#food').multiselect();

            // initialize after multiselect
            $('#basic-form').parsley();
            $(".mul-select").select2({
                placeholder: "select Items", //placeholder
                tags: true,
                tokenSeparators: ['/', ',', ';', " "]
            });

        });
    </script>
@stop
