@extends('layout.master')
@section('parentPageTitle', 'Dashboard')
@section('title', 'Invoice For Purchase Order')
@section('content')
    <div class="row clearfix" id="print">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6">
                            <p class="m-b-2"><strong>Supplier Company Name: </strong>{{$purchaseorder->supplier->company_name}}</p>
                            <p class="m-b-2"><strong>Inventory Name: </strong>{{$purchaseorder->inventory->name}}</p>
                            <p class="m-b-2"><strong>Order
                                    Date: </strong>{{ Carbon\Carbon::parse($purchaseorder->created_at)->format('Y-m-d') }}
                            </p>
                            <p class="m-b-2"><strong>Due Date: </strong>{{$purchaseorder->expected_on}}</p>
                            <p><strong>Order ID: </strong> {{$purchaseorder->id}}</p>
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
                                        <th>Purchased Qty</th>
                                        <th>Rate</th>
                                        <th>Returned Qty</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($item_PurchaseOrders as $item_purchaseorder)
                                        <tr>
                                            @php
                                                $item=\App\Models\Item::find($item_purchaseorder->item);
                                            @endphp

                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>

                                            <!--<td>-->
                                            <!--    <span></span>-->
                                            <!--    <p class="hidden-sm-down mb-0 text-muted">{{$item->description}}</p>-->
                                            <!--</td>-->
                                            <td>{{$item_purchaseorder->quantity + $item_purchaseorder->return}}</td>
                                            <td>{{$item_purchaseorder->cost}}</td>
                                            <td>{{$item_purchaseorder->return}}</td>

                                            <td class="text-center">{{number_format((float)abs(($item_purchaseorder->quantity - $item_purchaseorder->return) * $item_purchaseorder->cost), 2, '.', '')}}</td>
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
                            <div><span>Total amount: <strong class="text-success">{{$purchaseorder->total_amount}}  LE</strong></span></div>
                            @php
                            $total = \App\Models\Payment::where('po_id', $purchaseorder->id)->orderBy('created_at', 'DESC')->first();
                            @endphp
                            <div><span>Paid amount: <strong class="text-success">{{($total->remaining != 0) ? $purchaseorder->total_amount - $total->remaining : number_format((float)$purchaseorder->total_amount, 2, '.', '')  }}  LE</strong></span></div>
                            
                            <div><span>Remaining amount: <strong class="text-success">{{$total->remaining}}  LE</strong></span></div>
                            @if($purchaseorder->total_return)
                            <div><span>Returned amount: <strong class="text-success">{{number_format((float)abs($purchaseorder->total_return), 2, '.', '')}}  LE</strong></span></div>
                            @endif
                        </div>
                    </div>
                    <div class="row clearfix noPrint">
                        <div class="col-md-6 m-auto text-center">
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
