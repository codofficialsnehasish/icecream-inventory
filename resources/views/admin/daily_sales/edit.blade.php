<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

    <!-- ========== Left Sidebar Start ========== -->
    @include("admin/dash/left_side_bar")
    <!-- Left Sidebar End -->     

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">{{ $title }}</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('daily-sales.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('daily-sales.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form class="custom-validation" id="update-daily-sales" method="post">
                    @csrf
                    <input type="hidden" id="daily-sales-id" value="{{ $daily_sales->id }}"> 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Add New {{ $title }}
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Outing Date</label>
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" class="form-control" placeholder="dd M, yyyy" name="outing_date" id="outing_date"
                                                    data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                                    data-date-autoclose="true" autocomplete="off" value="{{ format_date($daily_sales->outing_date) }}">

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Sales Man</label>
                                            <select class="form-control select2" name="salesman_id" id="salesman_id">
                                                <option value selected disabled>Select...</option>
                                                @foreach($salesmans as $salesman)
                                                <option value="{{ $salesman->id }}" @if($daily_sales->salesman_id == $salesman->id) selected @endif>{{ $salesman->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Truck</label>
                                            <select class="form-control select2" name="truck_id" id="truck_data">
                                                <option value selected disabled>Select...</option>
                                                @foreach($trucks as $truck)
                                                <option value="{{ $truck->id }}" @if($daily_sales->truck_id == $truck->id) selected @endif>{{ $truck->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach($categories as $category)
                                        <div class="d-flex justify-content-between py-3">
                                            <h3>{{ $category->name }}</h3>
                                            <div class="form-check ml-3">
                                                <input type="checkbox" class="form-check-input select-all" id="selectAll-{{ $category->id }}" data-category-id="{{ $category->id }}">
                                                <label class="form-check-label text-danger" for="selectAll-{{ $category->id }}">Select All</label>
                                            </div>
                                        </div>
                                        <div class="row product-list" id="productList-{{ $category->id }}">
                                            @php $products = get_all_products_by_category($category->id) @endphp
                                            @foreach($products as $product)
                                            <div class="col-md-4">
                                                <div class="form-check d-flex justify-content-between align-items-center">
                                                    <input type="checkbox" class="form-check-input product-checkbox" name="products[]" value="{{ $product->id }}" id="product-{{ $product->id }}" data-category-id="{{ $category->id }}">
                                                    <label class="form-label form-check-label" for="product-{{ $product->id }}" style="padding-top:7px;">{{ $product->name }}</label>
                                                    <input type="number" class="form-control w-25 old-stock" value="" name="closing_stock[]" readonly data-input-id="{{ $product->id }}">
                                                    <input type="number" class="form-control w-25 quantity-input" value="" name="quantity[]" data-checkbox-id="product-{{ $product->id }}">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="row justify-content-center mt-5">
                                        <button class="btn btn-primary col-md-2">Submit</button>
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
        function get_product_by_category(category_id){
            $('#productList').html('');
            $.ajax({
                url:"{{route('products.get-products-by-category')}}",
                type:"post",
                data:{ category_id : category_id, _token:"{{ csrf_token() }}" },
                success:function(resp){
                    if (resp.products && Array.isArray(resp.products)) {
                        resp.products.forEach(function(product) {
                            $('#productList').append(`
                                <div class="col-md-4">
                                    <div class="form-check d-flex justify-content-between align-items-center">
                                        <input type="checkbox" class="form-check-input" name="" id="${product.id}">
                                        <label class="form-label" class="form-check-label" for="${product.id}" style="padding-top:7px;">${product.name}</label>
                                        <input type="number" class="form-control w-50" value="1">
                                    </div>
                                </div>
                            `);
                        });
                    }
                }
            });
        }

        $('.select-all').on('change', function() {
            var categoryId = $(this).data('category-id');
            var isChecked = $(this).is(':checked');
            $('.product-checkbox[data-category-id="' + categoryId + '"]').prop('checked', isChecked);
        });


        $(document).ready(function() {
            $.ajax({
                url:"{{ route('daily-sales.get-asign-products') }}",
                type:'POST',
                data:{
                    "daily_sales_id":$('#daily-sales-id').val(),
                    "_token":"{{ csrf_token() }}"
                },
                success:function(resp){
                    $('.product-checkbox').prop('checked', false).prop('disabled', false);
                    $('.quantity-input').val('');
                    $('.old-stock').val('');
                    if (resp) {
                        var jsonData = JSON.parse(resp);
                        $.each(jsonData, function(index, item) {
                            $('input.old-stock[data-input-id="' + item.product + '"]').val(item.closing_stock);
                            $('input.quantity-input[data-checkbox-id="product-' + item.product + '"]').val(item.provided_qty);
                            $('input.product-checkbox#product-' + item.product).prop('checked', true);
                        });
                    }
                }
            });
        });


        $('#update-daily-sales').on('submit', function(event) {
            event.preventDefault();
            const selectedProducts = [];
            $('.product-checkbox:checked').each(function() {
                const checkbox = $(this);
                const productId = checkbox.val();
                const quantityInput = $(`input.quantity-input[data-checkbox-id="product-${productId}"]`);
                const closingStockInput = $(`input.old-stock[data-input-id="${productId}"]`);

                selectedProducts.push({
                    product_id: productId,
                    quantity: quantityInput.val(),
                    closing_stock: closingStockInput.val()
                });
            });
            // console.log(selectedProducts);
            let gourl = "{{ route('daily-sales.update', ':id') }}".replace(':id', $('#daily-sales-id').val());
            $.ajax({
                url: gourl,
                method: 'PUT',
                data: { products: selectedProducts, 
                        outing_date: $('#outing_date').val(), 
                        salesman_id: $('#salesman_id').val(), 
                        truck_id: $('#truck_data').val(), 
                        _token:"{{ csrf_token() }}" 
                    },
                success: function(response) {
                    if(response.status == 1){
                        showToast('success', 'Success', response.massage);
                        $('#store-daily-sales')[0].reset();
                        $('.product-checkbox').prop('checked', false);
                        $('.quantity-input').val('');
                        $('.old-stock').val('');
                        $('#salesman_id').val(null).trigger('change');
                        $('#truck_data').val(null).trigger('change');
                    }else{
                        showToast('error', 'Error', response.massage);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, messages) {
                            showToast('error', 'Error', messages);
                            errorMessages += '<p>' + messages.join('<br>') + '</p>';
                        });
                        // $('#error-container').html(errorMessages);
                        // showToast('error', 'Error', errorMessages);
                    } else {
                        showToast('error', 'Error', 'An unexpected error occurred.');
                    }
                }
            });
        });
    </script>
    @endsection

@include("admin/dash/footer")