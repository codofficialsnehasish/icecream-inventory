{{-- @include('admin.dash.header')
@include('admin.dash.left_side_bar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Daily Cashbook - Customer Basis</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daily Cashbook - Customer Basis</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2>Daily Cashbook - Customer Basis</h2>

                <form method="GET" action="{{ route('reports.dailyCashbook') }}">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="date">Select Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ request('date', $date->toDateString()) }}">
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>

                <h3>Daily Summary for {{ $date->toFormattedDateString() }}</h3>
                <ul>
                    <li>Cash Received: {{ number_format($dailyCashReceived, 2) }}</li>
                    <li>Bank Transfer: {{ number_format($dailyBankTransfer, 2) }}</li>
                    <li>Cash in Hand: {{ number_format($cashInHand, 2) }}</li>
                </ul>

                <h3>Month-wise Total Statement</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Total Cash Received</th>
                            <th>Total Bank Transfer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthTransactions as $transaction)
                            <tr>
                                <td>{{ Carbon\Carbon::parse($transaction->month . '-01')->format('F Y') }}</td>
                                <td>{{ number_format($transaction->total_cash, 2) }}</td>
                                <td>{{ number_format($transaction->total_bank_transfer, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Customer-wise Policy Payment Details</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Total Amount Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            @php
                                 $totalAmountPaid = $customer->policies()->sum('amount');
                            @endphp
                            <tr>
                                <td>{{ $customer->name }}</td>
                                 <td>{{ number_format($totalAmountPaid, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.dash.footer') --}}
@include('admin.dash.header')
@include('admin.dash.left_side_bar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Daily Cashbook</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daily Cashbook</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2>Daily Cashbook</h2>

                <form method="GET" action="{{ route('reports.dailyCashbook') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="date">Select Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ request('date', $date->toDateString()) }}">
                        </div>
                        <div class="col-md-3 ">
                            <label>&nbsp;</label><br>
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </form>

                <h3 class="mt-2 text-success">Statement for {{ $date->toFormattedDateString() }}</h3>
                <ul>
                    <li>Cash Received: {{ number_format($cashReceived, 2) }}</li>
                    <li>Bank Transfer: {{ number_format($bankTransfer, 2) }}</li>
                    <li>Cash in Hand: {{ number_format($cashInHand, 2) }}</li>
                </ul>

                <h3>Month-wise Total Statement</h3>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Total Cash Received</th>
                                    <th>Total Bank Transfer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthTransactions as $transaction)
                                    <tr>
                                        <td>{{ Carbon\Carbon::parse($transaction->month . '-01')->format('F Y') }}</td>
                                        <td>{{ number_format($transaction->total_cash, 2) }}</td>
                                        <td>{{ number_format($transaction->total_bank_transfer, 2) }}</td>
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

@include('admin.dash.footer')
