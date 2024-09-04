<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('settings-contents') }}">Site Settings</a></li>
                        {{--<li><a href="javascript: void(0);" class="has-arrow">Roles Permissions</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('roles') }}">Roles</a></li>
                                <li><a href="{{ route('permission') }}">Permission</a></li>
                            </ul>
                        </li>--}}
                    </ul>
                </li>

                {{--<li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('users.add') }}">Add Users</a></li>
                        <li><a href="{{ route('users') }}">All Users</a></li>
                    </ul>
                </li>--}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-dice-d6"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('category.create') }}">Add Category</a></li>
                        <li><a href="{{ route('category.index') }}">All Category</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-ice-cream"></i>
                        <span>Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('products.basic-info-create') }}">Add Products</a></li>
                        <li><a href="{{ route('products.index') }}">All Products</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-shipping-fast"></i>
                        <span>Business</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('trucks.index') }}">Trucks</a></li>
                        <li><a href="{{ route('salesmans.index') }}">Salesman</a></li>
                        <li><a href="{{ route('shops.index') }}">Shops</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-people-carry"></i>
                        <span>Daily Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('daily-sales.create') }}">Assign</a></li>
                        <li><a href="{{ route('daily-sales.index') }}">All Asignments</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-toilet-paper"></i>
                        <span>Billing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('bills.todays-bill') }}">Todays Bills</a></li>
                        <li><a href="{{ route('bills.index') }}">All Bills</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('accounts.index') }}" class="waves-effect">
                        <i class="fas fa-money-check"></i>
                        <span>Manage Accounts 1</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('accounts2.index') }}" class="waves-effect">
                        <i class="fas fa-money-check"></i>
                        <span>Manage Accounts 2</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-pie-chart"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('report.dealer-wise-sales-report') }}">Dealer Wise Sales</a></li>
                        <li><a href="{{ route('report.salesman-wise-sales-report') }}">Salesman Wise Sales</a></li>
                        <li><a href="{{ route('report.trucks-wise-sales-report') }}">Trucks Wise Sales</a></li>
                        <li><a href="{{ route('report.stock-report') }}">Stock Report</a></li>
                        <li><a href="{{ route('report.account-report') }}">Accounts Report 1</a></li>
                        <li><a href="{{ route('report.account-report2') }}">Accounts Report 2</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
