<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

    <!-- ========== Left Sidebar Start ========== -->
    @include("admin/dash/left_side_bar")
    <!-- Left Sidebar End -->     
    <style>
        .btn-img-delete {
            width: 24px;
            height: 24px;
            line-height: 24px;
            text-align: center;
            /* display: block; */
            position: absolute;
            /* right: 8px; */
            /* top: 8px; */
            border-radius: 100%;
            background-color: #f86969;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }
    </style>

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
                <form action="{{ route('products.product-images-edit-process') }}" method="post" enctype="multipart/form-data">
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
                                    <div class="tab-pane active p-3" id="productimages" role="tabpanel">
                                        <div class="row" id="imageContainer">
                                            @foreach($product_images as $image)
                                            <div class="col-md-4 mb-3">
                                                <img class="rounded img-thumbnail" alt="200x200" width="200" src="{{ asset($image->images) }}" data-holder-rendered="true">
                                                <a href="{{ route('products.delete-product-image',$image->id) }}" class="btn-img-delete btn-delete-product-img" data-file-id="k0nu44xn2d" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Remove this Item">
                                                    <i class="ti-close"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="float-start btn btn-secondary btn-sm waves-effect btn-set-image-main" style="padding-bottom: 0px;padding-top: 0px;padding-right: 4px;padding-left: 4px;">Main</a>
                                            </div>
                                            @endforeach
                                        </div>
                                        <input type="file" name="product_images[]" id="fileInput" multiple="multiple" class="filestyle" data-buttonname="btn-secondary">
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