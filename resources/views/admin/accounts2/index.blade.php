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
                                <a href="{{ route('accounts2.create') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                                        <th class="text-wrap">Date</th>
                                        <th class="text-wrap">Bill</th>
                                        <th class="text-wrap">Bill Amount</th>
                                        <th class="text-wrap">Paid Mode</th>
                                        <th class="text-wrap">Paid Amount</th>
                                        <th class="text-wrap">Extra Recived Value</th>
                                        <th class="text-wrap">Sortage Value</th>
                                        <th class="text-wrap">Free Goods Value</th>
                                        <th class="text-wrap">Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ format_date($account->date) }}</td>
                                        <td>{{ str_replace(['cash_bill', 'tax_bill'], ['Cash Bill', 'Tax Bill Number'], $account->bill_type) }} - {{ $account->bill_no }}</td>
                                        <td>{{ $account->bill_amount }}</td>
                                        <td>{{ $account->bill_pay_type }}</td>
                                        <td>{{ $account->bill_pay_amount }}</td>
                                        <td>{{ $account->extra_recived_value }}</td>
                                        <td>{{ $account->sortage_value }}</td>
                                        <td>{{ $account->free_goods_recived_value }}</td>
                                        <td>{{ $account->remarks }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('accounts2.edit',$account->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                            <form action="{{ route('accounts2.destroy', $account->id) }}" onsubmit="return confirm('Are You Sure?')" method="POST" style="display:inline;">
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