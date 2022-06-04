<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{route('admin.dashboard')}}"><img src="{{url('assets/images/icon.svg')}}" alt="Logo"
                                                    class="img-fluid logo"><span>Maintenance</span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{url('assets/images/user.png')}}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>@lang('sidebar.welcome')</span>
                <a href="javascript:void(0);" class="user-name" data-toggle="dropdown"><strong>
                        {{isset(auth()->user()->name) ? auth()->user()->name : null}}</strong></a>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                @if(auth()->user()->hasRole('locations'))
                    <li class="{{ in_array(Request::segment(2), ['cities','areas']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i class="icon-anchor"></i><span>@lang('sidebar.locations')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'cities' ? 'active' : null }}"><a
                                    href="{{route('admin.cities.index')}}">@lang('sidebar.cities')</a></li>
                            <li class="{{ Request::segment(2) === 'areas' ? 'active' : null }}"><a
                                    href="{{route('admin.areas.index')}}">@lang('sidebar.areas')</a></li>

                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('locations'))
                    <li class="{{ in_array(Request::segment(2), ['taxTypes','taxes']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i
                                class="icon-book-open"></i><span>@lang('sidebar.taxes')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'taxTypes' ? 'active' : null }}"><a
                                    href="{{route('admin.taxTypes.index')}}">@lang('sidebar.types')</a></li>
                            <li class="{{ Request::segment(2) === 'taxes' ? 'active' : null }}"><a
                                    href="{{route('admin.taxes.index')}}">@lang('sidebar.taxes')</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('items'))
                    <li class="{{ in_array(Request::segment(2), ['categories','subCategories','items']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i class="icon-basket"></i><span>@lang('sidebar.items')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'categories' ? 'active' : null }}"><a
                                    href="{{route('admin.categories.index')}}">@lang('sidebar.categories')</a></li>
                            <li class="{{ Request::segment(2) === 'subCategories' ? 'active' : null }}"><a
                                    href="{{route('admin.subCategories.index')}}">@lang('sidebar.subCategories')</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'items' ? 'active' : null }}"><a
                                    href="{{route('admin.items.index')}}">@lang('sidebar.items')</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('customers'))
                    <li class="{{ Request::segment(2) === 'customers' ? 'active' : null }}">
                        <a href="{{route('admin.customers.index')}}"><i
                                class="icon-users"></i><span>@lang('sidebar.customers')</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('employees'))
                    <li class="{{ in_array(Request::segment(2), ['jobs','salaries','loans','employees']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i
                                class="icon-briefcase"></i><span>@lang('sidebar.employees')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'jobs' ? 'active' : null }}"><a
                                    href="{{route('admin.jobs.index')}}">@lang('sidebar.jobs')</a></li>
                            <li class="{{ Request::segment(2) === 'salaries' ? 'active' : null }}"><a
                                    href="{{route('admin.salaries.index')}}">@lang('sidebar.salaries')</a></li>
                            <li class="{{ Request::segment(2) === 'loans' ? 'active' : null }}"><a
                                    href="{{route('admin.loans.index')}}">@lang('sidebar.loans')</a></li>
                            <li class="{{ Request::segment(2) === 'employees' ? 'active' : null }}"><a
                                    href="{{route('admin.employees.index')}}">@lang('sidebar.employees')</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('inventories'))
                    <li class="{{ Request::segment(2) === 'inventories' ? 'active' : null }}">
                        <a href="{{route('admin.inventories.index')}}"><i
                                class="icon-layers"></i><span>@lang('sidebar.inventories')</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('suppliers'))
                    <li class="{{ Request::segment(2) === 'suppliers' ? 'active' : null }}">
                        <a href="{{route('admin.suppliers.index')}}"><i
                                class="icon-loop"></i><span>@lang('sidebar.suppliers')</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('orders'))
                    <li class="{{ in_array(Request::segment(2), ['purchaseOrders','salesOrders']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i
                                class="icon-paper-plane"></i><span>@lang('sidebar.orders')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'purchaseOrders' ? 'active' : null }}"><a
                                    href="{{route('admin.purchaseOrders.index')}}">@lang('sidebar.purchase_orders')</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'salesOrders' ? 'active' : null }}"><a
                                    href="{{route('admin.salesOrders.index')}}">@lang('sidebar.sales_orders')</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('returns'))
                    <li class="{{ in_array(Request::segment(2), ['returns']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i
                                class="icon-paper-plane"></i><span>@lang('sidebar.returns')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'returns' ? 'active' : null }}"><a
                                    href="{{route('admin.returns.index')}}">@lang('sidebar.purchase_orders')</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('expenses'))
                    <li class="{{ in_array(Request::segment(2), ['expensesType','expenses']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i
                                class="icon-wallet"></i><span>@lang('sidebar.expenses')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'expensesType' ? 'active' : null }}"><a
                                    href="{{route('admin.expensesType.index')}}">@lang('sidebar.types')</a></li>
                            <li class="{{ Request::segment(2) === 'expenses' ? 'active' : null }}"><a
                                    href="{{route('admin.expenses.index')}}">@lang('sidebar.expenses')</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->hasRole('offers'))
                    <li class="{{ Request::segment(2) === 'offers' ? 'active' : null }}">
                        <a href="{{route('admin.offers.index')}}"><i
                                class="icon-calculator"></i><span>@lang('sidebar.offers')</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('purchase_payments'))
                    <li class="{{ Request::segment(2) === 'payments' ? 'active' : null }}">
                        <a href="{{route('admin.payments.index')}}"><i
                                class="icon-arrow-down"></i><span>@lang('sidebar.purchase_payments')</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('sales_payments'))
                    <li class="{{ Request::segment(2) === 'salesPayments' ? 'active' : null }}">
                        <a href="{{route('admin.salesPayments.index')}}"><i
                                class="icon-arrow-down"></i><span>@lang('sidebar.sales_payments')</span></a>
                    </li>
                @endif
                @if(auth()->user()->hasRole('reports'))
                    <li class="{{ in_array(Request::segment(2), ['invoices','reports']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i class="icon-bar-chart"></i><span>@lang('sidebar.reports')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'invoices' ? 'active' : null }}"><a
                                    href="{{route('admin.invoices.index')}}">@lang('sidebar.invoices')</a></li>
                            {{--                        <li><a href="{{route('admin.profits')}}">Profit</a></li>--}}
                            <li class="{{ Request::segment(3) === 'purchases' ? 'active' : null }}"><a
                                    href="{{route('admin.purchase')}}">@lang('sidebar.purchase_orders')</a></li>
                            <li class="{{ Request::segment(3) === 'sales' ? 'active' : null }}"><a
                                    href="{{route('admin.sale')}}">@lang('sidebar.sales_orders')</a></li>
                            <li class="{{ Request::segment(3) === 'salesItem' ? 'active' : null }}"><a
                                    href="{{route('admin.saleItem')}}">@lang('sidebar.sales_orders_per_items')</a></li>
                            <li class="{{ Request::segment(3) === 'expenses' ? 'active' : null }}"><a
                                    href="{{route('admin.expense')}}">@lang('sidebar.expenses')</a></li>
                            <li class="{{ Request::segment(3) === 'returns' ? 'active' : null }}"><a
                                    href="{{route('admin.report.returns')}}">@lang('sidebar.returns_purchase_order')</a>
                            </li>
                            <li class="{{ (Request::segment(4) == '' && Request::segment(3) === 'safes') ? 'active' : null }}">
                                <a href="{{route('admin.report.safe')}}">@lang('sidebar.safe_transactions')</a></li>
                            <li class="{{ Request::segment(4) === 'cash' ? 'active' : null }}"><a
                                    href="{{route('admin.report.safeCash')}}">@lang('sidebar.cash_safe_transactions')</a>
                            </li>
                            <li class="{{ Request::segment(4) === 'visa' ? 'active' : null }}"><a
                                    href="{{route('admin.report.safeVisa')}}">@lang('sidebar.visa_safe_transactions')</a>
                            </li>
                        </ul>
                    </li>
                @endif
                    {{--                <li class="{{ in_array(request()->segment(1), ['services', 'rents'])  ? 'active open' : null }}">--}}
                    {{--                    <a href="" class="has-arrow"><i class="icon-bar-chart"></i><span>Services</span></a>--}}
                    {{--                    <ul>--}}
                    {{--                        <li><a href="{{route('admin.services.index')}}">Service</a></li>--}}
                    {{--                        <li><a href="{{route('admin.rents.index')}}">Rents</a></li>--}}
                    {{--                    </ul>--}}
                    {{--                </li>--}}
                <!--<li class="{{ Request::segment(2) === 'cars' ? 'active open' : null }}">-->
                    <!--    <a href="" class="has-arrow"><i class="icon-vector"></i><span>Cars</span></a>-->
                    <!--    <ul>-->
                <!--        <a href="{{route('admin.carBrands.index')}}"><span>Brands</span></a>-->
                <!--        <a href="{{route('admin.carModels.index')}}"><span>Models</span></a>-->
                <!--        <li><a href="{{route('admin.cars.index')}}">Cars</a></li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                <!--<li class="{{ Request::segment(2) === 'serviceMaintenance' ? 'active open' : null }}">-->
                <!--    <a href="{{route('admin.serviceMaintenance.index')}}"><i class="icon-settings"></i><span>Car-->
                    <!--            Maintenance</span></a>-->
                    <!--</li>-->
                @if(auth()->user()->hasRole('administrators'))
                    <li class="{{ in_array(Request::segment(2), ['users','roles']) ? 'active open' : null }}">
                        <a href="" class="has-arrow"><i
                                class="icon-lock"></i><span>@lang('sidebar.administrators')</span></a>
                        <ul>
                            <li class="{{ Request::segment(2) === 'users' ? 'active' : null }}"><a
                                    href="{{route('admin.users.index')}}">@lang('sidebar.users')</a></li>
{{--                            <li class="{{ Request::segment(2) === 'roles' ? 'active' : null }}"><a--}}
{{--                                    href="{{route('admin.roles.index')}}">@lang('sidebar.roles')</a></li>--}}
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
