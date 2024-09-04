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
                                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('products.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form action="{{ route('products.variation-edit-process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                @include('admin.products.nav-tabs-edit')
                                <input type="hidden" name="product_id" value="{{ request()->segment(4) }}">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="variations" role="tabpanel">
                                        @if (!empty($variations))
                                        <table class="table table-striped  dt-responsive nowrap dataTable no-footer dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Label</th>
                                                    <th scope="col"></th>
                                                    <th scope="col">Visible</th>
                                                    <th scope="col" style="width: 250px;">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($variations as $variation)
                                                <tr>
                                                    <td style="width: 20%;">{{ $variation->lable_name }}</td>
                                                    <td style="width: 35%;">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-variation-table" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-option{{ $variation->id }}">
                                                            <span id="btn-variation-text-add"><i class="fas fa-plus me-2"></i>Add Option</span>
                                                        </a>
                                                        <a href="javascript:void(0)" id="{{ $variation->id }}" class="btn btn-sm btn-success btn-variation-table" onclick="show_options(this.id)">
                                                            <span id="btn-variation-text-options"><i class="fas fa-bars"></i> View Options</span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php if ($variation->is_visible == 1):
                                                            echo"Yes";
                                                        else:
                                                            echo "No";
                                                        endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('products.variation-delete',$variation->id) }}" class="btn btn-sm btn-success btn-variation-table"><i class="fas fa-trash-alt"></i> Edit</a>
                                                        <a href="{{ route('products.variation-delete',$variation->id) }}" class="btn btn-sm btn-danger btn-variation-table"><i class="fas fa-trash-alt"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        @endif
                                        <button type="button" class="btn btn-primary waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add Variation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Publish
                            </div>
                            <div class="card-body">
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Save & Next
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Add Variation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('products.variation-add') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ request()->segment(4) }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <div>
                                <input type="text" id="input_variation_label" class="form-control form-input input-variation-label" name="label_name" placeholder="English" maxlength="255" required="" data-parsley-type="text">
                            </div>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">Variation Type</label>
                            <div class="">
                                <select name="variation_type" class="form-control" onchange="show_hide_form_option_images(this.value);" required="">
                                    <option value="radio_button">Radio Button (Single Selection)</option>
                                    <option value="dropdown">Dropdown (Single Selection)</option>
                                    <option value="checkbox">Checkbox (Multiple Selection)</option>
                                    <option value="text" checked="">Text</option>
                                    <option value="number">Number</option>
                                </select>
                            </div>
                        </div> -->

                        <!-- <div class="mb-3">
                            <label class="form-label mb-3 d-flex">Option Display Type</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="odt1" name="option_display_type" class="form-check-input" value="text">
                                <label class="form-check-label" for="odt1">Text</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="odt2" name="option_display_type" class="form-check-input" value="image" checked>
                                <label class="form-check-label" for="odt2">Image</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="odt3" name="option_display_type" class="form-check-input" value="color" checked>
                                <label class="form-check-label" for="odt3">Color</label>
                            </div>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label mb-3 d-flex">Use Different Price for Options</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="udpo" name="use_different_price" class="form-check-input" value="1">
                                <label class="form-check-label" for="udpo">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="udpo1" name="use_different_price" class="form-check-input" value="0" checked>
                                <label class="form-check-label" for="udpo1">No</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-3 d-flex">Visiblity</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="visible1" name="is_visible" class="form-check-input" value="1" checked>
                                <label class="form-check-label" for="visible1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="visible2" name="is_visible" class="form-check-input" value="0">
                                <label class="form-check-label" for="visible2">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($variations as $variation)
    <div class="modal fade bs-example-modal-lg-option{{ $variation->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Add Variation Option's</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('products.add-variation-option') }}" method="post">
                @csrf
                <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Option Name</label>
                            <div>
                                <input type="text" class="form-control form-input input-variation-label" name="option_name" placeholder="" maxlength="255" required="" data-parsley-type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <div>
                                    <input type="number" class="form-control form-input input-variation-label" name="option_stock" placeholder="0" maxlength="255" required="" data-parsley-type="text">
                                </div>
                            </div>
                            @if($variation->is_use_different_price == 1)
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <div>
                                    <input type="number" class="form-control form-input input-variation-label" name="option_price" placeholder="" maxlength="255" required="" data-parsley-type="text">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($variations as $variation)
    <div class="modal fade bs-example-modal-lg-view-option{{ $variation->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">All Variation Option's</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Options Names</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="variation_option_data{{ $variation->id }}"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @section('script')
        <script>
            function show_options(variation_id){
                $.ajax({
                    url: "{{ route('products.get-variation-options') }}",
                    type: "post",
                    data: { variation_id : variation_id, _token : '{{ csrf_token() }}' },
                    dataType: "json",
                    success: function (response) { 
                        $('#variation_option_data'+variation_id).html('');
                        response.forEach(function(item) {
                            console.log(item);
                            var row = '<tr>' +
                                '<td>' + item.options_names + '</td>' +
                                '<td>' + item.stock + '</td>' +
                                '<td>' + item.price + '</td>' +
                                '<td><a href="javascript:void(0)" class="btn btn-sm btn-success btn-variation-table mx-3"><i class="fas fa-trash-alt"></i> Edit</a><a href="javascript:void(0)" class="btn btn-sm btn-danger btn-variation-table"><i class="fas fa-trash-alt"></i> Delete</a></td>'+
                                '</tr>';
                            $('#variation_option_data'+variation_id).append(row);
                        });
                        $('.bs-example-modal-lg-view-option'+variation_id).modal('show');
                    }
                });
            }
        </script>
    @endsection
@include("admin/dash/footer")