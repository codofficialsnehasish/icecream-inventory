<!-- adding header -->
@include('admin/dash/header')
<!-- end header -->

<!-- ========== Left Sidebar Start ========== -->
@include('admin/dash/left_side_bar')
<!-- Left Sidebar End -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Area</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Policy Master</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('area') }}">Areas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Area</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('area') }}" class="btn btn-primary  dropdown-toggle"
                                    aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- register -->

            {{-- </div> --}}

            <form class="custom-validatio" action="{{ route('area.process') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Add New Area
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Area Name<span class="text-danger me-2"> *</span></label>

                                            <div>
                                                <input data-parsley-type="text" type="text" class="form-control"
                                                    value="{{ old('name') }}" required placeholder="Enter Area Name"
                                                    name="name" id="name">
                                            </div><span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>

                                        </div><span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pincode<span class="text-danger me-2"> *</span></label>
                                            <div>
                                                <input data-parsley-type="number" type="text" class="form-control"
                                                    value="{{ old('pincode') }}" required placeholder="Enter Pincode"
                                                    name="pincode" id="title">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row ">
                                    <div class="col-6">

                                            <label for="name" class="form-label">State<span class="text-danger me-2"> *</span></label>

                                            <input type="text" class="form-control" name="state"
                                                id="state" placeholder="Enter Your State" required>
                                            <span class="text-danger">
                                                @error('state')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>

                                    </div>
                                    <div class="col-6">

                                            <label for="name" class="form-label">District<span class="text-danger me-2"> *</span></label>

                                            <input type="text" class="form-control" name="district"
                                                id="district" placeholder="Enter District" required>
                                            <span class="text-danger">
                                                @error('district')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>

                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">

                                            <label for="name" class="form-label">Police Station<span class="text-danger me-2"> *</span></label>

                                            <input type="text" class="form-control" name="station"
                                                id="station" placeholder="Enter Your Police station" required>
                                            <span class="text-danger">
                                                @error('station')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>

                                    </div>
                                    <div class="col-6">

                                            <label for="name" class="form-label">Landmark<span class="text-danger me-2"> *</span></label>

                                            <input type="text" class="form-control" name="landmark"
                                                id="landmark" placeholder="Enter landmark" required>
                                            <span class="text-danger">
                                                @error('landmark')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                This field is required
                                            </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3">

                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Publish
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label mb-3 d-flex">Visiblity</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline1" name="is_visible"
                                            class="form-check-input" value="1" checked>
                                        <label class="form-check-label" for="customRadioInline1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="is_visible"
                                            class="form-check-input" value="0">
                                        <label class="form-check-label" for="customRadioInline2">Hide</label>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Save & Publish
                                        </button>
                                        <!-- <button type="reset" class="btn btn-secondary waves-effect">
                                                 Cancel
                                                 </button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </form>



            <!-- end register -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('admin/dash/footer')
