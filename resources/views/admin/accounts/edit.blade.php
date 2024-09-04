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
                                <li class="breadcrumb-item"><a href="{{ route('accounts2.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('accounts.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form class="custom-validation" action="{{ route('accounts.update',$account->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Edit {{ $title }}
                                </div>
                                <div class="card-body row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Date</label>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control" placeholder="dd M, yyyy" name="bill_date"
                                                data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true" required autocomplete="off" value="{{ \Illuminate\Support\Carbon::parse($account->date)->format('d M, Y') }}">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Bill Type</label>
                                        <select class="form-control" name="bill_type" id="bill_type">
                                            <option @if($account->bill_type == 'cash_bill') selected @endif value="cash_bill">Cash Bill</option>
                                            <option @if($account->bill_type == 'tax_bill') selected @endif value="tax_bill">Tax Bill</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" id="bill_number">@if($account->bill_type == 'cash_bill') Memo Number @else Bill Number @endif</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter @if($account->bill_type == 'cash_bill') Memo Number @else Bill Number @endif" name="bill_number" value="{{ $account->bill_no }}" id="bill_number_input">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Total Bill Amount</label>
                                        <div>
                                            <input data-parsley-type="text" type="number" class="form-control" value="{{ $account->bill_amount }}" required placeholder="Enter Total Bill Amount" name="total_bill_amount" step="0.01">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Bill Paid Mode</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="Enter Bill Paid Mode" value="{{ $account->bill_pay_type }}" name="bill_paid_moment" step="0.01">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Bill Paid Amount</label>
                                        <div>
                                            <input data-parsley-type="text" type="number" class="form-control" required placeholder="Enter Freezer" value="{{ $account->bill_pay_amount }}" name="bill_paid_amount">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Extra Recived Value</label>
                                        <div> 
                                            <input data-parsley-type="text" type="number" class="form-control" placeholder="Enter Freezer Capacity" value="{{ $account->extra_recived_value }}" name="extra_value" step="0.01">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Sortage Value</label>
                                        <div>
                                            <input data-parsley-type="text" type="number" class="form-control" placeholder="Enter Freezer Serial Number" value="{{ $account->sortage_value }}" name="sortage_value" step="0.01">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Free Goods Recived Value</label>
                                        <div>
                                            <input data-parsley-type="text" type="number" class="form-control" placeholder="Enter Free Goods Recived Value" name="free_goods_recived_value" value="{{ $account->free_goods_recived_value }}" step="0.01">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Remarks</label>
                                        <div>
                                            <textarea class="form-control" placeholder="Enter Remarks" name="remarks">{{ $account->remarks }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-0 d-flex justify-content-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </form>
            </div>
            <!-- container-fluid -->
        </div>
    </div>
@section('script')
<script>
    $('#bill_type').on('change',function(){
        console.log('ok');
        if($(this).val() == 'cash_bill'){
            $('#bill_number').html('Memo Number')
            $('#bill_number_input').attr('placeholder', 'Enter Memo Number');
        }

        if($(this).val() == 'tax_bill'){
            $('#bill_number').html('Bill Number')
            $('#bill_number_input').attr('placeholder', 'Enter Bill Number');
        }
    });
</script>
@endsection
@include("admin/dash/footer")