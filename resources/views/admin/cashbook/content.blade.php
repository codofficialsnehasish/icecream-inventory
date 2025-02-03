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
                        <h6 class="page-title">Transction</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Daily Cashbook</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Transction</li>
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
                                        <th>Policy No</th>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($policyPaymentModes as $s)
                                    <tr>
                                        <td> {{ $i++ }}</td>
                                        <td>{{$s->policy_number}}</td>
                                        <td>{{ get_name('customers',$s->customer_id) }}</td>
                                        <td>{{ get_customer_id($s->customer_id) }}</td>
                                        <td>{{$s->amount}}</td>
                                        <td>{{ get_name('payment_modes',$s->payment_mode) }} @if(get_name('payment_modes',$s->payment_mode) == 'Cheque' || get_name('payment_modes',$s->payment_mode) == 'Online') (Ref - {{$s->refference_number}}) @endif</td>
                                        <td>{{ $s->created_at ? $s->created_at->format('d M Y') : '' }}</td>
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

    @include("admin.dash.footer")
