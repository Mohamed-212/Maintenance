@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('employees.create_salary'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('employees.create_new_salary')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.salaries.store')}}" id="advanced-form" data-parsley-validate
                    novalidate class="confirm">
                    @csrf
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for="emp_id">@lang('employees.employees')</label>
                                <select name="emp_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" id="emp_id" aria-hidden="true" required>
                                    <option value="">@lang('general.choose_option')</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="total">@lang('employees.total_salary')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" id="total" class="form-control key"
                                           value="" disabled>
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
                                    <option value="january">@lang('general.january')</option>
                                    <option value="february">@lang('general.february')</option>
                                    <option value="march">@lang('general.march')</option>
                                    <option value="april">@lang('general.april')</option>
                                    <option value="may">@lang('general.may')</option>
                                    <option value="june">@lang('general.june')</option>
                                    <option value="july">@lang('general.july')</option>
                                    <option value="august">@lang('general.august')</option>
                                    <option value="september">@lang('general.september')</option>
                                    <option value="october">@lang('general.october')</option>
                                    <option value="november">@lang('general.november')</option>
                                    <option value="december">@lang('general.december')</option>
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
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="bonus" value="{{old('bonus')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('employees.deduction')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" name="deduction"
                                           value="{{old('deduction')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="loan_deduction">@lang('employees.loan_deduction')</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>@lang('general.currency')</b></span>
                                    </div>
                                    <input type="number" class="form-control key" id="loan_deduction"
                                           value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('general.comments')</label>
                                <textarea class="form-control" name="comments" rows="5"
                                    cols="30">{{old('comments')}}</textarea>
                                @error('comments')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto">@lang('general.create')</button>
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
    var config ={
        _url:"{{url('/getSalary/')}}"
    }
</script>
<script src="{{ asset('assets/js/pages/salary.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
