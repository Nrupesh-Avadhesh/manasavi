<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Credit Note</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\CreditNoteController@store'), 'method' => 'post','files'=>true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he' ,'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Company: <span class="text-danger">*</span></label>
                            {!! Form::select('companie_id',$company ,null, ['class' => 'form-control js-example-basic-single companie_data_'.$re_no,'placeholder' => 'Select Company']); !!}
                            <span class="invalid-feedback companie_id_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <input type="hidden" class="re_no" value="{{ $re_no }}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Invoice: <span class="text-danger">*</span></label>
                            {!! Form::select('invoice_no', [] ,null, ['class' => 'form-control  invoice_no_'.$re_no,'placeholder' => 'Select Invoice']); !!}
                            <span class="invalid-feedback invoice_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Date: <span class="text-danger">*</span></label>
                            {!! Form::date('date', date('Y-m-d'), ['class' => 'form-control  date_'.$re_no]); !!}
                            <span class="invalid-feedback date_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Total Amount: <span class="text-danger">*</span></label>
                            {!! Form::number('total_amount', 0.00, ['class' => 'form-control total_amount_'.$re_no, 'min'=>'0', 'step'=>'0.01', 'readonly']); !!}
                            <span class="invalid-feedback total_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Total Pay Amount: <span class="text-danger">*</span></label>
                            {!! Form::number('total_pay_amount', 0.00, ['class' => 'form-control total_pay_amount_'.$re_no, 'min'=>'0', 'step'=>'0.01', 'readonly']); !!}
                            <span class="invalid-feedback total_pay_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Credit Amount: <span class="text-danger">*</span></label>
                            {!! Form::number('credit_amount', 0.00, ['class' => 'form-control credit_amount_'.$re_no, 'min'=>'0', 'step'=>'0.01']); !!}
                            <span class="invalid-feedback credit_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Status: <span class="text-danger">*</span></label>
                            {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Rejected' => 'Rejected'] ,'Pending', ['class' => 'form-control js-example-basic-single']); !!}
                            <span class="invalid-feedback status_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Credit Amount in words: <span class="text-danger">*</span></label>
                            <textarea name="credit_word_amount" class="form-control credit_word_amount_{{ $re_no }}" placeholder="Amount in words" cols="30" rows="3" readonly></textarea>
                            <span class="invalid-feedback credit_word_amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_cus" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
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
                    url:'credit_note/invoice_list',
                    data:{'_token':'{{csrf_token()}}', 'companie':companie, 'customer':customer, 'inv':''},
                    success: function(result) {
                        console.log(result);
                        // return false;
                        if(result.length == 0){
                            $('.invoice_no_'+re_no).html('<option selected="selected" value="">Select Invoice</option>');
                        } else {
                            $('.invoice_no_'+re_no).html('<option selected="selected" value="">Select Invoice</option>');
                            var html = '';
                            $.each(result, function( index, data ) {
                                html += '<option value="'+data.invoice_no+'">'+data.invoice_no+'</option>';
                            });
                            $('.invoice_no_'+re_no).append(html);
                        }
                        $('.total_amount_'+re_no).val(0);
                        $('.credit_amount_'+re_no).attr('max', 0);
                        $('.total_pay_amount_'+re_no).val(0);
                    }
                });
            } 
            $('.invoice_no_'+re_no).html('<option selected="selected" value="">Select Invoice</option>');
            $('.total_amount_'+re_no).val(0);
            $('.credit_amount_'+re_no).attr('max', 0);
            $('.total_pay_amount_'+re_no).val(0);
        });
        $(document).on('change', '.invoice_no_'+re_no, function(e){
            companie = $('.companie_data_'+re_no+' option').filter(":selected").val();
            customer = $('.customer_'+re_no+' option').filter(":selected").val();
            invoice = $('.invoice_no_'+re_no+' option').filter(":selected").val();
            if(companie && customer && invoice){
                $.ajax({
                    type:'post',
                    url:'credit_note/invoice_list',
                    data:{'_token':'{{csrf_token()}}', 'companie':companie, 'customer':customer, 'inv':invoice, },
                    success: function(result) {
                        console.log(result[1]);
                        $('.total_amount_'+re_no).val(result[1].amount);
                        $('.credit_amount_'+re_no).attr('max', result[1].remaining_amount);
                        $('.total_pay_amount_'+re_no).val(result[1].payed);
                    }
                });
            } else {
                $('.total_amount_'+re_no).val(0);
                $('.credit_amount_'+re_no).attr('max', 0);
                $('.total_pay_amount_'+re_no).val(0);
            }
        });
        $(document).on('change', '.credit_amount_'+re_no, function(e){
            code = $(this).val();
            price_in_words(code);
        });
        $(document).on('keyup', '.credit_amount_'+re_no, function(e){
            code = $(this).val();
            price_in_words(code);
        });

        function price_in_words(amount = 0.00) {
            console.log(amount);
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
    });
</script>