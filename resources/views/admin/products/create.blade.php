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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('products.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form action="{{ route('products.add-basic-info') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#basicinfo" role="tab">
                                            <span class="d-none d-md-block">Basic Information</span>
                                            <span class="d-block d-md-none">
                                                <i class="mdi mdi-home-variant h5"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pricedetails" role="tab">
                                            <span class="d-none d-md-block">Price Details</span>
                                            <span class="d-block d-md-none">
                                                <i class="mdi mdi-account h5"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#inventory" role="tab">
                                            <span class="d-none d-md-block">Inventory</span>
                                            <span class="d-block d-md-none">
                                                <i class="mdi mdi-email h5"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#variations" role="tab">
                                            <span class="d-none d-md-block">Variations</span>
                                            <span class="d-block d-md-none">
                                                <i class="mdi mdi-email h5"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#productimages" role="tab">
                                            <span class="d-none d-md-block">Product Images</span>
                                            <span class="d-block d-md-none">
                                                <i class="mdi mdi-cog h5"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="basicinfo" role="tabpanel">
                                        <div class="card-body row">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <div>
                                                    <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Product Title" name="product_name">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Select Category</label>
                                                <select class="form-control select2" name="category_id">
                                                    <option value selected disabled>Select...</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Product Description</label>
                                                <div>
                                                    <textarea class="editor" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="tab-pane p-3" id="pricedetails" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Price</label>
                                                <input data-parsley-type="text" type="text" class="form-control" required placeholder="" name="product_price" id="product_price_input" value="" onkeyup="calculateTotPrice()">
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Discount Rate</label>
                                                <div id="discount_input_container">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text input-group-text-currency" id="basic-addon-discount-variation">%</span>
                                                        </div>
                                                        <input type="number" name="discount_rate" id="input_discount_rate" aria-describedby="basic-addon-discount-variation" class="form-control form-input" value="" min="0" max="99" placeholder="0" onkeyup="calculateTotPrice()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">GST<small>&nbsp;(Goods & Services Tax)</small></label>
                                                <div id="gst_input_container">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text input-group-text-currency" id="basic-addon-gst">%</span>
                                                        </div>
                                                        <input type="number" name="gst_rate" id="input_gst_rate" aria-describedby="basic-addon-gst" class="form-control form-input" value="" min="0" max="99" placeholder="0" onkeyup="calculateTotPrice()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Total Price</label>
                                                <input data-parsley-type="text" type="text" class="form-control" placeholder="" name="total_price" id="total_price_input" value="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-3" id="inventory" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">SKU</label>
                                                <div>
                                                    <input data-parsley-type="text" type="text" class="form-control" required placeholder="" name="sku">
                                                </div>
                                            </div> 
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Stock</label>
                                                <div>
                                                    <input data-parsley-type="text" type="text" class="form-control" required placeholder="" name="sku">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="tab-pane p-3" id="variations" role="tabpanel">
                                        <button class="btn btn-success">Add Variation</button>
                                    </div>
                                    <div class="tab-pane p-3" id="productimages" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <img class="rounded" alt="200x200" width="200"
                                                    src="{{ asset('dashboard_assets/images/small/img-4.jpg') }}" data-holder-rendered="true">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <img class="rounded" alt="200x200" width="200"
                                                    src="{{ asset('dashboard_assets/images/small/img-4.jpg') }}" data-holder-rendered="true">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <img class="rounded" alt="200x200" width="200"
                                                    src="{{ asset('dashboard_assets/images/small/img-4.jpg') }}" data-holder-rendered="true">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <img class="rounded" alt="200x200" width="200"
                                                    src="{{ asset('dashboard_assets/images/small/img-4.jpg') }}" data-holder-rendered="true">
                                            </div>
                                        </div>
                                        <input type="file" class="filestyle" data-buttonname="btn-secondary">
                                    </div> -->
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
                                        <input type="radio" id="customRadioInline1" name="is_visible" class="form-check-input" value="1" checked>
                                        <label class="form-check-label" for="customRadioInline1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="is_visible" class="form-check-input" value="0">
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
                </div>
            </form>
            </div>
        </div>
    </div>

@include("admin/dash/footer")