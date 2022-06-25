@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('customers.edit_customer'))


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>@lang('customers.edit_customer')</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.customers.update',['customer'=>$customer->id])}}"
                    id="advanced-form" data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('customers.company')</label>
                                <input type="text" class="form-control" placeholder="@lang('customers.company_holder')" name="company"
                                       value="{{$customer->company}}">
                                @error('company')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('customers.landline')</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control key" placeholder="0226698745"
                                           name="landline" value="{{$customer->landline}}">
                                </div>
                                @error('landline')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('customers.fax')</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-volume-control-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control key" placeholder="0226698745"
                                           name="fax" value="{{$customer->fax}}">
                                </div>
                                @error('fax')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('general.email')</label>
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="example@example.com"
                                        name="email" value="{{$customer->email}}">
                                </div>
                                @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('customers.name')</label>
                                <input type="text" class="form-control" placeholder="@lang('customers.name_holder')" name="name"
                                       value="{{$customer->name}}"><br>
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>@lang('customers.position')</label>
                                <input type="text" class="form-control" placeholder="@lang('customers.position_holder')" name="position"
                                       value="{{$customer->position}}">
                                @error('position')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('customers.city')</label>
                                <select name="city_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="city">
                                    <option value="">@lang('general.choose_option')</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{$customer->city_id==$city->id?'selected':''}}>
                                        {{$city['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('customers.area')</label>
                                <select name="area_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="area">
                                    <option value="">@lang('general.choose_option')</option>
                                    @foreach($areas as $area)
                                    <option value="{{$area->id}}" {{$customer->area_id==$area->id?'selected':''}}>
                                        {{$area['name_'.app()->getLocale()]}}</option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('customers.vendor_code')</label>
                                <input type="text" class="form-control" placeholder="@lang('customers.vendor_code_holder')" name="vendor_code"
                                       value="{{$customer->vendor_code}}">
                                @error('vendor_code')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>@lang('customers.vat_no')</label>
                                <input type="text" class="form-control" placeholder="@lang('customers.vat_no')" name="vat_no"
                                       value="{{$customer->vat_no}}">
                                @error('vat_no')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('general.address')</label>
                                <textarea class="form-control" name="address" rows="5"
                                    cols="30">{{$customer->address}}</textarea>
                                @error('address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
{{--                    <div class="row justify-content-sm-center mb-5">--}}
{{--                        <a href="{{url("/cars/insert/{$customer->id}")}}"--}}
{{--                            class="btn btn-success btn-lg"><i class="fa fa-plus"></i>Add Car</a>--}}
{{--                    </div>--}}
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

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script>
    var config ={
    _url:"{{url('/get_areas/')}}",
    _lang:"{{app()->getLocale()}}",
    }
</script>
<script src="{{ asset('assets/js/pages/getAreas.js') }}"></script>

<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
