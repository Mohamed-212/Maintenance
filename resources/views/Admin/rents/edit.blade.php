@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Rent')


@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Edit New Rent</h2>
                </div>
                <div class="body mb-4">
                    <h6>Reservation Details</h6>
                    <div class="row w-100 p-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Customer</label>
                                <input type="text" disabled value="{{$rent->customer->name . ' (' . $rent->customer->mobile . ')'}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" disabled value="{{$rent->item->name . ' (' . $rent->item->serial_number . ')'}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Book Date</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                           data-date-format="yyyy-mm-dd"
                                           value="{{\Carbon\Carbon::parse($rent->book_date)->format('Y/m/d')}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Pick Date</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                           data-date-format="yyyy-mm-dd"
                                           value="{{\Carbon\Carbon::parse($rent->pick_date)->format('Y/m/d')}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Deliver Date</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                           data-date-format="yyyy-mm-dd"
                                           value="{{\Carbon\Carbon::parse($rent->deliver_date)->format('Y/m/d')}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b>Total Amount</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="number" class="form-control" value="{{$rent->total_amount}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b>Book Amount</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="number" class="form-control" value="{{$rent->book_amount}}" disabled>
                                </div>
                            </div>
                        </div>
                        @if($rent->status == 'return')
                            <div class="col-3">
                                <div class="form-group">
                                    <b>Pick Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$rent->pick_amount}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status" class="mb-0">Rent Status</label>
                                    <input type="text" id="status" disabled value="{{$rent->status}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <b>Insurance Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$rent->insurance_amount}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status" class="mb-0">Insurance Status</label>
                                    <input type="text" id="status" disabled value="{{$rent->insurance_status}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($rent->attachments as $index => $attachment)
                                            <div class="carousel-item text-center @if($index == 0) active @endif">
                                                <img class="d-block w-50 m-auto" height="200px" src="{{asset($attachment->attach_url)}}" alt="First slide">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            @if($rent->penalty_amount)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Penalty Fee</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input type="number" class="form-control" value="{{$rent->penalty_amount}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($rent->comment)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea class="form-control" rows="5" cols="30">{{$rent->comment}}</textarea>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-4">
                                <div class="form-group">
                                    <b>Due Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input type="number" class="form-control" value="{{number_format((float)($rent->total_amount - $rent->book_amount), 2, '.', '')}}" disabled>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if($rent->status == 'reserved')
                    <div class="body mb-4">
                        <form method="POST" action="{{route('admin.rents.update', $rent->id)}}" id="advanced-form"
                              data-parsley-validate novalidate class="edit" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h6>Pickup Details</h6>
                            <div class="row w-100 p-3">
                                <div class="col-3">
                                    <div class="form-group">
                                        <b>Due Amount</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input type="number" class="form-control" value="{{number_format((float)($rent->total_amount - $rent->book_amount), 2, '.', '')}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <b>Pick Amount</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="pick_amount" value="{{old('pick_amount', $rent->pick_amount)}}">
                                        </div>
                                        @error('pick_amount')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="status" class="mb-0">Rent Status</label>
                                        <input type="text" id="status" disabled value="Taken" class="form-control">
                                        <input type="hidden" value="taken" name="status">
                                        @error('status')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <b>Insurance Amount</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="insurance_amount" value="{{old('insurance_amount', $rent->insurance_amount)}}">
                                        </div>
                                        @error('insurance_amount')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <b>Insurance Attachment</b>
                                    <input type="file" class="dropify" name="attach_url[]" multiple required>
                                    <div class="mt-3"></div>
                                    @error('attach_url')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" id="btn-submit" class="btn btn-primary ">Update</button>
                        </form>
                    </div>
                @endif
                @if($rent->status == 'taken')
                    <div class="body mb-4">
                        <h6>Pickup Details</h6>
                        <div class="row w-100 p-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <b>Due Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input type="number" class="form-control" value="{{number_format((float)($rent->total_amount - ($rent->book_amount + $rent->pick_amount)), 2, '.', '')}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <b>Pick Amount</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                        </div>
                                        <input type="number" class="form-control" value="{{$rent->pick_amount}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($rent->attachments as $index => $attachment)
                                            <div class="carousel-item text-center @if($index == 0) active @endif">
                                                <img class="d-block w-50 m-auto" height="200px" src="{{asset($attachment->attach_url)}}" alt="First slide">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body mb-4">
                        <h6>Return Details</h6>
                        <form method="POST" action="{{route('admin.rents.update', $rent->id)}}" id="advanced-form"
                              data-parsley-validate novalidate class="edit" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row w-100 p-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="insurance_status"><b>Insurance Status</b></label>
                                        <select name="insurance_status" class="form-control select2"
                                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required id="insurance_status">
                                            <option value="return">All Returned</option>
                                            <option value="all">All Collected</option>
                                        </select>
                                        @error('insurance_status')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <b>Insurance Amount</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input type="number" class="form-control" value="{{$rent->insurance_amount}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status" class="mb-0">Rent Status</label>
                                        <input type="text" id="status" disabled value="Return" class="form-control">
                                        <input type="hidden" value="return" name="status">
                                        @error('status')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="mb-0">Penalty Fee</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="penalty_amount" value="{{old('penalty_amount', $rent->penalty_amount)}}">
                                        </div>
                                        @error('penalty_amount')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea class="form-control" name="comment" rows="5" cols="30">{{old('comment', $rent->comment)}}</textarea>
                                        @error('comment')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary ">Update</button>
                        </form>
                    </div>
                @endif
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

        });
    </script>
@stop
