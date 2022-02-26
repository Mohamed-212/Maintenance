@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('areas.create_area'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('areas.create_new_area')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.areas.store')}}" id="advanced-form" data-parsley-validate
                    novalidate class="confirm">
                    @csrf
                    <div class="form-group">
                        <label for="text-input1">@lang('general.english_name')</label>
                        <input type="text" id="text-input1" class="form-control" required name="name_en"
                            value="{{old('name_en')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="text-input2">@lang('general.arabic_name')</label>
                        <input type="text" id="text-input2" class="form-control" required name="name_ar"
                            value="{{old('name_ar')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city_id">@lang('areas.city')</label>
                        <select name="city_id" class="form-control select2 select2-hidden-accessible"
                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city['name_'.app()->getLocale()]}}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('general.create')</button>
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
