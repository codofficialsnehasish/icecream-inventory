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
                        <h6 class="page-title">Policy Frequancy</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Policy Master</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('frequency.policy') }}">Policy Frequancy</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Policy Frequancy</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('frequency.policy') }}" class="btn btn-primary  dropdown-toggle"
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

            <form class="custom-validatio" action="{{ route('frequency.process') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Add New Policy Frequancy
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        {{-- <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <div>
                                                <input data-parsley-type="text" type="text" class="form-control"
                                                    value="{{ old('title') }}" required placeholder="Enter title"
                                                    name="title" id="title"
                                                    >
                                            </div><span class="text-danger">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div> --}}

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>

                                            <!-- <select class="form-select"  name="name" aria-label="Default select example">
                                                <option selected disabled>Open this select menu</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Half-Yearly">Half-Yearly</option>
                                                <option value="Yearly">Yearly</option>
                                            </select> -->
                                            <input data-parsley-type="text" type="text" class="form-control" value="" required placeholder="Enter title" name="name" id="title">

                                        </div><span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
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
