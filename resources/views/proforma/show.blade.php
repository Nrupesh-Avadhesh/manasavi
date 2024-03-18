<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Proforma</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body my_view_new_he">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <p class="c-text">
                                {{ $proforma->company->name }}<br>
                                <span class="d-text_inv"> 
                                    {{ $proforma->company->address }} {{ $proforma->company->city }}<br>
                                    GSTIN/UIN : {{ $proforma->company->GST }}<br>
                                    State Name : {{ $proforma->company->state }}, zipcode : {{ $proforma->company->zipcode }}<br>
                                    Email : {{ $proforma->company->email }}
                                </span>
                            </p>
                            <hr>
                        </div>
                        <div class="col-12">
                            <p class="c-text"><span class="d-text_inv"> Party : </span></p>
                            <p class="c-text">
                                {{ $proforma->customer->company_name }}<br>
                                <span class="d-text_inv"> 
                                    {{ $proforma->customer->company_address }} - {{ $proforma->customer->company_pincode }}<br>
                                    GSTIN/UIN : {{ $proforma->customer->gst_number }}<br>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="justify-content-between row w-100">
                                <p class="c-text col-md-6 col-12"><span class="d-text_inv"> Proforma No <br> {{ $proforma->proforma_no }}</span></p>
                                <p class="c-text col-md-6 col-12"><span class="d-text_inv"> e-Way Bill No. <br> {{ $proforma->e_way_bill_no }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"><span class="d-text_inv">Dated <br> {{ $proforma->date }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Delivery Note <br> {{ $proforma->delivery_note }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Mode/Terms of Payment <br> {{ $proforma->payment_mode->name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Reference No. & Date. <br> {{ $proforma->reference_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Other References <br> {{ $proforma->other_reference_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Buyer's Order No. <br> {{ $proforma->buyers_order_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Dated <br> {{ $proforma->dated }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Dispatch Doc No <br> {{ $proforma->dispatch_doc_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Delivery Note Date <br> {{ $proforma->delivery_note_date }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Dispatched through <br> {{ $proforma->dispatched_through }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Destination <br> {{ $proforma->destination }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Bill of Lading/LR-RR No <br> {{ $proforma->bill_of_lading }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> <span class="d-text_inv">Motor Vehicle No <br> {{ $proforma->motor_vehicle_no }}</span></p>
                        </div>
                        <div class="col-md-12">
                            <p class="c-text" style=" max-width: 100%; overflow: auto; display: inline-block; "> <span class="d-text_inv" >Terms of Delivery <br> {!! nl2br($proforma->terms_of_delivery) !!}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-padding table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <tr>
                                        <th width="3%">S.No.</th>
                                        <th> Marks & Nos./ Container No. </th>
                                        <th>No. & Kind of Pkgs. </th>
                                        <th>Description of Goods</th>
                                        <th>HSN / SAC</th>
                                        <th width="100px">Quantity</th>
                                        <th width="150px">Rate</th>
                                        <th width="100px">per</th>
                                        <th width="100px">Amount</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @php $quantity = $total = 0; @endphp
                                @foreach ($proforma->proforma_detal as $key=>$val)
                                    <tr >
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $val->container_no }}</td>
                                        <td>{{ $val->no_and_kind_of_pkgs }}</td>
                                        <td>{{ $val->product->name }}</td>
                                        <td>{{ $val->product->HSN_code }}</td>
                                        <td>{{ $val->quantity}}</td>
                                        @php $quantity += $val->quantity @endphp
                                        <td>{{$val->rate}}</td>
                                        <td>{{$val->per}}</td>
                                        <td>{{$val->amount}}</td>
                                        @php $total += $val->amount @endphp
                                    </tr>
                                @endforeach
                                {{-- <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> </tr>
                                <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> </tr>
                                <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> </tr> --}}
                                @foreach ($proforma->proforma_tax as $key=>$val)
                                <tr >
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$val->tax->name}}</td>
                                    <td>{{$val->tax->percentage}} %</td>
                                    <td>{{$val->amount}}</td>
                                </tr>
                                @endforeach
                                <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td>ROUND OFF</td> <td></td> <td>{{ $proforma->round }}</td> </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $proforma->total_amount }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="c-text"><span class="d-text_inv">Amount Chargeable (in words) : {{ $proforma->word_amount }}</span></p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_cus" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
