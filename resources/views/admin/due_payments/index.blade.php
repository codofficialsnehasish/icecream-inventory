<!-- adding header -->
@include("admin.dash.header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin.dash.left_side_bar")
            <!-- Left Sidebar End -->


            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Due Payments</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Due Payments</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Due Payments</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-wrap">Sl. No</th>
                                                    <th>Customer ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Policy No.</th>
                                                    <th>Total Payment Recived</th>
                                                    <th>Total Paid</th>
                                                    <th>Due</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach($alldata as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ get_customer_id($data->customer_id) }}</td>
                                                    <td>{{ get_name('customers',$data->customer_id) }}</td>
                                                    <td>{{ $data->policy_number != 0 ?  $data->policy_number : '' }}</td>
                                                    <td>{{ $data->total_credit }}</td>
                                                    <td>{{ $data->total_debit }}</td>
                                                    <td>{{ $data->balance }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end show data -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                @include("admin.dash.footer")
