<!-- adding header -->
@include("admin.dash.header")
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include("admin.dash.left_side_bar")
<!-- Left Sidebar End -->
<style>
        .product-list {
            list-style-type: none;
            padding: 0;
        }
        .product-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
        }
        .product-name {
            flex: 1;
        }
        .product-quantity {
            width: 100px;
            text-align: right;
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('daily-sales.create') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-wrap">SL No</th>
                                        <th class="text-wrap">Outing Date</th>
                                        <th class="text-wrap">Salesman Name</th>
                                        <th class="text-wrap">Truck</th>
                                        <th class="text-wrap">Products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daily_sales as $daily_sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ format_date($daily_sale->outing_date) }}</td>
                                        <td>{{ get_name('salesmen',$daily_sale->salesman_id) }}</td>
                                        <td>{{ get_name('trucks',$daily_sale->truck_id) }}</td>
                                        <td>
                                            {{--<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$daily_sale->id}}">View Assigned Products</button> --}}
                                            <a class="btn btn-outline-success" href="{{ route('daily-sales.show-assigned-products',$daily_sale->id) }}">View Assigned Products</a>
                                            <a class="btn btn-outline-primary" href="{{ route('daily-sales.show-assigned-products-report',$daily_sale->id) }}">Report</a>
                                        </td>
                                        <td>
                                            {{--<a class="btn btn-primary" href="{{ route('daily-sales.edit',$daily_sale->id) }}" alt="edit"><i class="ti-check-box"></i></a> --}}
                                            <form action="{{ route('daily-sales.destroy', $daily_sale->id) }}" onsubmit="return confirm('Are you sure?')" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit"><i class="ti-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{--<div class="modal fade" id="staticBackdrop{{$daily_sale->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Showing {{ format_date($daily_sale->outing_date) }} Assigned Products</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @php 
                                                        $products = get_daily_sales_products($daily_sale->id); 
                                                        $groupedProducts = collect($products)->groupBy('category');
                                                    @endphp

                                                    @foreach ($groupedProducts as $category => $items)
                                                        <h5>Category: {{ get_name('categories',$category) }}</h5>
                                                        <ul class="product-list">
                                                            @foreach ($items as $product)
                                                                <li class="product-item">
                                                                    <span class="product-name">Product Name : {{ get_name('products', $product->product) }}</span>
                                                                    <span class="product-quantity">Quantity : {{ $product->quantity }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.dash.footer")