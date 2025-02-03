@include('admin.dash.header')
@include('admin.dash.left_side_bar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Area Wise Agent List</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Area Wise Agent List</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2>Area Wise Agent List</h2>

                <div class="mb-3">
                    <label for="areaSelect" class="form-label">Select Area:</label>
                    <select class="form-select" id="areaSelect">
                        <option selected disabled>Select an area...</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if (isset($selectedArea))
                    <h3>Details for {{ $selectedArea->name }}</h3>
                    <h4>Agents</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Agent ID</th>
                                <th>Agent Name</th>
                                <th>Customers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($agents->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center text-danger">No data found...</td>
                                </tr>
                            @else
                                @foreach ($agents as $agent)
                                    <tr>
                                        <td>{{ $agent->agent_id }}</td>
                                        <td>{{ $agent->name }}</td>
                                        <td>
                                            <ul>
                                                 @foreach ($agent->customers as $customer)
                                                 {{-- @foreach ($customers as $customer) --}}
                                                    <li>{{ $customer->name }} - {{ $customer->customer_id }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>


                    {{--<h4>Customers</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Policy Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customers->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center text-danger">No data found...</td>
                                </tr>
                            @else
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <ul>

                                            @foreach ($customer->policies as $policy)
                                                <li>
                                                    Policy No: {{ $policy->id }}<br>
                                                    @if (isset($policyTerms[$policy->id]))
                                                        Premium Amount: {{ $policyTerms[$policy->id]->sum('premium_amount') }}<br>
                                                    @else
                                                        Premium Amount: No premium terms found<br>
                                                    @endif
                                                    Remaining Years: {{ remainingTerm($policy->maturity_date) }}
                                                </li>
                                            @endforeach

                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>--}}
                @endif
            </div>
        </div>
    </div>
    @include('admin.dash.footer')
</div>

<script>
    document.getElementById('areaSelect').addEventListener('change', function() {
        var areaId = this.value;
        window.location.href = `?area_id=${areaId}`;
    });
</script>
