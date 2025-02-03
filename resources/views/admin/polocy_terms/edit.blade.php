<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("admin/dash/left_side_bar")
            <!-- Left Sidebar End -->

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="page-title">Policy-terms</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('policy-terms.index') }}">Policy-terms</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit policy-terms</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <a href="{{ route('policy-terms.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                        <form class="custom-validation" action="{{ route('policy-terms.update', $policy_term->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header bg-primary text-light">
                                                            Edit policy-terms
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="name" class="form-label">Customer ID</label>

                                                                    <input type="text" class="form-control" value="{{$policy_term->customer_id  }}"   name="customer_id" id="customer_id" placeholder="Enter Customer ID" required>
                                                                    <span class="text-danger">@error('customer_id'){{$message}}@enderror</span>
                                                                    <div class="invalid-feedback">
                                                                        This field is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="phone" class="form-label">Premium Amount</label>

                                                                    <div class="input-group has-validation">
                                                                        <span class="input-group-text" id="premium_amount"><i class="fas fa-phone"></i></span>
                                                                        <input type="number" value="{{$policy_term->premium_amount  }}" class="form-control" name="premium_amount" id="premium_amount" aria-describedby="inputGroupPrepend" required>
                                                                    </div><span class="text-danger">@error('premium_amount'){{$message}}@enderror</span>
                                                                    <div class="invalid-feedback">
                                                                        This field is required
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="Due Date" class="form-label">Due Date</label>
                                                                    <div class="input-group" id="datepicker2">
                                                                        <input type="text" class="form-control" placeholder="dd M, yyyy" name="due_date" value="{{$policy_term->due_date }}"
                                                                            data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                                                            data-date-autoclose="true">

                                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                    </div>
                                                                    <span class="text-danger">@error('due_date'){{$message}}@enderror</span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="gender" class="form-label">Frequency</label>
                                                                    <select class="form-select" id="frequency" name="frequency" required="">
                                                                        <option selected="" disabled=""  value="">Choose...</option>
                                                                        @foreach ($policy as $policy)
                                                                        <option value="{{ $policy->title }}" @if( $policy_term->frequency == $policy->title) selected @endif>{{  $policy_term->frequency }}</option>

                                                                        @endforeach

                                                                    </select><span class="text-danger">@error('frequency'){{$message}}@enderror</span>
                                                                    {{-- @error('gender') is-invalid @enderror" --}}
                                                                    <div class="invalid-feedback">
                                                                        Please select a valid state.
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label class="form-label mb-3 d-flex">Status</label>
                                                                    <input class="form-check form-switch" type="checkbox" name="status" id="switch3" @if ($policy_term->status==1) @endif value="1" switch="bool" checked value="{{  $policy_term->status }}">
                                                                    <label class="form-label" for="switch3" data-on-label="Active" data-off-label="Inactive"></label><span class="text-danger">@error('status'){{$message}}@enderror</span>
                                                                </div>
                                                                <div class="mb-0">
                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                                            Save & Publish
                                                                        </button>
                                                                        <button type="reset" class="btn btn-secondary waves-effect">
                                                                            Reset
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- end register -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                @include("admin/dash/footer")
