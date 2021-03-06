@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Brand')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Brand</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.carBrands.update',['carBrand'=>$brand->id])}}" id="advanced-form"
                    data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <b>Brand Name</b>
                            <input type="text" class="form-control mt-2" placeholder="Enter Brand Name" name="name" value="{{$brand->name}}"><br>
        
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <button type="submit" class="btn btn-primary mx-auto">Update</button>
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
