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
                        <h6 class="page-title">Month Wise Total Statement</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Daily Cashbook</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Month Wise Total Statement</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('reports.month') }}" method="GET">
                            <!-- show data -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="month">Select Month:</label>
                                        <select name="month" id="month" class="form-control">
                                            <option value="">All</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>
                                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="year">Select Year:</label>
                                        <select name="year" id="year" class="form-control">
                                            <option value="">All</option>
                                            @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                                <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2"><br>
                                    <button type="submit" class="btn btn-success">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-wrap">Sl. No</th>
                                    <th>Policy Number</th>
                                    <th>Customer Name</th>
                                    <th>Customer ID</th>
                                    <th>Amount</th>
                                    <th>Payment Mode</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($policyPaymentModes as $s)
                                    <tr>
                                        <td> {{ $i++ }}</td>
                                        {{-- <td>
                                                            {!!check_visibility($s->visibility) !!}
                                                            {{-- <img src="{{$s->file_path}}" width="50"> --}}
                                        {{-- <img src="{{$s->image}}"  height="50px" width="100px" alt="">
                                                        {{-- </td> --}}
                                        <td>{{ $s->policy_number }}</td>
                                        <td>{{ $s->customer_name }}</td>
                                        <td>{{ get_customer_id($s->customer_id) }}</td>
                                        <td>{{ $s->amount }}</td>
                                        <td>{{ $s->payment_mode }}</td>
                                        <td>{{ \Carbon\Carbon::parse($s->created_at)->format('d M Y') }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tr>
                                <td colspan="2"><strong>Total Amount</strong></td>
                                <td></td>
                                <td></td>
                                <td><strong>{{ $totalAmount }}</strong></td>
                                <td colspan="4"></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- end show data -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<script>
    function openTab(tabName) {
        // Hide all tab content
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        // Show the selected tab content
        document.getElementById(tabName).classList.add('active');

        // Highlight the selected tab
        document.querySelectorAll('.network-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        document.querySelector(`.network-tab[data-target="${tabName}"]`).classList.add('active');
    }
</script>

@include('admin.dash.footer')
