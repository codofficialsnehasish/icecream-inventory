<!-- adding header -->
@include('admin.dash.header')
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include('admin.dash.left_side_bar')
<!-- Left Sidebar End -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Bill Details</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bill Details</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="javascript:void(0);" onclick="history.back();" class="btn btn-primary  dropdown-toggle"
                                    aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Order Details</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Order Number</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->order_number }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Salesman</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $salesman_details->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Salesman Contact</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $salesman_details->phone }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Payment</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">
                                                {{ ucfirst($order->payment_mode) }} ({{ $order->is_paid ? 'Paid' : 'Unpaid' }})
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Shop Name</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $buyer_details->shop_name }}</strong>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Owner Number</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $buyer_details->owner_name }}</strong>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Whatsapp Number</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $buyer_details->whatsapp_number }}</strong>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                            <strong class="font-right">{{ $order->address }}</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-light">Order Items</div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>MRP</th>
                                        <th>Discount</th>
                                        <th>Gst</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($order_items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->mrp }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>{{ $item->gst }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->total_price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-lg-4 float-end">
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">Subtotal</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ $order->sub_total }}</strong></div>
                                </div>
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">GST</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ $order->gst }}</strong></div>
                                </div>
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">Discount</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ $order->discount }}</strong></div>
                                </div>
                                <div class="row mb-0">
                                    <label for="example-text-input" class="col-sm-4 col-form-label float-end">Grand Total</label>
                                    <div class="col-sm-8"><strong class="float-end">{{ $order->grand_total }}</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page-content -->
@include('admin.dash.footer')
