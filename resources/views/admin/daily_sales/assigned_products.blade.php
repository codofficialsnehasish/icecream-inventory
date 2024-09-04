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
                                <a href="{{ route('daily-sales.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
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
                            <a id="btn_print" type="button" value="print" class="btn btn-success mt-3 mb-3" onclick=""><i class="fas fa-print me-3"></i>Print Item List</a>
                            <div id="printableArea" style="width: 100%; box-sizing: border-box;">
                                @php 
                                    $products = get_daily_sales_products($daily_sale->id); 
                                    $groupedProducts = collect($products)->groupBy('category');
                                    $groupedProductsCount = $groupedProducts->count();
                                    $half = ceil($groupedProductsCount / 2);
                                    $groupedProductsLeft = $groupedProducts->slice(0, $half);
                                    $groupedProductsRight = $groupedProducts->slice($half);
                                @endphp
                                <div style="display: flex; justify-content: space-between; width: 100%; box-sizing: border-box;">
                                    <div style="width: 48%; box-sizing: border-box;">
                                        @foreach ($groupedProductsLeft as $category => $items)
                                            <h5 style="margin: 10px 0; font-size: 16px;">Category: {{ get_name('categories', $category) }}</h5>
                                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                                @foreach ($items as $product)
                                                    <li style="margin: 5px 0;">
                                                        <span style="display: inline-block; width: 70%; font-size: 14px;">{{ get_name('products', $product->product) }}</span>
                                                        <span style="display: inline-block; width: 28%; text-align: right; font-size: 14px;">Qty: {{ $product->quantity }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                    <div style="width: 48%; box-sizing: border-box;">
                                        @foreach ($groupedProductsRight as $category => $items)
                                            <h5 style="margin: 10px 0; font-size: 16px;">Category: {{ get_name('categories', $category) }}</h5>
                                            <ul style="list-style-type: none; padding: 0; margin: 0;">
                                                @foreach ($items as $product)
                                                    <li style="margin: 5px 0;">
                                                        <span style="display: inline-block; width: 70%; font-size: 14px;">{{ get_name('products', $product->product) }}</span>
                                                        <span style="display: inline-block; width: 28%; text-align: right; font-size: 14px;">Qty: {{ $product->quantity }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function() {
            $('#btn_print').click(function() {
                var printContents = $('#printableArea').html();
                var originalContents = $('body').html();

                $('body').html(printContents);
                window.print();
                $('body').html(originalContents);
            });
        });
    </script>
    @endsection
    @include("admin.dash.footer")