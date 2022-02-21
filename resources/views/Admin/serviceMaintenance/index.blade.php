@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Maintenance')


@section('content')
<div class="row justify-content-end">
    <div class="col-3">
        <a class="btn btn-round btn-primary buttons-html5"href="{{url('serviceMaintenance/create')}}">
            <span>Add New Maintenance</span>
        </a>
    </div>
  
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                
            
            </div>
            <div class="body">
                <div class="table-responsive">
                    
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Entrance Date</th>
                                <th>Total</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                      
                        <tbody>
                            @foreach ($maintenances as $item)
                                
                      
                            <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->car->customer->name}}</td>
                            <td>{{$item->car->car_model->name}}</td>
                            <td>{{$item->entrance_date}}</td>
                            <td>{{$item->total}}</td>
                         
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                      Options
                                    </button>
                                    <div class="dropdown-menu row">
                                        <div class="col-12 ml-2">
                                            <a href="{{url("/serviceMaintenance/{$item->id}")}}"
                                                ><i class="fa fa-camera"></i>Show</a>
                                        </div>
                                        <div class="col-12">
                                            <form action="{{url("/serviceMaintenance/{$item->id}")}}" method="post" class="delete">
                                                <button style="background-color: white;border:thick;" class="text-danger">
                                                    <i class="fa fa-trash-o"></i>Delete
                                                </button>
                                                    @method('DELETE')
                                                     @csrf
                                            </form>
                                        </div>
   
                            
                                    </div>
                                  </div>
                            </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}"/>
<style>
    td.details-control {
    background: url('../assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('../assets/images/details_close.png') no-repeat center center;
    }
</style>
<style>


</style>
@stop

@section('page-script')
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>


<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>

<script>
    $(function(){
        $('.js-exportabl').DataTable({
        buttons:[
            'excel',
        ],
    });
    })
    // var table = $('#test').DataTable({
    //     rowReorder: {
    //         selector: 'td:nth-child(2)'
    //     },
    //     destroy: true,
    //     responsive: true
    // });

    // </script>
@stop