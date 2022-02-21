@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Edit Item')


@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>Edit Item</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{route('admin.items.update',['item'=>$item->id])}}" id="advanced-form"
                    data-parsley-validate novalidate class="edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">Category</label>
                                <select name="category_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">Choose Category</option>

                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{$item->category_id==$category->id ?'selected':''}}>{{$category->name}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="tax_id">SubCategory</label>
                                <select name="sub_category_id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required id="subCategory">
                                 <option value="">Choose SubCategory</option>

                                 @foreach($subCategories as $sub)
                                 <option value="{{$sub->id}}"
                                     {{$item->sub_category_id==$sub->id ?'selected':''}}>{{$sub->name}}
                                 </option>
                                 @endforeach
    
                                </select>
                                @error('sub_category_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_id">Item Name</label>
                                <input type="text" class="form-control" placeholder="enter Item Name" name="name"
                                    value="{{$item->name}}"><br>
                                @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="type_id">Serial Number</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="text" class="form-control key" placeholder="Ex:12388587745"
                                        name="serial_number" value="{{$item->serial_number}}">
                                </div>
                                @error('serial_number')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="5" cols="30">{{$item->description}}</textarea>
                                @error('description')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                    </div>
                                    <input type="text" class="form-control money-dollar" placeholder="Ex: 99,99 $"
                                        name="price" value="{{$item->price}}"><br>
                                </div>
                                @error('price')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="type_id">Item Unit</label>
                                <input type="text" class="form-control" placeholder="Ex: liter" name="unit"
                                    value="{{$item->unit}}">
                                @error('unit')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tax_id">Availability</label>
                                <select name="active" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="">Choose</option>
                                    <option value="0" {{$item->active==0?'selected':''}}>Not Available</option>
                                    <option value="1" {{$item->active==1?'selected':''}}>Available</option>

                                </select>
                                @error('active')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary mx-auto">Update</button>
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
@stop

@section('page-script')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script>
    var config ={
    _url:"{{url('/getSubByCategory/')}}"
    }
</script>
<script src="{{ asset('assets/js/pages/getSubCategory.js') }}"></script>
<script>
    $(function() {
    // validation needs name of the element
    $('#food').multiselect();

    // initialize after multiselect
    $('#basic-form').parsley();
});
</script>
@stop
