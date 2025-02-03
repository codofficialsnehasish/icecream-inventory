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
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.generate-sell-report') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-0 col-md-4">
                                        <label class="form-label">Search Using Date</label>
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" name="start_date" placeholder="Start Date" value="" autocomplete="off" />
                                            <input type="text" class="form-control" name="end_date" placeholder="End Date" value="" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Choose Payment Mode</label>
                                        <select class="form-control select2" name="payment_mode">
                                            <option value selected disabled>Select...</option>
                                            @foreach($payments_methods as $payments_method)
                                            <option value="{{ $payments_method }}">{{ $payments_method }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Choose Salesman</label>
                                        <select class="form-control select2" name="salesmen_id">
                                            <option value selected disabled>Select...</option>
                                            @foreach($salesmans as $salesman)
                                            <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-0 col-md-2">
                                        <label class="form-label">Choose Truck</label>
                                        <select class="form-control select2" name="trucks_id">
                                            <option value selected disabled>Select...</option>
                                            @foreach($trucks as $truck)
                                            <option value="{{ $truck->id }}">{{ $truck->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 29px !important;">
                                        <button class="btn btn-primary" type="submit">Search Report</button>
                                    </div>
                                </div>
                            </form>
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
                                        <th class="text-wrap">Payment Mode</th>
                                        <th class="text-wrap">Salesmen</th>
                                        <th class="text-wrap">Truck</th>
                                        <th class="text-wrap">Dealer</th>
                                        <th class="text-wrap">Amount</th>
                                        <th class="text-wrap">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $amount = 0 @endphp
                                    @foreach($sells as $sell)
                                    @php $shop = get_shop_details($sell->shop_id) @endphp
                                    {{-- @php $amount += $sell->grand_total @endphp --}}
                                    
                                    {{-- @php
                                       $amount += ($sell->payment_mode == 'Online&Cash') 
                                                ? ($payment_mode == 'Cash' ? $sell->cash 
                                                : ($payment_mode == 'Online' ? $sell->online : 0))
                                                : ($payment_mode == '' ? $sell->grand_total : 0);
                                    @endphp --}}
                                    @php 
                                        if($sell->payment_mode == 'Online&Cash'){
                                            if($payment_mode == 'Cash'){ $amount += $sell->cash; }
                                            elseif($payment_mode == 'Online'){ $amount += $sell->online; }
                                            else{ $amount += $sell->grand_total; }
                                        }else{
                                            $amount += $sell->grand_total;
                                        }
                                    @endphp

                                    <tr>
                                        <td class="text-wrap">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $sell->payment_mode }}</td>
                                        <td class="text-wrap">{{ get_name('salesmen',$sell->salesman_id) }}</td>
                                        <td class="text-wrap">{{ $sell->truck_name }}</td>
                                        <td>
                                            Name: {{ $shop->shop_name ?? '' }}<br>
                                            Owner: {{ $shop->owner_name ?? '' }}<br>
                                        </td>
                                        <td class="text-wrap">{{-- $sell->grand_total --}} {{-- $sell->payment_mode == 'Online&Cash' ? ($payment_mode == 'Cash' ? $sell->cash : ($payment_mode == 'Online' ? $sell->online : 0)) : $sell->grand_total; --}}
                                            @php 
                                                if($sell->payment_mode == 'Online&Cash'){
                                                    if($payment_mode == 'Cash'){ echo $sell->cash; }
                                                    elseif($payment_mode == 'Online'){ echo $sell->online; }
                                                    else{ echo $sell->grand_total; }
                                                }else{
                                                    echo $sell->grand_total;
                                                }
                                            @endphp
                                        </td>
                                        <td class="text-wrap">{{ format_datetime($sell->created_at) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <b>Total Amount : {{ $amount }}</b><br>
                                            {{-- <b>Total Expences : {{ $expence }}</b><br>
                                            <b>Total Online : {{ $online_sell }}</b><br>
                                            <b>Total Cash : {{ $cash_sell }}</b><br>
                                            <hr>
                                            <b>Total Cash in Hand : {{ $cash_in_hand }}</b> --}}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.dash.footer")