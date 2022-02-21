@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Sales Order')

@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Create New order</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.salesOrders.store')}}" id="advanced-form"
                    data-parsley-validate novalidate class="confirm">
                    @csrf
                    @if(session()->has('error'))
                        <div class="row alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select name="customer_id" class="form-control" style="width: 100%;" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true" id="category">
                                    <option value="">Choose Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="payment_type">Patyment Type</label>
                                <select name="payment_type" class="form-control" style="width: 100%;"
                                    data-select2-id="1" tabindex="-1" aria-hidden="true" id="payment_type"
                                    value="{{old('payment_type')}}">
                                    <option value="">Choose Payment Type</option>
                                    <option value="cash">Cash</option>
                                    <option value="visa">Visa</option>
                                </select>
                                @error('payment_type')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <h2>Add Quick Information If Customer Doesn't Exist</h2>
                                </div>
                                <div class="body">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="type_id">Customer Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Customer Name" name="name"
                                                    value="{{old('name')}}"><br>
                                                @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="type_id">Mobile</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control key" placeholder="Ex: 01234567890"
                                                        name="mobile" value="{{old('mobile')}}">
                                                </div>
                                                @error('mobile')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>

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
                                                    <th>ACTIONS</th>
                                                    <th>Item</th>
                                                    <th>Serial</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="append_items">
                                                <tr index=1>
                                                    <td><a style="float: right;pointer-events: none;"
                                                            class="btn btn-danger block"><i class="icon-ban"></i></a>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" name="item_id[]" id="item0"
                                                                class="item" onClick="handleChangeItem(0)">
                                                                <option value="">Choose Items</option>
                                                                @foreach($items as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('item_id')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" name="serial_number" id="serial_number0"
                                                                class="form-control" onChange="handelChangeSerial(0)">
                                                        </div>
                                                    </td>
                                                    <td width="10">
                                                        <div class="form-group">
                                                            <input type="number" min="0"  name="quantity[]" id="quantity0"
                                                                class="form-control" value=1
                                                                onChange="handleChangeQuantity(0)">
                                                            @error('quantity[]')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td width="100">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"name="price"
                                                                value="" id="price0" readonly>
                                                            @error('price')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6 id="subtotal0">0.00</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-2">
                                            <a class="btn btn-primary block" id="add_new_item" class="add_new_item"
                                                style="margin-left:35%;"><i class="icon-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Subtotal:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="subAllTotal">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Tax:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="allTax">0.00 EG</p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:30%;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h6>Total:</h6>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <p id="total">0.00 EG</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Paid</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                                </div>
                                                <input type="number" min="0" class="form-control key" name="paid"
                                                    onChange="handleChangeRemaining()" value=""
                                                    id="paid">
                                            </div>
                                            @error('paid')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Remaining</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                                </div>
                                                <input type="number" class="form-control key" name="remaining"
                                                    id="remaining" value="{{old('remaining')}}" disabled>
                                            </div>
                                            @error('remaining')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-8 mx-auto">
                                        <div class="form-group">
                                            <label>Due Date:</label>
                                            <div class="input-group mb-3">
                                                <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                                       name="expected_on" data-date-format="yyyy-mm-dd" required
                                                       value="{{old('start_date')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-primary mx-auto">Create</button>
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

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

<script>
    $(function() {

// validation needs name of the element
$('#food').multiselect();

// initialize after multiselect
$('#basic-form').parsley();
$(".mul-select").select2({
placeholder: "select Items", //placeholder
tags: true,
tokenSeparators: ['/',',',';'," "]
});

});

//
var i =1;

$('#add_new_item').on('click', function (event) {

$(this).data('clicked', true);

var append = '<tr index="'+i+'" id="'+i+'">';
append += '<td><a style="float: right;"class="btn btn-danger block add_item" onClick="Delete('+i+')"><i class="icon-trash"></i></a></td>';
append += '<td> <div class="form-group"><div class="form-group"><select class="form-control" name="item_id[]" onChange="handleChangeItem('+i+')" id="item'+i+'"><option value="">Choose Items</option>'
@foreach($items as $item)
append+='<option value="{{$item->id}}">{{$item->name}}</option>'
@endforeach
append+='</select></div></div></td><td><div class="form-group"><input type="text" name="serial_number" id="serial_number'+i+'"class="form-control" onChange="handelChangeSerial('+i+')"></div></td>';
append += '<td><div class="form-group"><input type="number" min="0" name="quantity[]" id="quantity'+i+'" onChange="handleChangeQuantity('+i+')" class="form-control"value=1></div></td><td><div class="form-group mt-3"><input type="text" class="form-control money-dollar" id="price'+i+'" onChange="handelChangetotal('+i+')" readonly><br></div></td>';
append += '<td><h6 id="subtotal'+i+'" onChange="handelChangetotal('+i+')">0.00</h6></td>';
append += '</tr>';

$("#append_items").last().append(append);
i++;
console.log(i);

});
//
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
var invoice={};
var index=0;
var handleChangeItem = function (i) {
var item= $('#item'+i+'').val();
var quantity= $('#quantity'+i+'').val();

invoice[i] = [item,quantity];

if (item) {
console.log(invoice);
var invoiceData = JSON.stringify(invoice);
console.log(JSON.stringify(invoice));
$.get("{{url('/getItem/')}}"+ '/' + item + '/' + quantity +'/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#price'+i+'').val(data.item.price);
$('#serial_number'+i+'').val(data.item.serial_number);
$('#subtotal'+i+'').text(data.subtotal);
$('#subAllTotal').text(data.subAllTotal);
$('#allTax').text(data.allTax);
$('#total').text(data.total);
}
console.log(data);
}, "json");
}
}
///
var handleChangeQuantity = function (i) {
var quantity= $('#quantity'+i+'').val();
var item= $('#item'+i+'').val();

invoice[i] = [item,quantity];

if (quantity) {
var invoiceData = JSON.stringify(invoice);
console.log(JSON.stringify(invoice));
$.get("{{url('/getItem/')}}"+ '/' + item + '/' + quantity +'/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#subtotal'+i+'').text(data.subtotal);
$('#subAllTotal').text(data.subAllTotal);
$('#allTax').text(data.allTax);
$('#total').text(data.total);
}
console.log(data);
}, "json");

}
}
//
var handleChangeRemaining =function(){
var paid=$('#paid').val();
var AllTotal=$('#total').text();
if (paid) {
$.get("{{url('/remaining/')}}"+'/'+paid + '/' + AllTotal, function (data) {
if (data.length != 0) {
console.log(data);
$('#remaining').val(data.remaining);

}
console.log(data);
}, "json");

}

}
///
var handelChangeSerial=function(i){
    var serial = $('#serial_number'+i+'').val();
    console.log(serial);
var quantity= $('#quantity'+i+'').val();

invoice[i] = [serial,quantity];

if (serial) {
console.log(invoice);
var invoiceData = JSON.stringify(invoice);
console.log(JSON.stringify(invoice));
$.get("{{url('/getItemBySerial/')}}"+ '/' + serial + '/' + quantity +'/'+invoiceData, function (data) {
if (data.length != 0) {
console.log(data);
$('#price'+i+'').val(data.item.price);
$('#subtotal'+i+'').text(data.subtotal);
$('#subAllTotal').text(data.subAllTotal);
$('#allTax').text(data.allTax);
$('#total').text(data.total);
$('#item'+i+'').val(data.item.id);

}
console.log(data);
}, "json");
}
}

//DElete Function
function Delete(i){
$('#'+i+'').remove();
}

</script>
<script>
    var config ={
_url:"{{url('/getItem/')}}"
}
</script>
<script src="{{ asset('assets/js/pages/item.js') }}"></script>
@stop
