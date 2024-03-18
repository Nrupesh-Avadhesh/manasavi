<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Raw Material</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body my_view_new_he">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-6 col-lg-4">
                            <p class="c-text">Vendor Name : <span class="d-text"> {{ $raw_material_stock->vendor->company_name }} - {{ $raw_material_stock->vendor->first_name }}</span></p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="c-text">Reference No : <span class="d-text"> {{ $raw_material_stock->reference_no }}</span></p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="c-text">Date : <span class="d-text"> {{ $raw_material_stock->date }}</span></p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="c-text">E Way Bill No : <span class="d-text"> {{ $raw_material_stock->e_way_bill_no }}</span></p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="c-text">Payment Mode : <span class="d-text"> {{ $raw_material_stock->payment_mode->name }}</span></p>
                        </div>
                        <div class="col-6 col-lg-4">
                            <p class="c-text">Vehicle No : <span class="d-text"> {{ $raw_material_stock->vehicle_no }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="table-padding table-responsive">
                        <table class="table table-bordered text-left">
                            <thead>
                                <tr>
                                    <th width="3%">S.No.</th>
                                    <th> name</th>
                                    <th>HSN Code</th>
                                    <th>Measure</th>
                                    <th width="100px">Qty</th>
                                    <th width="100px">Rate</th>
                                    <th width="100px">Amount</th>
                                    <th width="100px">Proposs Percentage</th>
                                    <th width="100px">Proposs Amount</th>
                                </tr>
                            </thead>
                            <tbody class="product_list_{{ $re_no }}">
                                @php $qty = $amount = $proposs_amount = 0; @endphp
                                @foreach ($raw_material_stock->raw_material_stock_detail as $key=>$val)
                                    <tr>
                                        <td style="text-align: center;">{{ $key+1 }} </td>
                                        <td>{{ $val->raw_material->name}}</td>
                                        <td style="text-align: center;">{{ $val->raw_material->HSN_code}}</td>
                                        <td style="text-align: center;">{{ $val->raw_material->measures->name}}</td>
                                        <td style=" text-align: right !important; ">{{ $val->quantity }} @php $qty += +$val->quantity @endphp</td>
                                        <td style=" text-align: right !important; ">{{  number_format((float)$val->rate, 2, '.', '') }}</td>
                                        <td style=" text-align: right !important; ">{{  number_format((float)$val->amount, 2, '.', '') }} @php $amount += +$val->amount @endphp</td>
                                        <td style=" text-align: right !important; ">{{  number_format((float)$val->proposs_percentage, 2, '.', '') }}</td>
                                        <td style=" text-align: right !important; ">{{  number_format((float)$val->proposs_amount, 2, '.', '') }} @php $proposs_amount += +$val->proposs_amount @endphp</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th style="text-align: right !important;" colspan="4">Grand Total</th>
                                <th style=" text-align: right !important; ">{{ $qty }}</th>
                                <th style="text-align: right !important;">₹</th>
                                <th style=" text-align: right !important; ">{{  number_format((float)$amount, 2, '.', '') }}</th>
                                <th style="text-align: right !important;">₹</th>
                                <th style=" text-align: right !important; ">{{  number_format((float)$proposs_amount, 2, '.', '') }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-12 col-lg-6">
                            <p class="c-text">Terms of Delivery : <span class="d-text"> {!! nl2br($raw_material_stock->terms_of_delivery) !!}</span></p>
                        </div>
                        <div class="col-12 col-lg-6">
                            <p class="c-text">Description : <span class="d-text"> {!! nl2br($raw_material_stock->description) !!}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_cus" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
