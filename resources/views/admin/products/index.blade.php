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
                        <h6 class="page-title">{{ $title }}</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('products.basic-info-create') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-plus me-2"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-search" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap" style="width:50px;">SL. No.</th>
                                        <th class="text-wrap" style="width:50px;">Category</th>
                                        <th class="text-wrap">Name</th>
                                        <th class="text-wrap">Price</th>
                                        <th class="text-wrap">Stock</th>
                                        <th class="text-wrap">Image</th>
                                        <th class="text-wrap">Visibility</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($proucts as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ get_name('categories',$product->category) }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->total_price }}</td>
                                        <td>
                                            <a class="" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$product->id}}">
                                                @if($product->stock > 0) <b class="text-success"> {{ $product->stock }} In Stock</b>
                                                @else <b class="text-danger"> {{ $product->stock }} Out of Stock</b>
                                                @endif
                                                <i class="fas fa-external-link-alt text-danger"></i>
                                            </a>
                                        </td>
                                        <td><img src="{{ asset(get_product_image($product->id)) }}" alt="" width="60px"></td>
                                        <td>{!! check_visibility(1) !!}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('products.basic-info-edit',$product->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('Are You Sure?')" href="{{ route('products.delete',$product->id) }}"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="staticBackdrop{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Update {{ $product->name }} Stock</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('products.update-product-stock') }}" method="post">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="name">Stock</label>
                                                            <input type="number" class="form-control" name="stock" id="name" placeholder="Enter Stock" required="">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        $(document).ready(function() {
            $('#categoryFilter').on('change', function() {
                var selectedCategory = $(this).val();
                
                $('#datatable tbody tr').each(function() {
                    var rowCategory = $(this).find('td:eq(1)').text().trim(); // Adjust index if category is not in second column
                    
                    if (selectedCategory === "" || rowCategory.includes(selectedCategory)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            
            $('#stockFilter').on('change', function() {
                var selectedStock = $(this).val();
                
                $('#datatable tbody tr').each(function() {
                    var rowStock = $(this).find('td:eq(4)').text().trim(); // Adjust index if category is not in second column
                    
                    if (selectedStock === "" || rowStock.includes(selectedStock)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
    @endsection
    
    @include("admin.dash.footer")