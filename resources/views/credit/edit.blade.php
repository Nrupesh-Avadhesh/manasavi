<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Credit Note</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\CreditNoteController@update', [$credit_note->id]), 'method' => 'PUT', 'id' => 'company_edit_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data' ]) !!}
            <div class="modal-body form_g_mb_0">
                <div class="row">
                    <div class="col-md-3 col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Company: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $credit_note->company->name }}" placeholder="Enter Company." readonly>
                            
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Customer: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $credit_note->customer->company_name }} - {{ $credit_note->customer->first_name }}" placeholder="Enter Customer." readonly>
                            
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Payment Mode: <span class="text-danger">*</span></label>
                            {!! Form::select('payment_mode_id', $payment, $credit_note->payment_mode_id, ['class' => 'form-control js-example-basic-single','placeholder' => 'Select Payment Mode']); !!}
                            <span class="invalid-feedback payment_mode_id_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Credit Note No: </label>
                            <input type="text" class="form-control" value="{{ $credit_note->credit_no }}" placeholder="Enter Credit Note No." readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Invoice No: </label>
                            <input type="text" class="form-control" value="{{ $credit_note->invoice_no }}" placeholder="Enter Invoice No." readonly>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">E Way Bill No: </label>
                            <input type="text" name="e_way_bill_no" value="{{ $credit_note->e_way_bill_no }}" class="form-control" placeholder="Enter E Way Bill No.">
                            <span class="invalid-feedback e_way_bill_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Date: <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ $credit_note->date }}">
                            <span class="invalid-feedback date_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Reference No: </label>
                            <input type="text" name="reference_no" value="{{ $credit_note->reference_no }}" class="form-control" placeholder="Enter Reference No.">
                            <span class="invalid-feedback reference_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Other Reference No: </label>
                            <input type="text" name="other_reference_no" value="{{ $credit_note->other_reference_no }}" class="form-control" placeholder="Enter Other Reference No.">
                            <span class="invalid-feedback other_reference_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Buyers Order No: </label>
                            <input type="text" name="buyers_order_no" value="{{ $credit_note->buyers_order_no }}" class="form-control" placeholder="Enter Buyers Order No.">
                            <span class="invalid-feedback buyers_order_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Dated: </label>
                            <input type="date" name="dated" value="{{ $credit_note->dated }}" class="form-control">
                            <span class="invalid-feedback dated_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Dispatch Doc No: </label>
                            <input type="text" name="dispatch_doc_no" value="{{ $credit_note->dispatch_doc_no }}" class="form-control" placeholder="Enter Dispatch Doc No.">
                            <span class="invalid-feedback dispatch_doc_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    

                    <div class="col-md-3 col-md-4 col-sm-6  col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Dispatched Through: </label>
                            <input type="text" name="dispatched_through" value="{{ $credit_note->dispatched_through }}" class="form-control" placeholder="Enter Dispatched Through.">
                            <span class="invalid-feedback dispatched_through_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Destination: </label>
                            <input type="text" name="destination" value="{{ $credit_note->destination }}" class="form-control" placeholder="Enter Destination.">
                            <span class="invalid-feedback destination_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Status: <span class="text-danger">*</span></label>
                            {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Rejected' => 'Rejected'] , $credit_note->status, ['class' => 'form-control js-example-basic-single']); !!}
                            <span class="invalid-feedback status_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" class="re_no" value="{{ $re_no }}">
                    <div class="col-md-12">
                        <div class="table-padding table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <tr>
                                            <th width="3%">S.No.</th>
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
                                    @foreach ($credit_note->credit_note_detal as $key=>$val)
                                        <tr >
                                            <td>{{ $key+1 }}</td>
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
                                    <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td>&nbsp;</td> </tr>
                                    <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td>&nbsp;</td> </tr>
                                    @foreach ($credit_note->credit_note_tax as $key=>$val)
                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight: bold;">{{$val->tax->name}}</td>
                                        <td>{{$val->tax->percentage}} %</td>
                                        <td>{{$val->amount}}</td>
                                    </tr>
                                    @endforeach
                                    <tr> <td></td> <td></td> <td></td> <td></td> <td style="font-weight: bold;">ROUND OFF</td> <td></td> <td>{{ $credit_note->round }}</td> </tr>
                                    <tr> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td>&nbsp;</td> </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td style="font-weight: bold;">Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight: bold;">{{ $credit_note->total_amount }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Total Pay Amount: <span class="text-danger">*</span></label>
                            {!! Form::number('total_pay_amount', $credit_data[1]['payed'], ['class' => 'form-control total_pay_amount_'.$re_no, 'min'=>'0', 'step'=>'0.01', 'readonly']); !!}
                            <span class="invalid-feedback total_pay_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Credit Amount: <span class="text-danger">*</span></label>
                            {!! Form::number('credit_amount', $credit_note->credit_amount, ['class' => 'form-control credit_amount_'.$re_no, 'min'=>'0', 'max'=>$credit_data[1]['remaining_amount'], 'step'=>'0.01']); !!}
                            <span class="invalid-feedback credit_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Credit Word Amount : <span class="text-danger">*</span></label>
                            <textarea name="credit_word_amount" class="form-control credit_word_amount_{{ $re_no }}" placeholder="Amount in words" cols="30" rows="3" readonly>{{ $credit_note->credit_word_amount }}</textarea>
                            <span class="invalid-feedback credit_word_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 mb-2">
                        <div class="form-group">
                            <label class="form-label">Terms of Delivery	: </label>
                            <textarea name="terms_of_delivery" class="form-control terms_of_delivery_{{ $re_no }}" placeholder="Enter Terms of Delivery" cols="30" rows="3" onInput="handleInput(event)" readonly>{!! $credit_note->terms_of_delivery !!}</textarea>
                            <span class="invalid-feedback terms_of_delivery_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_cus" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                {{-- </form> --}}
            </div>
        {!! Form::close() !!}
    </div>
</div><script>
    $(document).ready(function() {
        re_no = $('.re_no').val();
        $(".js-example-basic-single").select2();
        $(document).on('change', '.credit_amount_'+re_no, function(e){
            code = $(this).val();
            price_in_words(code);
        });
        $(document).on('keyup', '.credit_amount_'+re_no, function(e){
            code = $(this).val();
            price_in_words(code);
        });
    });
    function price_in_words(amount = 0.00) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        $('.credit_word_amount_'+re_no).val(words_string);

    }
</script>