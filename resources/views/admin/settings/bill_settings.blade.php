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
                        <h6 class="page-title">Settings</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bill Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <form class="custom-validation" action="{{ route('process-bill-settings') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Bill Settings
                            </div>
                            <div class="card-body row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Company Name</label>
                                    <div>
                                        <input data-parsley-type="text" type="text" value="{{ $bill_setting->company_name }}" class="form-control" required placeholder="Enter Company Name" name="company_name">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Company Address</label>
                                    <div>
                                        <input data-parsley-type="text" type="text" value="{{ $bill_setting->company_address }}" class="form-control" placeholder="Enter Company Address" name="company_address">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Company Phone</label>
                                    <div>
                                        <input data-parsley-type="text" type="text" value="{{ $bill_setting->company_phone }}" class="form-control" placeholder="Enter Company Phone" name="company_phone">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">GSTIN</label>
                                    <div>
                                        <input data-parsley-type="text" type="text" value="{{ $bill_setting->gstin }}" class="form-control" placeholder="Enter GSTIN No." name="gstin">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">FSSAI License</label>
                                    <div>
                                        <input data-parsley-type="text" type="text" value="{{ $bill_setting->fssai_license }}" class="form-control" placeholder="Enter FSSAI License No." name="fssai_license">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label mb-3 d-flex">Tax on Bill</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="gst_show" name="gst_show" class="form-check-input" value="1" {{ check_uncheck($bill_setting->is_tax_show,1) }}>
                                        <label class="form-check-label" for="gst_show">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="gst_hide" name="gst_show" class="form-check-input" value="0" {{ check_uncheck($bill_setting->is_tax_show,0) }}>
                                        <label class="form-check-label" for="gst_hide">Hide</label>
                                    </div>
                                </div>
                                <div class="mb-0 d-flex justify-content-center">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Update Settings
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </form>
            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    
    @include("admin.dash.footer")