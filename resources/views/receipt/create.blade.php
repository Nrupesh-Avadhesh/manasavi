<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Receipt</h5>
            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\ReceiptController@store'), 'method' => 'post', 'files' => true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-body form_g_mb_0">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Company: <span class="text-danger">*</span></label>
                        {!! Form::select('companie_id',$company ,null, ['class' => 'form-control js-example-basic-single companie_data_'.$re_no,'placeholder' => 'Select Company']); !!}
                        <span class="invalid-feedback companie_id_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Customer: <span class="text-danger">*</span></label>
                        <select name="customer_id" class="form-control js-example-basic-single customer_{{ $re_no }} col-sm-12">
                            <option value="">Select Customer</option>
                            @foreach ($customer as $val2)
                                <option value="{{ $val2->id }}">{{ $val2->company_name }} - {{ $val2->first_name }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback customer_id_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Payment Method: <span class="text-danger">*</span></label>
                        {!! Form::select('payment_method',['Cash' => 'Cash', 'Electronics Transfer' => 'Electronics Transfer', 'Cheque' => 'Cheque'], 'Cash', ['class' => 'form-control js-example-basic-single payment_method_'.$re_no,'placeholder' => 'Select Payment Method']); !!}
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
                                    <th>Credit Note No.</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Credit Amount</th>
                                    <th>Remaining Amount</th>
                                    <th>Payble Amount</th>
                                </tr>
                            </thead>
                            <tbody class="product_list_{{ $re_no }}">
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
                        <textarea name="remark" class="form-control" placeholder="Remark" cols="30" rows="5"></textarea>
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
                                <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name.">
                                <span class="invalid-feedback bank_name_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 ACheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Branch: </label>
                                <input type="text" name="branch" class="form-control" placeholder="Enter Branch.">
                                <span class="invalid-feedback branch_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 Cheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Cheque No: </label>
                                <input type="text" name="cheque_no" class="form-control" placeholder="Enter Cheque No.">
                                <span class="invalid-feedback cheque_no_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 NCheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">UTR No: </label>
                                <input type="text" name="utr_no" class="form-control" placeholder="Enter UTR No.">
                                <span class="invalid-feedback utr_no_error error" role="alert">
                                    <strong class="msg"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-2 Cheque" style=" display: none; ">
                            <div class="form-group">
                                <label class="form-label">Cheque Date: </label>
                                <input type="date" name="cheque_date" class="form-control" placeholder="Enter Cheque Date.">
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
        
        $(document).on('change', '.companie_data_'+re_no+', .customer_'+re_no, function(e){
            companie = $('.companie_data_'+re_no+' option').filter(":selected").val();
            customer = $('.customer_'+re_no+' option').filter(":selected").val();
            if(companie && customer){
                $.ajax({
                    type:'post',
                    url:'receipt/invoice_list',
                    data:{'_token':'{{csrf_token()}}', 'companie':companie, 'customer':customer},
                    success: function(result) {
                        console.log(result);
                        // return false;
                        if(result.length == 0){
                            $('.product_list_'+re_no).html('');
                        } else {
                            $('.product_list_'+re_no).html('');
                            var amount = 0;
                            var remaining_amount = 0;
                            var credit_note_amount = 0;
                            $.each(result, function( index, data ) {
                                var html = '';
                                html += '<tr class="row_'+data.id +'_'+re_no+'">'
                                    +'<input type="hidden" name="id[]" value="'+data.id+'">'
                                    +'<td style="text-align: center;">'+index +'</td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="text" name="invoice_no[]"  class="form-control invoice_no_'+re_no+'" value="'+data.invoice_no+'" readonly></div></td>'
                                    +'<td style="text-align: center;">'+ data.credit_note_no +'</td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="date" name="date[]"  class="form-control date_'+re_no+'" value="'+data.date+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" name="amount[]" style="text-align: right;" data-row="'+data.id+'" class="form-control amount_'+data.id+'_'+re_no+' amount_'+re_no+'" value="'+data.amount+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="'+data.id+'" class="form-control credit_note_amount_'+data.id+'_'+re_no+' credit_note_amount_'+re_no+'" value="'+data.credit_note_amount+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" name="remaining_amount[]" style="text-align: right;" data-row="'+data.id+'" class="form-control remaining_amount_'+data.id+'_'+re_no+' remaining_amount_'+re_no+'" value="'+data.remaining_amount+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" name="payble_amount[]" style="text-align: right;" data-row="'+data.id+'" class="form-control payble_amount_'+data.id+'_'+re_no+' payble_amount_'+re_no+'" step="0.01" max="'+data.remaining_amount+'" min="0" value="0.00" ></div></td>'
                                    +'</tr>';
                                $('.product_list_'+re_no).append(html);
                                amount = (parseFloat(amount) + parseFloat(data.amount)).toFixed(2);
                                remaining_amount = (parseFloat(remaining_amount) + parseFloat(data.remaining_amount)).toFixed(2);
                                credit_note_amount = (parseFloat(credit_note_amount) + parseFloat(data.credit_note_amount)).toFixed(2);
                            });
                            var html2 = '';
                                html2 += '<tr class="row_tot'+re_no+'">'
                                    +'<td colspan="4"> </td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="tot" class="form-control amount_tot_'+re_no+' amount_'+re_no+'" value="'+amount+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="tot" class="form-control credit_note_amount_tot_'+re_no+' credit_note_amount_'+re_no+'" value="'+credit_note_amount+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="tot" class="form-control remaining_amount_tot_'+re_no+' remaining_amount_'+re_no+'" value="'+remaining_amount+'" readonly></div></td>'
                                    +'<td style="text-align: center;"><div class="form-group"><input type="number" style="text-align: right;" data-row="tot" class="form-control payble_amount_tot_'+re_no+' step="0.01" min="0" payble_amount_'+re_no+'" value="0.00" readonly></div></td>'
                                    +'</tr>';
                                $('.product_list_'+re_no).append(html2);
                        }
                    }
                });
            } 
            $('.product_list_'+re_no).html('');
        });
        $(document).on('change', '.payble_amount_'+re_no, function(e){
            total();
        });
        $(document).on('keyup', '.payble_amount_'+re_no, function(e){
            total();
        });

        function total(){
            var gproA = 0.00;
            $(".payble_amount_"+re_no).each(function(){
                total_l = $(this).val();
                if(!total_l || total_l == null || total_l == undefined || total_l == 0){
                    total_l = 0;
                }
                gproA += + parseFloat(total_l);
            });
            $('.payble_amount_tot_'+re_no).val((gproA).toFixed(2));
        }

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
