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
                        <h6 class="page-title">{{ $title }}</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">SL. NO.</th>
                                        <th class="text-wrap">Bill Number</th>
                                        <th class="text-wrap">Salesman</th>
                                        <th class="text-wrap">Shop Details</th>
                                        <th class="text-wrap">Price Details</th>
                                        <th class="text-wrap">Payment</th>
                                        <th class="text-wrap">Bill</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bills as $bill)
                                    @php $shop = get_shop_details($bill->shop_id) @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ route('bills.bill-details',$bill->id) }}">{{ $bill->order_number }}</a></td>
                                        <td class="text-wrap">{{ get_name('salesmen',$bill->salesman_id) }}<br> at {{ format_datetime($bill->created_at) }}</td>
                                        <td>
                                            Name: {{ $shop->shop_name }}<br>
                                            Owner: {{ $shop->owner_name }}<br>
                                            Whatsapp No: {{ $shop->whatsapp_number }}<br>
                                        </td>
                                        <td>
                                            Sub Total: <strong>{{ $bill->sub_total }}</strong><br>
                                            Discount: <strong>{{ $bill->discount }}</strong><br>
                                            Gst: <strong>{{ $bill->gst }}</strong><br>
                                            Grand Total: <strong>{{ $bill->grand_total }}</strong><br>
                                        </td>
                                        <td>
                                            Payment Mode: {{ $bill->payment_mode }}<br>
                                            Status : {{ $bill->is_paid == 1? 'Paid' : 'Unpaid' }}<br>
                                        </td>
                                        <td><a href="{{ route('generate-pdf',$bill->id) }}" class="btn btn-info">View Bill</a></td>
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
    @include("admin.dash.footer")