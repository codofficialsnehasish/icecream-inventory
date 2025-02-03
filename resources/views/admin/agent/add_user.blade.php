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
                        <h6 class="page-title">Advisor</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('agent') }}">Advisor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Advisor</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('agent') }}" class="btn btn-primary  dropdown-toggle"
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
            <div class="account-pages pt-2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-12">
                            <form class="custom-validation" action="{{ route('agent.process') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header bg-primary text-light">
                                                Add Advisor
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="name" class="form-label">Advisor ID</label>
                                                        <input type="number" class="form-control" name="agent_id"  id="customer_id" placeholder="Enter Advisor ID" required>
                                                        <span class="text-danger">@error('customer_id'){{$message}}@enderror</span>
                                                        <div class="invalid-feedback">
                                                            This field is required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="name" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Name" required>
                                                        <span class="text-danger">
                                                            @error('name')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                        <div class="invalid-feedback">
                                                            This field is required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <!-- <label for="fathers_name" class="form-label">Fathers/Husbands Name</label> -->
                                                        <label for="name" class="form-label"><input type="radio" name="father_or_husband" value="1" id="name" required="" checked="">Fathers /</label>
                                                        <label for="names" class="form-label"><input type="radio" name="father_or_husband" value="0" id="names" required=""> Husbands Name</label>
                                                        <input type="text" class="form-control" name="father_or_husbend_name" id="fathers_name" placeholder="Fathers / Husbands Name">
                                                        <div class="invalid-feedback">
                                                            This field is required
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="phone" class="form-label">Contact No.</label>

                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="phone"><i class="fas fa-phone"></i></span>
                                                            <input type="number" class="form-control" name="phone"
                                                                id="phone" aria-describedby="inputGroupPrepend"
                                                                required>
                                                        </div><span class="text-danger">
                                                            @error('phone')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                        <div class="invalid-feedback">
                                                            This field is required
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label for="email" class="form-label">Date of Birth</label>
                                                        <div class="input-group" id="datepicker2">
                                                            <input type="text" class="form-control"
                                                                placeholder="dd M, yyyy" name="dob"
                                                                data-date-format="dd M, yyyy"
                                                                data-date-container='#datepicker2'
                                                                data-provide="datepicker" data-date-autoclose="true">

                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                        <span class="text-danger">
                                                            @error('dob')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <select class="form-select" id="gender" name="gender" required="">
                                                            <option selected="" disabled="" value="">Choose...</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Transgender">Transgender</option>
                                                        </select><span class="text-danger">
                                                            @error('gender')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                        <div class="invalid-feedback">
                                                            Please select a valid state.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="area_id" class="form-label">Area:</label>
                                                        <select class="form-select" id="area_id" name="area_id" required="">
                                                            <option selected="" disabled="" value="">Choose...</option>
                                                            @foreach ($areas as $area)
                                                                <option value="{{ $area->id }}">{{ $area->name }}
                                                                </option>
                                                            @endforeach
                                                        </select><span class="text-danger">
                                                            @error('area_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                        <div class="invalid-feedback">
                                                            Please select a valid state.
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label for="remarks" class="form-label">Address</label>
                                                        <textarea class="form-control" id="remarks" name="address" rows="4" cols="" placeholder="Address">{{ old('remarks') }}</textarea>
                                                        <div class="invalid-feedback">
                                                            Please enter valid remarks.
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 col-md-2">
                                                        <label class="form-label mb-3 d-flex">Status</label>
                                                        <input class="form-check form-switch" type="checkbox"
                                                            name="status" id="switch3" value="1"
                                                            switch="bool" checked>
                                                        <label class="form-label" for="switch3"
                                                            data-on-label="Active" data-off-label="Inactive"></label>
                                                    </div><span class="text-danger">
                                                        @error('status')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>

                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3 col-md-6">
                                                            <div class="form-group">
                                                                <label class=" fs-6 fw-semibold mb-2">Advisor
                                                                    Image</label>
                                                                    <div id="selectedBanner"></div>
                                                                    <input type="file" class="form-control" id="img" required
                                                                    placeholder="Enter Image" name="image" />
                                                            </div>
                                                        </div>
                                                        <span class="text-danger">
                                                            @error('status')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-0">
                                                        <div>
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light me-1">
                                                                Save & Publish
                                                            </button>
                                                            <button type="reset"
                                                                class="btn btn-secondary waves-effect">
                                                                Reset
                                                            </button>
                                                        </div>
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
                    </div>
                </div>
            </div>



            <!-- end register -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var selDiv = "";
        var storedFiles = [];
        $(document).ready(function() {
            $("#img").on("change", handleFileSelect);
            selDiv = $("#selectedBanner");
        });

        function handleFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            filesArr.forEach(function(f) {
                if (!f.type.match("image.*")) {
                    return;
                }
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html =
                        '<img src="' +
                        e.target.result +
                        "\" data-file='" +
                        f.name +
                        "' class='avatar rounded lg' alt='Category Image' height='200px' width='200px'>";
                    selDiv.html(html);
                };
                reader.readAsDataURL(f);
            });
        }
    </script>
    @include('admin/dash/footer')
