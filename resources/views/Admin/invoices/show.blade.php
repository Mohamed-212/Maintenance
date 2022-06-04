@extends('layout.master')
@section('parentPageTitle', __('general.dashboard'))
@section('title', __('reports.show_invoice'))


@section('content')
    <div class="row clearfix" id="print">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6">
                            <p class="m-b-2"><strong>@lang('reports.customer_name'): </strong>{{optional($salesorder->customer)->name}}</p>
                            <p class="m-b-2"><strong>@lang('reports.vendor_code'): </strong>{{optional($salesorder->customer)->vendor_code}}</p>
                            <p class="m-b-2"><strong>@lang('reports.order_date'): </strong>{{ Carbon\Carbon::parse($salesorder->created_at)->format('Y-m-d') }}</p>
                            <p><strong>@lang('reports.order_id'): </strong> {{$salesorder->id}}</p>
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
                                        <th>@lang('reports.item')</th>
                                        <th>@lang('reports.quantity')</th>
                                        <th>@lang('reports.price')</th>
                                        <th>@lang('reports.tax')</th>
                                        <th>@lang('general.total')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($item_salesorders as $index => $item_salesorder)
                                        <tr>
                                            @php
                                                $item=\App\Models\Item::find($item_salesorder->item);
                                            @endphp
                                            <td>{{$index}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item_salesorder->quantity}}</td>
                                            <td>{{$item->taxed_price}}</td>
                                            <td>{{$item->category->tax->percentage*$item->price/100}}</td>
                                            <td>{{$item->taxed_price*$item_salesorder->quantity}}</td>
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
                            <div><span>@lang('reports.total_taxes'): <strong class="text-success"> {{$salesorder->total_taxes}}  @lang('general.currency')</strong></span></div>
                            <div><span> @lang('general.total') : <strong class="text-success">{{$salesorder->total_amount}}  @lang('general.currency') </strong></span></div>
                            <div><span>@lang('reports.paid'): <strong class="text-success">{{$salesorder->paid}}  @lang('general.currency')</strong></span></div>
                            <div><span>@lang('reports.remaining'): <strong class="text-success">{{$salesorder->remaining}}  @lang('general.currency')</strong></span></div>
                        </div>
                    </div>
                    <div class="row clearfix noPrint">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-info" onClick="printme()"><i class="icon-printer"></i>@lang('general.print')</button>
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
