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
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roles') }}">{{ $title }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('roles') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
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
                            <form class="custom-validation" action="{{ route('role.give-permissions', ['roleId' => $role->id]) }}" method="post">
                            @csrf
                            <div class="">
                                <h4 class="mb-3">Permissions Name</h4>
                                {{-- @foreach ($permissions as $item)
                                <div class="form-check form-check-inline">
                                    <input 
                                        class="form-check-input" 
                                        name="permission[]" 
                                        id="{{ $item->name}}" 
                                        type="checkbox" 
                                        value="{{ $item->name}}" 
                                        {{ in_array($item->id, $rolePermissions) ? 'checked': '' }}
                                    />
                                    <label class="form-check-label" for="{{ $item->name}}">{{ $item->name }}</label>
                                </div>
                                @endforeach --}}

                                <div class="row">
                                    @php
                                        $groupedPermissions = $permissions->groupBy('group_name');
                                    @endphp
                                
                                    @foreach($groupedPermissions as $groupName => $permissions)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                <h5 class="mb-0">{{ $groupName }}</h5>
                                                <div class="form-check">
                                                    <input 
                                                        class="form-check-input group-select-all" 
                                                        type="checkbox" 
                                                        id="select_all_{{ Str::slug($groupName) }}"
                                                        data-group="{{ Str::slug($groupName) }}"
                                                    >
                                                    <label class="form-check-label text-white" for="select_all_{{ Str::slug($groupName) }}">
                                                        Select All
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @foreach($permissions as $item)
                                                <div class="form-check mb-2">
                                                    <input 
                                                        class="form-check-input permission-checkbox" 
                                                        name="permission[]" 
                                                        id="perm_{{ $item->id }}" 
                                                        type="checkbox" 
                                                        value="{{  $item->name }}" 
                                                        {{ in_array($item->id, $rolePermissions) ? 'checked' : '' }}
                                                        data-group="{{ Str::slug($groupName) }}"
                                                    />
                                                    <label class="form-check-label" for="perm_{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle group select all functionality
            document.querySelectorAll('.group-select-all').forEach(selectAllCheckbox => {
                const groupName = selectAllCheckbox.dataset.group;
                const checkboxes = document.querySelectorAll(`.permission-checkbox[data-group="${groupName}"]`);
                
                selectAllCheckbox.addEventListener('change', function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
        
                // Update "Select All" checkbox when individual checkboxes change
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                        selectAllCheckbox.indeterminate = !allChecked && Array.from(checkboxes).some(cb => cb.checked);
                    });
                });
        
                // Initialize "Select All" state
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                const someChecked = Array.from(checkboxes).some(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
                if (!allChecked && someChecked) {
                    selectAllCheckbox.indeterminate = true;
                }
            });
        });
    </script>
    @endsection

    @include("admin.dash.footer")