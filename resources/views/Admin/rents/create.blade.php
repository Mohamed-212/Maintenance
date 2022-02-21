@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Create Rent')


@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Create New Rent</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{route('admin.rents.store')}}" id="advanced-form"
                          data-parsley-validate novalidate class="confirm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" class="form-control select2"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required id="customer_id">
                                        <option value="">Choose Customer</option>

                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}} ({{$customer->mobile}})</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="item_id">Item</label>
                                    <select name="item_id" class="form-control select2"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required id="item_id">
                                        <option value="">Choose Item</option>

                                        @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}} ({{$item->serial_number}})</option>
                                        @endforeach
                                    </select>
                                    @error('item_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-center d-block w-100">
                                <div class="col-12">
                                    <span id="errorNotValid" class="text-danger" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Book Date</label>
                                    <div class="input-group mb-3">
                                        <input id="book_date" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" class="form-control check-date"
                                               name="book_date" data-date-format="yyyy-mm-dd" required
                                               value="{{old('book_date')}}">
                                    </div>
                                    @error('book_date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Pick Date</label>
                                    <div class="input-group mb-3">
                                        <input id="pick_date" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" class="form-control check-date"
                                               name="pick_date" data-date-format="yyyy-mm-dd" required
                                               value="{{old('pick_date')}}">
                                    </div>
                                    @error('pick_date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Deliver Date</label>
                                    <div class="input-group mb-3">
                                        <input id="deliver_date" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" class="form-control check-date"
                                               name="deliver_date" data-date-format="yyyy-mm-dd" required
                                               value="{{old('deliver_date')}}">
                                    </div>
                                    @error('deliver_date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <b>Rent Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input id="total_amount" type="number" class="form-control amount" name="total_amount" value="{{old('total_amount')}}">
                                    </div>
                                    @error('total_amount')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <b>Book Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input id="book_amount" type="number" class="form-control amount" name="book_amount" value="{{old('book_amount')}}">
                                    </div>
                                    @error('book_amount')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <b>Due Amount</b>
                                    <b id="pick_amount" class="d-block m-2"></b>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status" class="mb-0">Rent Status</label>
                                    <input type="text" id="status" disabled value="reserved" class="form-control">
                                    <input type="hidden" value="reserved" name="status">
                                    @error('status')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="btn-submit" class="btn btn-primary ">Create</button>
                    </form>
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
@stop

@section('page-script')
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/forms/dropify.js') }}"></script>
    <script>
        $(function(){
            $('.check-date').change(function() {

                var book_date = $('#book_date').val();
                var pick_date = $('#pick_date').val();
                var deliver_date = $('#deliver_date').val();
                var item_id = $('#item_id').val();
                if(book_date != null && book_date != '' && deliver_date != null && deliver_date != '' && item_id != null && item_id != ''){
                    if (new Date(book_date) <= new Date(pick_date) && new Date(pick_date) <= new Date(deliver_date)){
                        var url = '{{url('/')}}' + '/rents/check-date/' + book_date + '/' + deliver_date + '/' + item_id;
                        $.get(url, function (data) {
                            if (data.msg == 'available') {
                                $('#errorNotValid').hide();
                            }else {
                                $('#errorNotValid').html('Item not available in this time.');
                                $('#errorNotValid').show();
                            }
                        }, "json");
                    }
                    else{
                        $('#errorNotValid').html('Deliver date must be greater than Pick date and Pick date must be greater than Book date');
                        $('#errorNotValid').show();
                    }
                }
            });
            $('.amount').keyup(function() {
                parseFloat
                var total_amount = $('#total_amount').val();
                var book_amount = $('#book_amount').val();
                if($.isNumeric(total_amount) && $.isNumeric(total_amount) && parseFloat(total_amount) >= parseFloat(book_amount)){
                    $('#pick_amount').text(parseFloat(total_amount) - parseFloat(book_amount));
                }
                else {
                    $('#pick_amount').text('--------');
                    $('#pick_amount').addClass('text-danger');
                }
            });

        });
    </script>
@stop
