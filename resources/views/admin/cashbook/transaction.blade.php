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
                        <h6 class="page-title">Bank Transfer</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Daily Cashbook</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bank Transfer</li>
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
                        <form action="{{ route('reports.transaction') }}" method="GET">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="payment_mode_name">Select Payment Mode:</label>
                                        <select name="payment_mode_name" id="payment_mode_name" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($paymentModes as $paymentMode)
                                                <option value="{{ $paymentMode->name }}"
                                                    {{ $selectedPaymentModeName == $paymentMode->name ? 'selected' : '' }}>
                                                    {{ $paymentMode->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6"><br>
                                    <button type="submit" class="btn btn-primary">Search</button>
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
                                    <th>Transaction Date</th>>

                                </tr>
                            </thead>

                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($policyPaymentModes as $mode)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $mode->policy_number }}</td>
                                        <td>{{ $mode->customer_name }}</td>
                                        <td>{{ get_customer_id($mode->customer_id) }}</td>
                                        <td>{{ $mode->amount }}</td>
                                        <td>{{ get_name('payment_modes',$mode->payment_mode) }} @if(get_name('payment_modes',$mode->payment_mode) == 'Cheque' || get_name('payment_modes',$mode->payment_mode) == 'Online') (Ref - {{$mode->refference_number}}) @endif</td>

                                        <td>{{ $mode->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tr>
                                <td colspan="2"><strong>Total Amount</strong></td>
                                <td></td>
                                <td></td>
                                <td colspan="5"><strong>₹{{ $totalAmount }}</strong></td>
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
