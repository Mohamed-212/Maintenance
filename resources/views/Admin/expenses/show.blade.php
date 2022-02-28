@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('expenses.show_expense'))


@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>@lang('expenses.show_expense')</h2>
                </div>
                <div class="body">
                    <form method="POST" action="" id="advanced-form" enctype="multipart/form-data" data-parsley-validate
                          novalidate>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>@lang('expenses.type')</label>
                                    <select name="type_id" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                            disabled>
                                        <option value="">@lang('general.choose_option')</option>
                                        @foreach($types as $type)
                                            <option
                                                value="{{$type->id}}"{{$expense->type_id==$type->id?'selected':''}}>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="amount">@lang('expenses.amount')</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                        </div>
                                        <input type="text" class="form-control money-dollar" placeholder="99,99"
                                               name="total_amount" value="{{$expense->total_amount}}" disabled>
                                    </div>
                                    @error('total_amount')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>@lang('expenses.payment_type')</label>
                                    <select name="payment_type" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true"
                                            disabled>
                                        <option value="">@lang('general.choose_option')</option>
                                        <option
                                            value="cash"{{$expense->payment_type=='cash'?'selected':''}}>@lang('general.cash')</option>
                                        <option value="visa"{{$expense->payment_type=='visa'?'selected':''}}>
                                            >@lang('general.visa')</option>
                                    </select>
                                    @error('payment_type')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>@lang('expenses.employee')</label>
                                    <input type="text" class="form-control" value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>@lang('expenses.date')</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control key"
                                               value="{{ Carbon\Carbon::now()->format('Y-m-d')}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>@lang('general.comments')</label>
                                    <textarea class="form-control" name="comments" rows="5" cols="30"
                                              disabled>{{isset($expense->comments)?$expense->comments:''}}</textarea>
                                    @error('comments')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if($expense->file_attachment!=null)
                            <div class="row">
                                <div class="col-7 mx-auto">
                                    <img src="{{url('public/uploads/expenses/')}}/{{$expense->file_attachment}}"
                                         class="img-thumbnail" alt="expense" width="304" height="236">
                                    <div class="mt-3"></div>
                                </div>
                            </div>
                        @endif
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
@stop

@section('page-script')
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
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
        });
    </script>
@stop
