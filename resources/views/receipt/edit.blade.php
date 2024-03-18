<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Receipt</h5>
            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\ReceiptController@update', [$receipt->id]), 'method' => 'PUT', 'id' => 'company_edit_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data' ]) !!}
        <div class="modal-body form_g_mb_0">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">To: <span class="text-danger">*</span></label>
                       <p>{{ $company->name }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">From: <span class="text-danger">*</span></label>
                        <p>{{ $customer->company_name }} </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Payment Method: <span class="text-danger">*</span></label>
                        {!! Form::select('payment_method',['Cash' => 'Cash', 'Electronics Transfer' => 'Electronics Transfer', 'Cheque' => 'Cheque'], $receipt->payment_method, ['class' => 'form-control js-example-basic-single payment_method_'.$re_no,'placeholder' => 'Select Payment Method']); !!}
                        <span class="invalid-feedback payment_method_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <input type="hidden" class="re_no" value="{{ $re_no }}">
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
                            <tbody class="product_list_{{ $re_no }}">
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
                <div class="col-12">
                    <span class="invalid-feedback amount_error error" role="alert">
                        <strong class="msg"> </strong>
                    </span>
                </div>
                <div class="col-12">
                    <span class="invalid-feedback remaining_amount_error error" role="alert">
                        <strong class="msg"> </strong>
                    </span>
                </div>
                <div class="col-12">
                    <span class="invalid-feedback payble_amount_error error" role="alert">
                        <strong class="msg"> </strong>
                    </span>
                </div>
                <div class="col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Remark : </label>
                        <textarea name="remark" class="form-control" placeholder="Remark" cols="30" rows="5">{{ $receipt->remark }}</textarea>
                        <span class="invalid-feedback remark_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-12 mb-2">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-2 ACheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Bank Name: </label>
                                <input type="text" name="bank_name" value="{{ $receipt->bank_name }}" class="form-control" placeholder="Enter Bank Name.">
                                <span class="invalid-feedback bank_name_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 ACheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Branch: </label>
                                <input type="text" name="branch" value="{{ $receipt->branch }}" class="form-control" placeholder="Enter Branch.">
                                <span class="invalid-feedback branch_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 Cheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Cheque No: </label>
                                <input type="text" name="cheque_no" value="{{ $receipt->cheque_no }}" class="form-control" placeholder="Enter Cheque No.">
                                <span class="invalid-feedback cheque_no_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 NCheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">UTR No: </label>
                                <input type="text" name="utr_no" value="{{ $receipt->utr_no }}" class="form-control" placeholder="Enter UTR No.">
                                <span class="invalid-feedback utr_no_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 Cheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Cheque Date: </label>
                                <input type="date" name="cheque_date" value="{{ $receipt->cheque_date }}" class="form-control" placeholder="Enter Cheque Date.">
                                <span class="invalid-feedback cheque_date_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
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
</div>
<script>
    $(document).ready(function() {
        re_no = $('.re_no').val();
        $(".js-example-basic-single").select2();
        payment_method();
        $(document).on('change', '.payment_method_'+re_no , function(e){
            payment_method()
        })

        function payment_method(){
            pm = $('.payment_method_'+re_no+' option').filter(":selected").val();
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
