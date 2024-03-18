<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            @php
                $dashboard = ['/invoice/public/dashboard', '/invoice/public/', '/dashboard', '/'];
            @endphp
            <li class="@if (in_array($_SERVER['REQUEST_URI'], $dashboard)) active @endif">
                <a href="{{ url('/dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            @php $master[0] = ['/invoice/public/measure', '/invoice/public/company', '/invoice/public/bank', '/invoice/public/expense', '/invoice/public/ExpenseType', '/invoice/public/tax', '/invoice/public/PaymentMode', '/invoice/public/vendor', '/invoice/public/RawMaterial', '/invoice/public/product', '/invoice/public/customer']; @endphp
            @php $master[1] = ['/measure', '/company', '/bank', '/expense', '/ExpenseType', '/tax', '/PaymentMode', '/vendor', '/RawMaterial', '/product', '/customer']; @endphp
            <li class="pcoded-hasmenu @if(in_array($_SERVER['REQUEST_URI'], $master[0]) || in_array($_SERVER['REQUEST_URI'], $master[1]))active pcoded-trigger @endif">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">Master</span>
                </a>
                <ul class="pcoded-submenu @if(in_array($_SERVER['REQUEST_URI'], $master[0]) || in_array($_SERVER['REQUEST_URI'], $master[1]))active @endif">
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/company' || $_SERVER['REQUEST_URI'] == '/company') active @endif">
                        <a href="{{ url('/company') }}">
                            <span class="pcoded-mtext">Company</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/bank' || $_SERVER['REQUEST_URI'] == '/bank') active @endif">
                        <a href="{{ url('/bank') }}">
                            <span class="pcoded-mtext">Company Bank</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/tax' || $_SERVER['REQUEST_URI'] == '/tax') active @endif">
                        <a href="{{ url('/tax') }}">
                            <span class="pcoded-mtext">Tax</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/measure' || $_SERVER['REQUEST_URI'] == '/measure') active @endif">
                        <a href="{{ url('/measure') }}">
                            <span class="pcoded-mtext">Measures</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/ExpenseType' || $_SERVER['REQUEST_URI'] == '/ExpenseType') active @endif">
                        <a href="{{ url('/ExpenseType') }}">
                            <span class="pcoded-mtext">Expense Type</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/expense' || $_SERVER['REQUEST_URI'] == '/expense') active @endif">
                        <a href="{{ url('/expense') }}">
                            <span class="pcoded-mtext">Expense</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/PaymentMode' || $_SERVER['REQUEST_URI'] == '/PaymentMode') active @endif">
                        <a href="{{ url('/PaymentMode') }}">
                            <span class="pcoded-mtext">Payment Mode</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/vendor' || $_SERVER['REQUEST_URI'] == '/vendor') active @endif">
                        <a href="{{ url('/vendor') }}">
                            <span class="pcoded-mtext">Vendor</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/RawMaterial' || $_SERVER['REQUEST_URI'] == '/RawMaterial') active @endif">
                        <a href="{{ url('/RawMaterial') }}">
                            <span class="pcoded-mtext">Raw Material</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/product' || $_SERVER['REQUEST_URI'] == '/product') active @endif">
                        <a href="{{ url('/product') }}">
                            <span class="pcoded-mtext">Product</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/customer' || $_SERVER['REQUEST_URI'] == '/customer') active @endif">
                        <a href="{{ url('/customer') }}">
                            <span class="pcoded-mtext">Customer</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- @php $Branch = ['/BranchPo', '/BranchInvoice']; @endphp
            <li class="pcoded-hasmenu @if(in_array($_SERVER['REQUEST_URI'], $Branch))active pcoded-trigger @endif">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">Branch Accounting</span>
                </a>
                <ul class="pcoded-submenu @if(in_array($_SERVER['REQUEST_URI'], $Branch))active @endif">
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/BranchPo') active @endif">
                        <a href="#chPo') }}">
                            <span class="pcoded-mtext">PO</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/BranchInvoice') active @endif">
                        <a href="#chInvoice') }}">
                            <span class="pcoded-mtext">Invoice</span>
                        </a>
                    </li>
                </ul>
            </li>
            @php $Vendor = ['/quotation', '/po', '/invoice']; @endphp
            <li class="pcoded-hasmenu @if(in_array($_SERVER['REQUEST_URI'], $Vendor))active pcoded-trigger @endif">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">Vendor Accounting</span>
                </a>
                <ul class="pcoded-submenu @if(in_array($_SERVER['REQUEST_URI'], $Vendor))active @endif">
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/quotation') active @endif">
                        <a href="#ation') }}">
                            <span class="pcoded-mtext">Quotation</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/po') active @endif">
                        <a href="# }}">
                            <span class="pcoded-mtext">PO</span>
                        </a>
                    </li>
                    <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice') active @endif">
                        <a href="#ice') }}">
                            <span class="pcoded-mtext">Invoice</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/Raw-Material' || $_SERVER['REQUEST_URI'] == '/Raw-Material') active @endif">
                <a href="{{ url('/Raw-Material') }}">
                    <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                    <span class="pcoded-mtext">Raw Material Stock</span>
                </a>
            </li>
            <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/proforma' || $_SERVER['REQUEST_URI'] == 'proforma') active @endif">
                <a href="{{ url('/proforma') }}">
                    <span class="pcoded-micon"><i class="fa fa-paste"></i></span>
                    <span class="pcoded-mtext">Proforma</span>
                </a>
            </li>
            <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/invoice' || $_SERVER['REQUEST_URI'] == '/invoice') active @endif">
                <a href="{{ url('/invoice') }}">
                    <span class="pcoded-micon"><i class="fa fa-file"></i></span>
                    <span class="pcoded-mtext">Invoice</span>
                </a>
            </li>
            <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/receipt' || $_SERVER['REQUEST_URI'] == '/receipt') active @endif">
                <a href="{{ url('/receipt') }}">
                    <span class="pcoded-micon"><i class="fa fa-money"></i></span>
                    <span class="pcoded-mtext">Receipt</span>
                </a>
            </li>
            <li class="@if ($_SERVER['REQUEST_URI'] == '/invoice/public/credit_note' || $_SERVER['REQUEST_URI'] == '/credit_note') active @endif">
                <a href="{{ url('/credit_note') }}">
                    <span class="pcoded-micon"><i class="fa fa-credit-card-alt"></i></span>
                    <span class="pcoded-mtext">Credit Note</span>
                </a>
            </li>
            <li class="@if ($_SERVER['REQUEST_URI'] == '/DemageStock') active @endif">
                <a href="#">
                    <span class="pcoded-micon"><i class="fa fa-truck"></i></span>
                    <span class="pcoded-mtext">Demage Stock</span>
                </a>
            </li>

            <li class="mobile-profile @if ($_SERVER['REQUEST_URI'] == '/profile') active @endif">
                <a href="#">
                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                    <span class="pcoded-mtext">Profile</span>
                </a>
            </li>
            <li class="mobile-profile">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="pcoded-micon"><i class="feather icon-log-out"></i></span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </form>
            </li>
        </ul>

    </div>
</nav>
