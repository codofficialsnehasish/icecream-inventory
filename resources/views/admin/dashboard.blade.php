<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin/dash/left_side_bar")
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Dashboard</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Welcome to {{ app_name() }} Dashboard</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('products.index') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/23.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50" style="font-size: 14px !important;">Total Products</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $total_product }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('shops.index') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/24.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Total Dealers</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $total_dealers }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('bills.todays-bill') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/25.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Todays Orders</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $todays_order }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <a href="{{ route('bills.todays-bill') }}">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <div class="float-start mini-stat-img me-4">
                                                    <img src="{{ asset('dashboard_assets/images/services-icon/26.png') }}" alt="">
                                                </div>
                                                <h5 class="font-size-16 text-uppercase text-white-50">Todays Sell</h5>
                                                <h4 class="fw-medium font-size-24" style="color:white;">{{ $todays_sell }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Today's Orders</h4>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">SL.No</th>
                                                        <th class="col">Salesman</th>
                                                        <th class="col">Dealer</th>
                                                        <th class="col">Total Bill Amount</th>
                                                        <th class="col">Products</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($items as $item)
                                                    @php $shop = get_shop_details($item->shop_id) @endphp
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ get_name('salesmen',$item->salesman_id) }}</td>
                                                        <td>
                                                            Name: {{ $shop->shop_name }}<br>
                                                            Owner: {{ $shop->owner_name }}<br>
                                                        </td>
                                                        <td>{{ $item->grand_total }}</td>
                                                        <td><a href="{{ route('bills.bill-details',$item->id) }}" class="btn btn-info btn-sm">Show Billing Products</a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Page-content -->

                
                @include("admin/dash/footer")