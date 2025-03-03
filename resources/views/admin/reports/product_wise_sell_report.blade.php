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
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-product-wise-sell-report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-4">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-3">
                                        <label class="form-label">Choose Product</label>
                                        <select class="form-control select2" name="product">
                                            <option value selected disabled>Select...</option>
                                            @foreach($products as $product)
                                            @if($product->product_type == 'attribute')
                                                @foreach($product->variations as $variation)
                                                    <option value="{{ $variation->id }}">
                                                        {{ $product->name }} ({{ $variation->lable_name }})
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="{{ $product->id }}">
                                                    {{ $product->name }}
                                                </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-0 col-md-3">
                                        <label class="form-label">Choose Trucks</label>
                                        <select class="form-control select2" name="trucks_id">
                                            <option value selected disabled>Select...</option>
                                            @foreach($trucks as $truck)
                                            <option value="{{ $truck->id }}">{{ $truck->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                </div>
                            </form>
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
                                        <th class="text-wrap">SL. No.</th>
                                        {{-- <th class="text-wrap">Date</th> --}}
                                        <th class="text-wrap">Product</th>
                                        <th class="text-wrap">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $quantity = 0 @endphp
                                    @foreach($items as $item)
                                    @php $quantity += $item->total_quantity @endphp
                                    <tr>
                                        <td class="text-wrap">{{ $loop->iteration }}</td>
                                        {{-- <td class="text-wrap">{{ format_datetime($item->created_at) }}</td> --}}
                                        <td class="text-wrap">{{ $item->product_billing_name }}</td>
                                        <td class="text-wrap">{{-- $item->quantity --}} {{ $item->total_quantity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        {{-- <td></td> --}}
                                        <td><b>Total Quantity :</b></td>
                                        <td>
                                            <b>{{ $quantity }}</b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.dash.footer")