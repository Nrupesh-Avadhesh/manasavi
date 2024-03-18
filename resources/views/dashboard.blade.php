@extends('layouts.app')
@section('title', ' / Dashboard')
@section('header_link')
@endsection
@section('content')
    <div class="row">

        <!-- statustic-card start -->

        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col" >
                            <p class="m-b-5 text-uppercase f-14 das_text" >Total Branch</p>
                            <h4 class="m-b-0 f-20 count col_01a9ac">{{ $data['branch'] }}</h4>
                        </div>
                        <div class="col col-auto text-right text-c-white">
                            <i class="fa fa-bank shadow-lg bg-c-blue p-2 text-white rounded-circle " style="font-size: 20px !important"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5 text-uppercase f-14 das_text">Total Vendors</p>
                            <h4 class="m-b-0 f-20 col_fe9365">{{ $data['vendor'] }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-user shadow-lg f-20 bg-c-yellow p-2 text-white rounded-circle "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5 text-uppercase f-14 das_text">Total Products
                            </p>
                            <h4 class="m-b-0 f-20 col_eb3422">{{ $data['product'] }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-shopping-cart shadow-lg f-20 bg-simple-c-pink p-2 text-white rounded-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5 text-uppercase f-14 das_text">Active Quotations
                            </p>
                            <h4 class="m-b-0 f-20 col_0ac282">{{ $data['quotation'] }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-book shadow-lg f-20 bg-c-green p-2 text-white rounded-circle""></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5 text-uppercase f-14 das_text">Active Requirements</p>
                            <h4 class="m-b-0 f-20 col_0ac282">{{ $data['act_req'] }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-credit-card shadow-lg f-20 bg-simple-c-green p-2 text-white rounded-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5 text-uppercase f-14 das_text">Active Invoices
                            </p>
                            <h4 class="m-b-0 f-20 col_01a9ac">{{ $data['act_inv'] }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-shopping-cart shadow-lg f-20 bg-simple-c-blue p-2 text-white rounded-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card bg-c-white text-black">
                <div class="card-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-b-5 f-14 text-uppercase das_text">Quantity below Par Level</p>
                            <h4 class="m-b-0 f-20 col_fe9365">{{ $data['below_par'] }}</h4>
                        </div>
                        <div class="col col-auto text-right">
                            <i class="feather icon-book shadow-lg f-20 bg-simple-c-yellow p-2 text-white rounded-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ticket and update start -->
        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header das_card_header">
                    <h5>Recent Vendor Invoice</h5>
                    <div class="card-header-right"> </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">{{-- Invoice --}} Code</th>
                                    <th class="text-left">Name</th>
                                    {{-- <th class="text-left">Vendor Invoice</th> --}}
                                    <th class="text-left">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['act_inv_list'] as $val)
                                    <tr>
                                        <td>
                                            <label class="label @if($val->status == 'Add To Stoks') label-success @else label-primary @endif">{{ $val->status }}</label>
                                        </td>
                                        <td>{{ $val->code }}</td>
                                        <td>{{ $val->vendor_data->first_name }} {{ $val->vendor_data->last_name }}</td>
                                        {{-- <td>{{ $val->vendor_invoice_no }}</td> --}}
                                        <td>{{ $val->fill_invoice_date }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center"> No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="#" class=" b-b-primary text-primary">View all Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header das_card_header">
                    <h5>Branch Invoice</h5>
                    <div class="card-header-right"> </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Code</th>
                                    <th class="text-left">Branch Name</th>
                                    <th class="text-left">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['act_bra_inv_list'] as $val)
                                    <tr>
                                        <td>
                                            <label class="label @if($val->bh_status == 'Fill Invoice') label-success @else label-primary @endif">{{ $val->bh_status }}</label>
                                        </td>
                                        <td>{{ $val->code }}</td>
                                        <td>{{ $val->branch_data->name }}</td>
                                        <td>{{ $val->bh_fill_invoice_date }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center"> No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="#" class=" b-b-primary text-primary">View all Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header das_card_header">
                    <h5>Recent Branch Requirements</h5>
                    <div class="card-header-right"> </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Code</th>
                                    <th class="text-left">Branch Name</th>
                                    <th class="text-left">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['act_req_list'] as $val)
                                    <tr>
                                        <td>
                                            <label class="label @if($val->bh_status == 'Generate Invoice') label-success @else label-primary @endif">{{ $val->bh_status }}</label>
                                        </td>
                                        <td>{{ $val->code }}</td>
                                        <td>{{ $val->branch_data->name }}</td>
                                        <td>{{ $val->bh_fill_po_date }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center"> No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="#" class=" b-b-primary text-primary">View all Requirement</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header das_card_header">
                    <h5>Below Par Level</h5>
                    <div class="card-header-right"> </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Minimum Quantity</th>
                                    <th class="text-left">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['below_par_list'] as $val)
                                    <tr>
                                        <td><label class="f-20 fa fa-battery-2 p-2 rounded-circle" style=" color: #ff1700; "></label></td>
                                        <td>{{ $val['name'] }}</td>
                                        <td>{{ $val['min'] }}</td>
                                        <td>{{ $val['qut'] }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center"> No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="#" class=" b-b-primary text-primary">View all
                                Stock</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- latest activity end -->
    </div>
@endsection
@section('footer_script')
@endsection
