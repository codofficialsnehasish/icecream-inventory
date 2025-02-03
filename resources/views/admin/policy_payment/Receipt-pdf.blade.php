<!-- adding header -->
@include('admin/dash/header')
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include('admin/dash/left_side_bar')
<!-- Left Sidebar End -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">policy-payment</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('policy-payment') }}">policy-payment</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add policy-terms</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('policy-payment') }}" class="btn btn-primary  dropdown-toggle"
                                    aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- register -->
            <div class="account-pages pt-2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-12">
                            <form class="custom-validation" action="{{ route('policy-payment.process') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">
                                                Acknowledgement Receipt
                                            </div>
                                            <div class="card-body">
                                                <div class="row">


                                                        <div class="row align-items-center">
                                                            <div class="col-md-8">
                                                                <h3>
                                                                    <link rel="shortcut icon" href="{{ asset('dashboard_assets/images/bmc-logo.png')}}">
                                                                   <img src="{{ get_icon() }}" alt="logo" height="60" />

                                                               </h3>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="float-end d-none d-md-block">

                                                                    <div class="dropdown">
                                                                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#file" href="">
                                                                            <i class="fas fa-arrow-alt-circle-down me-2"></i> Download
                                                                        </a>

                                                                        {{-- <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" href="">
                                                                            Update
                                                                        </a> --}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>






                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-body">

                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="invoice-title">
                                                                                    <h4 class="float-end font-size-16"><strong>Payment Id #
                                                                                        {{ $policyPaymentMode->id }}</strong></h4>

                                                                                </div>
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <h1>Customer Details</h1>
                                                                                            <p>Name :- {{ $customers->name }}</p>

                                                                                            {{-- {{   $data->full_name }}<br>
                                                                                            {{   $data->ph_number }}<br>
                                                                                            {{   $data->email_id }}
                                                                                            <br> --}}


                                                                                    </div>
                                                                                    <div class="col-6 text-end">
                                                                                        <address>
                                                                                            <strong>Date:-</strong>
                                                                                            {{ $policyPaymentMode->created_at }}<br>

                                                                                        </address>
                                                                                        <div>
                                                                                            <label for=""></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-6 mt-4">
                                                                                        <address>
                                                                                            <strong>Payment Status:</strong><br>
                                                                                            <button type="button" class="btn btn-success rounded-pill waves-effect waves-light">Success</button><br>
                                                                                            {{-- {{   $data->email_id }} --}}
                                                                                        </address>
                                                                                    </div>
                                                                                    {{-- <div class="col-6 mt-4 text-end">
                                                                                        <address>
                                                                                            <strong>Last Update Date:</strong><br>
                                                                                            {{-- {{   $data->date }}<br> --}}
                                                                                            {{-- January 16, 2019<br><br> --}}
                                                                                            {{-- <strong>Report Status:</strong><br>
                                                                                            {{-- @if (  $data->file === NULL) --}}
                                                                                            {{-- <button type="button" class="btn btn-warning rounded-pill waves-effect waves-light">Not Uploaded</button> --}}
                                                                                            {{-- @else --}}
                                                                                            {{-- <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light">Uploaded</button> --}}
                                                                                        {{-- @endif --}}
                                                                                        {{-- </address> --}}
                                                                                    {{-- </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <table class="table">
                                                                            <thead>
                                                                                @foreach ($test as $t)
                                                                              <tr>
                                                                                <th scope="col">{{$t->test}}</th>
                                                                                <th scope="col">First</th>
                                                                                <th scope="col">Last</th>
                                                                                <th scope="col">Handle</th>
                                                                              </tr>
                                                                              @endforeach
                                                                            </thead>
                                                                            <tbody>

                                                                          </table> --}}


                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div>
                                                                                <div class="p-2">
                                                                                    <h3 class="font-size-16"><strong> summary</strong></h3>
                                                                                </div>
                                                                                <div class="">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <td><strong>Policy No</strong></td>
                                                                                                    <td class="text-center"><strong>Customer ID</strong></td>
                                                                                                    <td class="text-center"><strong>Payment Mode </strong>
                                                                                                    </td>
                                                                                                    <td class="text-end"><strong>Amount</strong></td>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>



                                                                                                 <tr>
                                                                                                    <td>{{ $policyPaymentMode->policy_id }}</td>
                                                                                                    <td class="text-center fs-6">{{ $policyPaymentMode->customer_id }}</td>
                                                                                                    <td class="text-center">{{ $policyPaymentMode->payment_mode }}</td>
                                                                                                    <td class="text-end"><i class="fas fa-rupee-sign"></i> {{ $policyPaymentMode->amount }}</td>
                                                                                                </tr>





                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                    <div>
                                                                                        <div class="row">
                                                                                            <div class="col-6">
                                                                                                <h6>Remarks</h6><br>
                                                                                             {{ $policyPaymentMode->remarks}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="d-print-none">
                                                                                        <div class="float-end">
                                                                                            <a href="javascript:window.print()"
                                                                                                class="btn btn-success waves-effect waves-light"><i
                                                                                                    class="fa fa-print"></i></a>
                                                                                            <a href="#"
                                                                                                class="btn btn-primary waves-effect waves-light">Send</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div> <!-- end row -->

                                                                </div>
                                                            </div>
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row -->

                                                    {{-- <button type="button" class="btn btn-primary waves-effect waves-light">Primary</button>
                                                    <button type="button" class="btn btn-secondary waves-effect">Secondary</button>
                                                    <button type="button" class="btn btn-success waves-effect waves-light">Success</button>
                                                    <button type="button" class="btn btn-info waves-effect waves-light">Info</button>
                                                    <button type="button" class="btn btn-warning waves-effect waves-light">Warning</button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light">Danger</button>
                                                    <button type="button" class="btn btn-dark waves-effect waves-light">Dark</button>
                                                    <button type="button" class="btn btn-link waves-effect">Link</button>
                                                    <button type="button" class="btn btn-light waves-effect">Light</button> --}}



                                                    <div class="p-2 ">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>



            <!-- end register -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('admin/dash/footer')
