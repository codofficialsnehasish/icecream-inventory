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
                                    <h6 class="page-title">Advisor</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('agent') }}">Advisor</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Advisor</li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                        <a href="{{ route('agent.add') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-plus me-2"></i> Add New
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- show data -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-wrap">Sl. No</th>
                                                    <!-- <th>Advisor ID</th> -->
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th class="text-wrap">Father / Husband Name</th>
                                                    <th>DOB</th>
                                                    <th class="text-wrap">Gender</th>
                                                    <th class="text-wrap">Contact No.</th>
                                                    <th class="text-wrap">Address</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php $i = 1 @endphp
                                                @foreach($agent as $s)
                                                <tr>
                                                    <td> {{ $i++ }}</td>
                                                    <!-- <td>{{-- $s->agent_id --}}</td> -->
                                                    <td>
                                                        <img class="rounde-pil" style="width: 70px;height: 70px;border-radius: 50%;object-fit: cover;margin:0 20px 0 0" alt="" src="{{$s->image}}"  height="50px" width="100px" alt=""><br>
                                                        <strong>{{$s->agent_id}}</strong>
                                                    </td>
                                                    <td class="text-wrap">{{$s->name}}</td>
                                                    <td>
                                                        @if($s->father_or_husband == 1) 
                                                        <b>Father's Name : </b>
                                                        @elseif($s->father_or_husband == 0)
                                                        <b>Husband's Name :</b>
                                                        @endif
                                                        <br>
                                                        {{$s->father_or_husband_name}}
                                                    </td>
                                                    <td>{{$s->dob}}</td>
                                                    <td>{{$s->gender}}</td>
                                                    <td>{{$s->phone}}</td>
                                                    <td class="text-wrap">{{$s->address}}</td>
                                                    <td>{!!check_visibility($s->status) !!}
                                                    <td>
                                                        <a class="btn btn-success mr-2" href="{{ route('agent.edit', $s->id) }}" alt="edit"><i class="ti-check-box"></i></a>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{ route('agent.delete', $s->id) }}"><i class="ti-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end show data -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function openTab(tabName) {
                        // Hide all tab content
                        document.querySelectorAll('.tab-content').forEach(tab => {
                            tab.classList.remove('active');
                        });
                        // Show the selected tab content
                        document.getElementById(tabName).classList.add('active');

                        // Highlight the selected tab
                        document.querySelectorAll('.network-tab').forEach(tab => {
                            tab.classList.remove('active');
                        });
                        document.querySelector(`.network-tab[data-target="${tabName}"]`).classList.add('active');
                    }
                </script>

                @include("admin.dash.footer")
