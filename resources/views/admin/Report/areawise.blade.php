<!-- adding header -->
@include('admin.dash.header')
<!-- end header -->

<!-- ========== Left Sidebar Start =========== -->
@include('admin.dash.left_side_bar')
<!-- Left Sidebar End -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Area Wise Statement</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Area Wise Statement</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="">
                                <h2>Area Wise Statement</h2>

                                <div class="mb-3">
                                    <label for="areaSelect" class="form-label">Select Area:</label>
                                    <select class="form-select" id="areaSelect">
                                        <option selected disabled>Select an area...</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->area_id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Summary</h3>
                                        <ul>
                                            <li>Total Policies Sold Today: {{ $totalSellToday }}</li>
                                            <li>Total Policies Sold This Month: {{ $totalSellMonthly }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div id="areaDetails" style="display: none;">
                                                    <h4>Area Details</h4>
                                                    <div id="areaDetailsContent"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="customersContent"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <th>Total Customers</th>
                                        <th>Total Policies</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach ($areas as $area)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $area->name }}</td>
                                            <td>{{ $area->pincode }}</td>
                                            <td>{{ $area->state }}</td>
                                            <td>{{ $area->district }}</td>
                                            <td>{{ $area->police_station }}</td>
                                            <td>{{ $area->landmark }}</td>
                                            <td>{{ $area->total_customers }}</td>
                                            <td>{{ $area->total_policies }}</td>
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
    </div> <!-- End Page-content -->

    @include('admin.dash.footer')
</div>

<script>
    document.getElementById('areaSelect').addEventListener('change', function() {
        var areaId = this.value;

        fetch(`{{ route('reports.fetchAreaData') }}?area_id=${areaId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    let content = `<strong>Area Details : </strong>${data.name}, ${data.pincode}, ${data.state}, ${data.district}, ${data.police_station}, ${data.landmark}`;
                    let customercontent = `
                        <h5>Customers</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Customer ID</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Total Policies</th>
                                </tr>
                            </thead>
                            <tbody>`;
                    data.customers.forEach(customer => {
                        customercontent += `
                            <tr>
                                <td>${customer.name}</td>
                                <td>${customer.customer_id}</td>
                                <td>${customer.phone}</td>
                                <td>${customer.gender}</td>
                                <td>${customer.status ? 'Active' : 'Inactive'}</td>
                                <td>${customer.policies.length}</td>
                            </tr>`;
                    });
                    customercontent += `</tbody></table>`;

                    document.getElementById('areaDetailsContent').innerHTML = content;
                    document.getElementById('customersContent').innerHTML = customercontent;
                    document.getElementById('areaDetails').style.display = 'block';
                }
            });
    });
</script>
