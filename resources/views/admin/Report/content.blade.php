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
                        <h6 class="page-title">All Area Wise Statement</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Area Wise Statement</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        {{-- <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{ route('policy.add') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div> --}}
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="container">
                <h2>All Area Wise Statement</h2>

                {{-- <form method="GET" action="{{ route('reports.areaWiseStatement') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="from_date">From Date</label>
                            <input type="date" class="form-control" id="from_date" name="from_date"
                                value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="to_date">To Date</label>
                            <input type="date" class="form-control" id="to_date" name="to_date"
                                value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form> --}}

                <h3>Summary</h3>
                <ul>
                    <li>Total Policies Sold Today: {{ $totalSellToday }}</li>
                    <li>Total Policies Sold This Month: {{ $totalSellMonthly }}</li>
                    {{-- <li>Total Policies Sold ({{ request('from_date') }} to {{ request('to_date') }}):
                        {{ $totalSellDatewise }}</li> --}}
                </ul>


            </div>
            <!-- show data -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Area Name</th>
                                        <th>Pincode</th>
                                        <th>State</th>
                                        <th>District</th>
                                        <th>Police Station</th>
                                        <th>Landmark</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Total Customers</th>
                                        <th>Total Policies</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach ($areas as $area)
                                        <tr>
                                            {{-- <td> {{ $i++ }}</td>
                                                    {{-- <td>
                                                        {!!check_visibility($s->visibility) !!}
                                                        {{-- <img src="{{$s->file_path}}" width="50"> --}}
                                            {{-- <img src="{{$s->image}}"  height="50px" width="100px" alt="">
                                                    {{-- </td> --}}

                                            {{-- <td>{{ $area->area_name }}</td>
                                            <td>{{ $area->pincode }}</td>
                                            <td>{{ $area->state }}</td>
                                            <td>{{ $area->district }}</td>
                                            <td>{{ $area->police_station }}</td>
                                            <td>{{ $area->landmark }}</td>

                                            <td>{!! check_status($area->visibility) !!}</td>
                                            <td>{{ $area->customers->count() }}</td>
                                            <td>{{ $area->customers->sum(function($customer) {
                                                return $customer->policies->count();
                                            {{-- }) }}</td> --}}

                                            <td>{{ $i++ }}</td>
                                            <td>{{ $area->area_name }}</td>
                                            <td>{{ $area->pincode }}</td>
                                            <td>{{ $area->state }}</td>
                                            <td>{{ $area->district }}</td>
                                            <td>{{ $area->police_station }}</td>
                                            <td>{{ $area->landmark }}</td>
                                            {{-- <td>{!! check_status($area->visibility) !!}</td> --}}
                                            <td>{{ $area->total_customers }}</td>
                                            <td>{{ $area->total_policies }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -
            <!-- end show data -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('admin.dash.footer')
