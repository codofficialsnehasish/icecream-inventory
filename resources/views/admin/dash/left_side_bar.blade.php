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
                @canany(['Site Settings','Bill Settings','Role Show','Permission Show'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Site Settings')
                        <li><a href="{{ route('settings-contents') }}">Site Settings</a></li>
                        @endcan
                        @can('Bill Settings')
                        <li><a href="{{ route('bill-settings') }}">Bill Settings</a></li>
                        @endcan
                        @canany(['Role Show','Permission Show'])
                        <li><a href="javascript: void(0);" class="has-arrow">Roles Permissions</a>
                            <ul class="sub-menu" aria-expanded="true">
                                @can('Role Show')
                                <li><a href="{{ route('roles') }}">Roles</a></li>
                                @endcan
                                @can('Permission Show')
                                <li><a href="{{ route('permission') }}">Permission</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                    </ul>
                </li>
                @endcanany

                @canany(['Users Show','Users Create'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Users Create')
                        <li><a href="{{ route('users.add') }}">Add Users</a></li>
                        @endcan
                        @can('Users Show')
                        <li><a href="{{ route('users') }}">All Users</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                @canany(['All Category','Add Category'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-dice-d6"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Add Category')
                        <li><a href="{{ route('category.create') }}">Add Category</a></li>
                        @endcan
                        @can('All Category')
                        <li><a href="{{ route('category.index') }}">All Category</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['All Products','Add Product'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-ice-cream"></i>
                        <span>Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Add Product')
                        <li><a href="{{ route('products.basic-info-create') }}">Add Products</a></li>
                        @endcan
                        @can('All Products')
                        <li><a href="{{ route('products.index') }}">All Products</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['Salesman Show','Shops Show','Trucks Show'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-shipping-fast"></i>
                        <span>Business</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Trucks Show')
                        <li><a href="{{ route('trucks.index') }}">Trucks</a></li>
                        @endcan
                        @can('Salesman Show')
                        <li><a href="{{ route('salesmans.index') }}">Salesman</a></li>
                        @endcan
                        @can('Shops Show')
                        <li><a href="{{ route('shops.index') }}">Shops</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['Make Asignment','All Asignments'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-people-carry"></i>
                        <span>Daily Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Make Asignment')
                        <li><a href="{{ route('daily-sales.create') }}">Assign</a></li>
                        @endcan
                        @can('All Asignments')
                        <li><a href="{{ route('daily-sales.index') }}">All Asignments</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['Todays Bills','All Bills'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-toilet-paper"></i>
                        <span>Billing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Todays Bills')
                        <li><a href="{{ route('bills.todays-bill') }}">Todays Bills</a></li>
                        @endcan
                        @can('All Bills')
                        <li><a href="{{ route('bills.index') }}">All Bills</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @canany(['Expence Category Show','All Expences'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-toilet-paper"></i>
                        <span>Expenses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Expence Category Show')
                        <li><a href="{{ route('expence-category.index') }}">Expense Category</a></li>
                        @endcan
                        @can('All Expences')
                        <li><a href="{{ route('expences.index') }}">All Expenses</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                @can('Accounts Show')
                <li>
                    <a href="{{ route('accounts.index') }}" class="waves-effect">
                        <i class="fas fa-money-check"></i>
                        <span>Manage Accounts 1</span>
                    </a>
                </li>
                @endcan

                @can('Accounts2 Show')
                <li>
                    <a href="{{ route('accounts2.index') }}" class="waves-effect">
                        <i class="fas fa-money-check"></i>
                        <span>Manage Accounts 2</span>
                    </a>
                </li>
                @endcan

                @can('Damage Received Show')
                <li>
                    <a href="{{ route('damage-received.index') }}" class="waves-effect">
                        <i class="fas fa-house-damage"></i>
                        <span>Damage Received</span>
                    </a>
                </li>
                @endcan

                @can('Damage Paid Show')
                <li>
                    <a href="{{ route('damage-paid.index') }}" class="waves-effect">
                        <i class="fab fa-amazon-pay"></i>
                        <span>Damage Paid</span>
                    </a>
                </li>
                @endcan
                
                @canany(['Sell Report','Dealer Wise Sales Report','Stock Report','Salesman Wise Sales Report','Truckes Wise Sales Report','Accounts Report 1','Accounts Report 2','Product Sell Report'])
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-pie-chart"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Sell Report')
                        <li><a href="{{ route('report.sell-report') }}">Sales Report</a></li>
                        @endcan
                        @can('Dealer Wise Sales Report')
                        <li><a href="{{ route('report.dealer-wise-sales-report') }}">Dealer Wise Sales</a></li>
                        @endcan
                        @can('Stock Report')
                        <li><a href="{{ route('report.salesman-wise-sales-report') }}">Salesman Wise Sales</a></li>
                        @endcan
                        @can('Salesman Wise Sales Report')
                        <li><a href="{{ route('report.trucks-wise-sales-report') }}">Trucks Wise Sales</a></li>
                        @endcan
                        @can('Truckes Wise Sales Report')
                        <li><a href="{{ route('report.stock-report') }}">Stock Report</a></li>
                        @endcan
                        @can('Accounts Report 1')
                        <li><a href="{{ route('report.product-wise-sell-report') }}">Product Wise Sell</a></li>
                        @endcan
                        @can('Accounts Report 2')
                        <li><a href="{{ route('report.account-report') }}">Accounts Report 1</a></li>
                        @endcan
                        @can('Product Sell Report')
                        <li><a href="{{ route('report.account-report2') }}">Accounts Report 2</a></li>
                        @endcan
                    </ul>
                </li>
                @endcanany
            </ul>
        </div>
    </div>
</div>
