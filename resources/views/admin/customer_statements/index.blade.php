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
                                <div class="col-md-9">
                                    <h6 class="page-title">{{ $title }}</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All {{ $title }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <!-- show data -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('customer-statement.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label">Customer</label>
                                                    <select class="form-control select2" name="customer_id" required>
                                                        <option value selected disabled>Select...</option>
                                                        @foreach($customers as $customer)
                                                        <option value="{{ $customer->id }}" @if($customer_id == $customer->id) selected @endif>{{ $customer->name }} | {{ $customer->customer_id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label class="form-label">Date Range</label>
                                                    <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                        <input type="text" class="form-control" value="{{ $start_date }}" name="start" placeholder="Start Date" autocomplete="off" required/>
                                                        <input type="text" class="form-control" value="{{ $end_date }}" name="end" placeholder="End Date" autocomplete="off" required/>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-5 mt-4">
                                                    <div class="row">
                                                        <button class="btn btn-primary col-md-5" type="submit" name="button" value="get_statement">Get Statement</button>
                                                        <button class="btn btn-success col-md-5" style="margin-left: 20px;" type="submit" name="button" value="download_statement">View & Print Statement</button>
                                                    </div>
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
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Naration</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                    <th>Closing Balance</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($statements as $statement)
                                                <tr>
                                                    <td>{{ formated_date($statement['date']) }}</td>
                                                    <td class="text-wrap">{{ $statement['narration'] }}</td>
                                                    <td>{{ $statement['debit'] }}</td>
                                                    <td>{{ $statement['credit'] }}</td>
                                                    <td>{{ $statement['closing_balance'] }}</td>
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
                </div>
                <!-- End Page-content -->

                @include("admin.dash.footer")
