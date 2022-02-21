@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Invoice')
@section('content')
    <div class="row clearfix" id="print">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6">
                            <p class="m-b-2"><strong>Customer Name: </strong>{{optional($salesorder->customer)->name}}
                            </p>
                            <p class="m-b-2"><strong>Order
                                    Date: </strong>{{ Carbon\Carbon::parse($salesorder->created_at)->format('Y-m-d') }}
                            </p>
                            <p><strong>Order ID: </strong> {{$salesorder->id}}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 text-right">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing5 mb-5">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                        <!--<th>Description</th>-->
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Tax</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($item_salesorders as $item_salesorder)
                                        <tr>
                                            @php
                                                $item=\App\Models\Item::find($item_salesorder->item);
                                            @endphp

                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>

                                            <!--<td>-->
                                            <!--    <span></span>-->
                                            <!--    <p class="hidden-sm-down mb-0 text-muted">{{$item->description}}</p>-->
                                            <!--</td>-->
                                            <td>{{$item_salesorder->quantity}}</td>
                                            <td>{{$item->taxed_price}}</td>
                                            <td>{{$item->category->tax->percentage*$item->price/100}}</td>

                                            <td class="text-center">{{$item->taxed_price*$item_salesorder->quantity}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix text-center mb-3 font-20 summary-print">
                        <div class="col-md-12">
                            <div><span>Total Taxes: <strong class="text-success">{{$salesorder->total_taxes}}  LE</strong></span></div>
                            <div><span>Total: <strong class="text-success">{{$salesorder->total_amount}}  LE</strong></span></div>
                            <div><span>Paid: <strong class="text-success">{{$salesorder->paid}}  LE</strong></span></div>
                            <div><span>Remaining: <strong class="text-success">{{$salesorder->remaining}}  LE</strong></span></div>
                        </div>
                    </div>
                    <div class="row clearfix noPrint">
                        <div class="col-md-6 text-right">
                            <button class="btn btn-info" onClick="printme()"><i class="icon-printer"></i> Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
@stop

@section('page-script')
    <script>
        var printme = function () {
            var prtContent = document.getElementById("print");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

            WinPrint.document.write('<html><head><title></title>');
            WinPrint.document.write('<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" />');
            WinPrint.document.write('</head><body >');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.write('</body></html>');

            WinPrint.document.close();
            WinPrint.focus();
            setTimeout(function () {
                WinPrint.print();
                WinPrint.close();
            }, 1000);
            return true;
        }
    </script>
    <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
@stop
