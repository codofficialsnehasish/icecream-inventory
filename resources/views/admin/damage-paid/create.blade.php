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
                                <li class="breadcrumb-item"><a href="{{ route('damage-paid.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('damage-paid.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form class="custom-validation" action="{{ route('damage-paid.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Add New {{ $title }}
                                </div>
                                <div class="card-body row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Date</label>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control" placeholder="dd M, yyyy" name="date"
                                                data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true" autocomplete="off" required>

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="shop_id">Choose Shop</label>
                                        <select class="form-control select2" name="shop_id" id="shop_id">
                                            <option value selected disabled>Choose Shop ...</option>
                                            @foreach($shops as $shop)
                                            <option value="{{ $shop->id }}">{{ $shop->shop_name }} | {{ $shop->owner_name }} | {{ $shop->whatsapp_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Paid Value</label>
                                        <div>
                                            <input data-parsley-type="text" type="number" class="form-control" required placeholder="Enter Paid Value" name="paid_value" step="0.01">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Remarks</label>
                                        <div>
                                            <textarea class="form-control" placeholder="Enter Remarks" name="remarks"></textarea>
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