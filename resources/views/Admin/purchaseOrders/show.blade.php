@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('orders.invoice_for_purchase_order'))


@section('content')
    <div class="row clearfix" id="print">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6">
                            <p class="m-b-2"><strong>@lang('orders.supplier_company_name'): </strong>{{$purchaseorder->supplier->company_name}}</p>
                            <p class="m-b-2"><strong>@lang('orders.inventory_name'): </strong>{{$purchaseorder->inventory->name}}</p>
                            <p class="m-b-2"><strong>@lang('orders.order_date'): </strong>{{ Carbon\Carbon::parse($purchaseorder->created_at)->format('Y-m-d') }}</p>
                            <p class="m-b-2"><strong>@lang('orders.due_date'): </strong>{{$purchaseorder->expected_on}}</p>
                            <p><strong>@lang('orders.order_id'): </strong> {{$purchaseorder->id}}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 text-right"></div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing5 mb-5">
                                    <thead>
                                    <tr>
                                        <th>@lang('general.sn')</th>
                                        <th>@lang('orders.item')</th>
                                        <th>@lang('orders.purchased_qty')</th>
                                        <th>@lang('orders.rate')</th>
                                        <th>@lang('orders.returned_qty')</th>
                                        <th>@lang('general.total')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($item_PurchaseOrders as $index => $item_purchaseorder)
                                        <tr>
                                            @php
                                                $item=\App\Models\Item::find($item_purchaseorder->item);
                                            @endphp
                                            <td>{{$index + 1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item_purchaseorder->quantity + $item_purchaseorder->return}}</td>
                                            <td>{{$item_purchaseorder->cost}}</td>
                                            <td>{{$item_purchaseorder->return}}</td>
                                            <td>{{number_format((float)abs(($item_purchaseorder->quantity - $item_purchaseorder->return) * $item_purchaseorder->cost), 2, '.', '')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix text-right mb-3 font-20 summary-print">
                        <div class="col-md-12">
                            <div><span>@lang('orders.total_amount'): <strong class="text-success">{{$purchaseorder->total_amount}}  LE</strong></span></div>
                            @php
                            $total = \App\Models\Payment::where('po_id', $purchaseorder->id)->orderBy('created_at', 'DESC')->first();
                            @endphp
                            <div><span>@lang('orders.paid_amount'): <strong class="text-success">{{($total->remaining != 0) ? $purchaseorder->total_amount - $total->remaining : number_format((float)$purchaseorder->total_amount, 2, '.', '')  }}  @lang('general.currency')</strong></span></div>
                            <div><span>@lang('orders.remaining_amount'): <strong class="text-success">{{$total->remaining}}  @lang('general.currency')</strong></span></div>
                            @if($purchaseorder->total_return)
                            <div><span>@lang('orders.returned_amount'): <strong class="text-success">{{number_format((float)abs($purchaseorder->total_return), 2, '.', '')}}  @lang('general.currency')</strong></span></div>
                            @endif
                        </div>
                    </div>
                    <div class="row clearfix noPrint">
                        <div class="col-md-12 m-auto text-center">
                            <button class="btn btn-info" onClick="printme()"><i class="icon-printer"></i> @lang('general.print') </button>
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
