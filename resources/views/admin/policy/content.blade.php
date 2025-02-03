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
                                    <h6 class="page-title">Policy</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('policy') }}">Policy</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Policy</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{ route('policy.add') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
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
                                                    <th class="text-wrap">Policy Number</th>
                                                    <th class="text-wrap">Policy Type</th>
                                                    <th class="text-wrap">Sum Assured</th>
                                                    <th class="text-wrap">Policy Term</th>
                                                    <th class="text-wrap">Maturity Date</th>
                                                    <th class="text-wrap">Customer Name</th>
                                                    <th class="text-wrap">Nominee Name</th>
                                                    <!-- <th class="text-wrap">Nominee Relationship</th> -->
                                                    <th class="text-wrap">Nominee Contact Number</th>
                                                    <th class="text-wrap">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($policy as $s)
                                                @php $customer = get_customer_by_id($s->customer_id) @endphp
                                                <tr>
                                                    <td>{{$s->policy_no}}</td>
                                                    <td>{{$s->policy_type}}</td>
                                                    <td>{{$s->sum_assured}}</td>
                                                    <td>{{$s->policy_term}}</td>
                                                    <td>{{$s->maturity_date}}</td>
                                                    <td>{{ $customer->name }} ({{$customer->customer_id}})</td>
                                                    <td>{{$s->nominee_name}}</td>
                                                    {{--<td>$s->nominee_relationship</td>--}}
                                                    <td>{{$s->nominee_contact_number}}</td>
                                                    <td>
                                                        <a class="btn btn-success mr-2" href="{{ route('policy.edit', $s->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ route('policy.delete', $s->id) }}"><i class="ti-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
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
