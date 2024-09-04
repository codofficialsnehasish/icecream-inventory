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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('shops.create') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                        <th class="text-wrap">SL. No.</th>
                                        <th class="text-wrap">Owner Name</th>
                                        <th class="text-wrap">Shop Name</th>
                                        <th class="text-wrap">Whatsapp Number</th>
                                        <th class="text-wrap">Address</th>
                                        <th class="text-wrap">Freezer</th>
                                        <th class="text-wrap">Freezer Capacity</th>
                                        <th class="text-wrap">Freezer Serial Number</th>
                                        <th class="text-wrap">Visibility</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shops as $shop)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $shop->owner_name }}</td>
                                        <td>{{ $shop->shop_name }}</td>
                                        <td>{{ $shop->whatsapp_number }}</td>
                                        <td>{{ $shop->address }}</td>
                                        <td>{{ $shop->freezer }}</td>
                                        <td>{{ $shop->freezer_capacity }}</td>
                                        <td>{{ $shop->freezer_serial_number }}</td>
                                        <td>{!! check_visibility($shop->is_visible) !!}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('shops.edit',$shop->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                            <form action="{{ route('shops.destroy', $shop->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit"><i class="ti-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.dash.footer")