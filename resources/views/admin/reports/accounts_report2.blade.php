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
                        <h6 class="page-title">Reports</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-account-report2') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-10">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- show data -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">SL. No.</th>
                                        <th class="text-wrap">Date</th>
                                        <th class="text-wrap">Bill</th>
                                        <th class="text-wrap">Bill Amount</th>
                                        <th class="text-wrap">Paid Type</th>
                                        <th class="text-wrap">Paid Amount</th>
                                        <th class="text-wrap">Extra Recived Value</th>
                                        <th class="text-wrap">Sortage Value</th>
                                        <th class="text-wrap">Free Goods Value</th>
                                        <th class="text-wrap">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $amount = 0 @endphp
                                    @php $paid_amount = 0 @endphp
                                    @php $extra = 0 @endphp
                                    @php $sortage = 0 @endphp
                                    @php $free_goods = 0 @endphp
                                    @foreach($items as $item)
                                    @php $shop = get_shop_details($item->shop_id) @endphp
                                    @php $amount += $item->bill_amount @endphp
                                    @php $paid_amount += $item->bill_pay_amount @endphp
                                    @php $extra += $item->extra_recived_value @endphp
                                    @php $sortage += $item->sortage_value @endphp
                                    @php $free_goods += $item->free_goods_recived_value @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ format_date($item->date) }}</td>
                                        <td>{{ str_replace(['cash_bill', 'tax_bill'], ['Cash Bill', 'Tax Bill Number'], $item->bill_type) }} - {{ $item->bill_no }}</td>
                                        <td>{{ $item->bill_amount }}</td>
                                        <td>{{ $item->bill_pay_type }}</td>
                                        <td>{{ $item->bill_pay_amount }}</td>
                                        <td>{{ $item->extra_recived_value }}</td>
                                        <td>{{ $item->sortage_value }}</td>
                                        <td>{{ $item->free_goods_recived_value }}</td>
                                        <td>{{ $item->remarks }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-wrap"><b>Total Bill Amount - {{ $amount }}</b></td>
                                        <td></td>
                                        <td class="text-wrap"><b>Total Paid - {{ $paid_amount }}</b></td>
                                        <td class="text-wrap"><b>Total Extra - {{ $extra }}</b></td>
                                        <td class="text-wrap"><b>Total Sortage - {{ $sortage }}</b></td>
                                        <td class="text-wrap"><b>Total Free Goods : {{ $free_goods }}</b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
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