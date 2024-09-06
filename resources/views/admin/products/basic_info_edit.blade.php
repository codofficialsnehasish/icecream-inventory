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
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">{{ $title }}</a></li>
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
                <form action="{{ route('products.add-basic-edit-info') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                @include('admin.products.nav-tabs-edit')
                                <input type="hidden" name="product_id" value="{{ request()->segment(4) }}">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="basicinfo" role="tabpanel">
                                        <div class="card-body row">
                                            <!-- <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <div>
                                                    <input data-parsley-type="text" type="text" class="form-control" value="{{ $product->name }}" required placeholder="Enter Product Title" name="product_name">
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Name</label>
                                                    <div>
                                                        <input data-parsley-type="text" type="text" class="form-control" value="{{ $product->name }}" required placeholder="Enter Product Title" name="product_name">
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Billing Name</label>
                                                    <div>
                                                        <input data-parsley-type="text" type="text" class="form-control" value="{{ $product->billing_name }}" required placeholder="Enter Product Sort Name" name="product_billing_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Select Category</label>
                                                <select class="form-control select2" name="category_id">
                                                    <option value selected disabled>Select...</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($product->category == $category->id) selected @endif>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Product Description</label>
                                                <div>
                                                    <textarea class="editor" name="description">{{ $product->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
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
                                        <input type="radio" id="customRadioInline1" name="is_visible" class="form-check-input" value="1" {{ check_uncheck($product->visibility,1) }}>
                                        <label class="form-check-label" for="customRadioInline1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="is_visible" class="form-check-input" value="0" {{ check_uncheck($product->visibility,0) }}>
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