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
                            <form action="{{ route('report.generate-salesman-wise-sales-report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-7">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" required name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" required name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-3">
                                        <label class="form-label">Choose Salesman</label>
                                        <select class="form-control select2" name="salesman_id">
                                            <option value selected disabled>Select...</option>
                                            @foreach($salesmans as $salesman)
                                            <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                                            @endforeach
                                        </select>
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
                                        <th class="text-wrap">Date</th>
                                        <th class="text-wrap">Salesman</th>
                                        <th class="text-wrap">Dealer</th>
                                        <th class="text-wrap">Total Bill Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $amount = 0 @endphp
                                    @foreach($items as $item)
                                    @php $shop = get_shop_details($item->shop_id) @endphp
                                    @php $amount += $item->grand_total @endphp
                                    <tr>
                                        <td>{{ format_datetime($item->created_at) }}</td>
                                        <td>{{ get_name('salesmen',$item->salesman_id) }}</td>
                                        <td>
                                            Name: {{ $shop->shop_name }}<br>
                                            Owner: {{ $shop->owner_name }}<br>
                                        </td>
                                        <td>{{ $item->grand_total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Amount - {{ $amount }}</b></td>
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