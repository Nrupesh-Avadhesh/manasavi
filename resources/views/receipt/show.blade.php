<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Receipt</h5>
            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body form_g_mb_0">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">To: </label>
                       <p>{{ $company->name }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">From: </label>
                        <p>{{ $customer->company_name }} </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Payment Method: </label>
                        <p >{{ $receipt->payment_method }} </p>
                    </div>
                </div>
                <input type="hidden" class="payment_method" value="{{ $receipt->payment_method }}">
                <div class="col-md-12">
                    <div class=" table-responsive">
                        <table class="table table-bordered text-left">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Invoice No.</th>
                                    <th>Receipt Date</th>
                                    <th>Amount</th>
                                    <th>Remaining Amount</th>
                                    <th>Payble Amount</th>
                                </tr>
                            </thead>
                            <tbody class="product_list">
                                <tr class="row_data.id _re_no">
                                    <input type="hidden" name="id[]" value="data.id">
                                    <td style="text-align: center;">1 </td>
                                    <td style="text-align: center;"><div class="form-group"><input type="text" class="form-control invoice_no_re_no" value="{{ $receipt->invoice_no }}" readonly></div></td>
                                    <td style="text-align: center;"><div class="form-group"><input type="date" class="form-control date_re_no" value="{{ $receipt->date }}" readonly></div></td>
                                    <td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="data.id" class="form-control amount_data.id_re_no amount_re_no" value="{{ $receipt->amount }}" readonly></div></td>
                                    <td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="data.id" class="form-control remaining_amount_data.id_re_no remaining_amount_re_no" value="{{ $receipt->remaining_amount }}" readonly></div></td>
                                    <td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="data.id" class="form-control payble_amount_data.id_re_no payble_amount_re_no" step="0.01" max="data.remaining_amount" min="0" readonly value="{{ $receipt->payble_amount }}" ></div></td>
                                </tr>
                                <tr class="row_totre_no">
                                    <td colspan="5"> </td>
                                    <td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="tot" class="form-control payble_amount_tot_re_no step="0.01" min="0" payble_amount_re_no" value="{{ $receipt->payble_amount }}" readonly></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Remark : </label>
                        <textarea name="remark" class="form-control" placeholder="Remark" cols="30" rows="3">{{ $receipt->remark }}</textarea>
                        <span class="invalid-feedback remark_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-2 ACheque" style=" display: none; ">
                    <div class="form-group">
                        <label class="form-label">Bank Name:- <span style="font-weight: 500;">{{ $receipt->bank_name }}</span> </label>
                        
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-2 ACheque" style=" display: none; ">
                    <div class="form-group">
                        <label class="form-label">Branch :- <span style="font-weight: 500;">{{ $receipt->branch }}</span></label>
                        
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-2 Cheque" style=" display: none; ">
                    <div class="form-group">
                        <label class="form-label">Cheque No :- <span style="font-weight: 500;">{{ $receipt->cheque_no }}</span> </label>
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-2 NCheque" style=" display: none; ">
                    <div class="form-group">
                        <label class="form-label">UTR No :- <span style="font-weight: 500;">{{ $receipt->utr_no }}</span> </label>
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-2 Cheque" style=" display: none; ">
                    <div class="form-group">
                        <label class="form-label">Cheque Date :- <span style="font-weight: 500;">{{ $receipt->cheque_date }}</span> </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_cus" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        payment_method();
        function payment_method(){
            pm = $('.payment_method').val();
            console.log(pm);
            console.log(pm == 'Electronics Transfer');
            console.log('Electronics Transfer');
            if(pm == 'Cheque'){
                $(".NCheque").hide();
                $(".ACheque").show();
                $(".Cheque").show();
            } else if(pm == 'Electronics Transfer'){
                $(".Cheque").hide();
                $(".ACheque").show();
                $(".NCheque").show();
            } else {
                $(".ACheque").hide();
                $(".NCheque").hide();
                $(".Cheque").hide();
            }
        }
    });
</script>
