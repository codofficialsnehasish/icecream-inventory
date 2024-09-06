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
                            <h6 class="page-title">{{ $title }}</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('shops.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form class="custom-validation" action="{{ route('shops.update',$shop->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Edit {{ $title }}
                                </div>
                                <div class="card-body row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Owner Name</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Shop Owner Name" value="{{ $shop->owner_name }}" name="owner_name">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Shop Name</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Shop Name" value="{{ $shop->shop_name }}" name="shop_name">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Whatsapp Number</label>
                                        <div>
                                            <input data-parsley-type="text" type="number" class="form-control" required placeholder="Enter Whatsapp Number" value="{{ $shop->whatsapp_number }}" name="whatsapp_number">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Address</label>
                                        <div>
                                            <textarea class="form-control" required placeholder="Enter Full Address" name="address">{{ $shop->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Freezer</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Freezer" value="{{ $shop->freezer }}" name="freezer">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Freezer Capacity</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Freezer Capacity" value="{{ $shop->freezer_capacity }}" name="freezer_capacity">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Freezer Serial Number</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Freezer Serial Number" value="{{ $shop->freezer_serial_number }}" name="freezer_serial_number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Publish
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Visiblity</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="customRadioInline1" name="is_visible" class="form-check-input" value="1" {{ check_uncheck($shop->is_visible, 1) }}>
                                            <label class="form-check-label" for="customRadioInline1">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="customRadioInline2" name="is_visible" class="form-check-input" value="0" {{ check_uncheck($shop->is_visible, 0) }}>
                                            <label class="form-check-label" for="customRadioInline2">Hide</label>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Save & Next
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect">
                                                Cancel
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
            </div>
            <!-- container-fluid -->
        </div>
    </div>

@include("admin/dash/footer")