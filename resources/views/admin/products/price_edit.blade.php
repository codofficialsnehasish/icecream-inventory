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
                <form action="{{ route('products.price-edit-process') }}" method="post" enctype="multipart/form-data">
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
                                    <div class="tab-pane active p-3" id="pricedetails" role="tabpanel">
                                        <div class="row">
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">MRP</label>
                                                <input data-parsley-type="text" type="text" class="form-control" required placeholder="" name="product_price" id="product_price_input" value="{{ $product->price }}" onkeyup="calculateTotPrice()">
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Discount Rate</label>
                                                <div id="discount_input_container">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text input-group-text-currency" id="basic-addon-discount-variation">%</span>
                                                        </div>
                                                        <input type="number" name="discount_rate" id="input_discount_rate" aria-describedby="basic-addon-discount-variation" class="form-control form-input" value="{{ $product->discount_rate }}" min="0" max="99" placeholder="0" onkeyup="calculateTotPrice()">
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
                                                        <input type="number" name="gst_rate" id="input_gst_rate" aria-describedby="basic-addon-gst" class="form-control form-input" value="{{ $product->gst_rate }}" min="0" max="99" placeholder="0" onkeyup="calculateTotPrice()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Dealer Price</label>
                                                <input data-parsley-type="text" type="text" class="form-control" placeholder="" name="total_price" id="total_price_input" value="{{ $product->total_price }}" readonly>
                                            </div>

                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">Product Price :</label>
                                                <div class="col-sm-9 mt-2 fw-bold" id="product_price">
                                                {{ $product->product_price }}
                                                </div>
                                            </div>

                                            <div class="row calculated_gst_container">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">CGST ( <span id="cgst">{{ formatGSTRate($product->gst_rate,1) }}</span> ) :</label>
                                                <div class="col-sm-3 mt-2 fw-bold" id="cgst_amount">
                                                {{ get_cgst($product->gst_amount) }}
                                                </div>
                                            </div>

                                            <div class="row calculated_gst_container">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">SGST ( <span id="sgst">{{ formatGSTRate($product->gst_rate,1) }}</span> ) :</label>
                                                <div class="col-sm-3 mt-2 fw-bold" id="sgst_amount">
                                                {{ get_sgst($product->gst_amount) }}
                                                </div>
                                            </div>

                                            <div class="row calculated_gst_container">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">GST ( <span id="gst">{{ formatGSTRate($product->gst_rate) }}</span> ):</label>
                                                <div class="col-sm-3 mt-2 fw-bold" id="gst_amount">
                                                {{ $product->gst_amount }}
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <label for="example-text-input" class="col-sm-3 col-form-label">Discount Price:</label>
                                                <div class="col-sm-9 mt-2 fw-bold" id="discount_price">
                                                {{ $product->discount_price }}
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

    @section('script')
    <script>
        function calculateTotPrice() {
            const price = parseFloat(document.getElementById('product_price_input').value) || 0;
            const discountRate = parseFloat(document.getElementById('input_discount_rate').value) || 0;
            const gstRate = parseFloat(document.getElementById('input_gst_rate').value) || 0;

            const discountAmount = (discountRate / 100) * price;
            const discountedPrice = price - discountAmount;
            const gstAmount = (gstRate / 100) * discountedPrice;
            // const totalPrice = discountedPrice + gstAmount;
            const totalPrice = discountedPrice;

            document.getElementById('total_price_input').value = totalPrice.toFixed(2);
            calculateGSTFromPrice();
        }

        function calculateGSTFromPrice() {
            let price = parseFloat($('#product_price_input').val()) || 0;
            let discountRate = parseFloat($('#input_discount_rate').val()) || 0;
            let discountAmount = (discountRate / 100) * price;
            let totalPrice = price - discountAmount;
            // let totalPrice = parseFloat($("#offer_price").val());
            let gstRate = parseFloat($("#input_gst_rate").val());
            $('#cgst').html(gstRate/2+'%');
            $('#sgst').html(gstRate/2+'%');
            $('#gst').html(gstRate+'%');
            // Calculate the GST amount
            gstRate = gstRate/100;
            const gstAmount = (totalPrice * gstRate) / (1 + gstRate);
            // Calculate the base price
            const basePrice = totalPrice - gstAmount;
            $("#product_price").html(basePrice.toFixed(2));
            $("#cgst_amount").html(gstAmount.toFixed(2)/2);
            $("#sgst_amount").html(gstAmount.toFixed(2)/2);
            $("#gst_amount").html(gstAmount.toFixed(2));
            $("#discount_price").html(discountAmount.toFixed(2));

        }
    </script>
    @endsection

@include("admin/dash/footer")