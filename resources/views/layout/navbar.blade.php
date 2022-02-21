<nav class="navbar top-navbar">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="{{route('admin.dashboard')}}"><img src="{{url('/assets/images/icon.svg')}}" alt="Logo"
                        class="img-fluid logo"></a>
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{url('salesOrders/create')}}" class=" icon-menu" title="Right Menu"><span class="icon-plus text-info font-weight-bolder">New Sales Order</span></a></li>
                <li><a href="{{url('purchaseOrders/create')}}" class="icon-menu" title="Right Menu"><span class="icon-plus text-info font-weight-bolder">New Purshase Order</span></a></li>
                </li>
            </ul>
        </div>

        <div class="navbar-right">

            <div id="navbar-menu">

                <ul class="nav navbar-nav">
                    @php
                    $rents = \App\Models\Rent::where('status', 'taken')->where('deliver_date', '<=', \Carbon\Carbon::now())->get();
                    $saleID = \App\Models\SalesPayment::where('remaining', 0)->pluck('so_id');
                    $sales = \App\Models\SalesOrder::whereNotIn('id', $saleID)->where('expected_on', '<=', \Carbon\Carbon::now())->get();
                    $purchaseID = \App\Models\Payment::where('remaining', 0)->pluck('po_id');
                    $purchases = \App\Models\PurchaseOrder::whereNotIn('id', $purchaseID)->where('expected_on', '<=', \Carbon\Carbon::now())->get();
                    $count = $rents->count() + $sales->count() + $purchases->count();
                    @endphp
                    <li><a href="{{route('admin.dues')}}" class="icon-menu @if($count > 0) text-danger @endif " style="font-size: 19px;"><i class="icon-bell" style="position: relative;"> @if($count > 0) <span style="width: 9px;height: 10px;position: absolute;background-color: #dc3545;border-radius: 50%;top: 9px;right: -2px;"></span> @endif</i></a>
                    <li><a href="javascript:void(0);" class="search_toggle icon-menu" title="Search Result"><i
                                class="icon-magnifier"></i></a></li>

                    <li><a href="{{url('/logout')}}" class="icon-menu"><i class="icon-power"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</nav>
