@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('employees.edit_salary'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('employees.edit_salary')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.salaries.update',['salary'=>$salary->id])}}"
                    id="advanced-form" data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="emp_id">@lang('employees.employees')</label>
                                <select name="emp_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required disabled>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}" {{$salary->emp_id==$employee->id?'selected':''}}>
                                        {{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="total">@lang('employees.total_salary')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="total"
                                           value="{{$salary->employee->salary}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>@lang('general.month')</label>
                                <select name="month" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                    <option value="">@lang('general.choose_option')</option>
                                    <option value="january" {{$salary->month=='January'?'selected':''}}>@lang('general.january')</option>
                                    <option value="february" {{$salary->month=='Febuary'?'selected':''}}>@lang('general.february')</option>
                                    <option value="march" {{$salary->month=='March'?'selected':''}}>@lang('general.march')</option>
                                    <option value="april" {{$salary->month=='April'?'selected':''}}>@lang('general.april')</option>
                                    <option value="may" {{$salary->month=='May'?'selected':''}}>@lang('general.may')</option>
                                    <option value="june" {{$salary->month=='June'?'selected':''}}>@lang('general.june')</option>
                                    <option value="july" {{$salary->month=='July'?'selected':''}}>@lang('general.july')</option>
                                    <option value="august" {{$salary->month=='August'?'selected':''}}>@lang('general.august')</option>
                                    <option value="september" {{$salary->month=='September'?'selected':''}}>@lang('general.september')</option>
                                    <option value="october" {{$salary->month=='October'?'selected':''}}>@lang('general.october')</option>
                                    <option value="november" {{$salary->month=='November'?'selected':''}}>@lang('general.november')</option>
                                    <option value="december" {{$salary->month=='December'?'selected':''}}>@lang('general.december')</option>
                                </select>
                                @error('month')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>@lang('employees.salary_date')</label>
                                <div class="input-group mb-3">
                                    <input data-provide="datepicker" data-date-autoclose="true" class="form-control"
                                        name="salary_date" data-date-format="yyyy-mm-dd" required
                                           value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" disabled>
                                </div>
                                @error('salary_date')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('employees.bonus')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="bonus"
                                           value="{{$salary->bonus}}">
                                </div>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="deduction">@lang('employees.deduction')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="deduction"
                                           value="{{$salary->deduction}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('employees.loan_deduction')</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="loan_deduction"
                                           value="{{$salary->loan_deduction}}" disabled>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('general.comments')</label>
                                <textarea class="form-control" name="comments" rows="5"
                                    cols="30">{{$salary->comments}}</textarea>
                                @error('comments')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary mx-auto">@lang('general.update')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/parsleyjs/css/parsley.css') }}">
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
