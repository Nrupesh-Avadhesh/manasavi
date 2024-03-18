<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Proforma</h5>
            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\ProformaController@store'), 'method' => 'post', 'files' => true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data']) !!}
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
                        <label class="form-label">Bank: <span class="text-danger">*</span></label>
                        {!! Form::select('bank_id', [] ,null, ['class' => 'form-control  bank_data_'.$re_no,'placeholder' => 'Select Bank']); !!}
                        <span class="invalid-feedback bank_id_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Proforma No: </label>
                        <input type="text" class="form-control" placeholder="Enter Proforma No." readonly>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">E Way Bill No: </label>
                        <input type="text" name="e_way_bill_no" class="form-control" placeholder="Enter E Way Bill No.">
                        <span class="invalid-feedback e_way_bill_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Date: <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                        <span class="invalid-feedback date_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Delivery Note:</label>
                        <input type="text" name="delivery_note" class="form-control" placeholder="Enter Delivery Note.">
                        <span class="invalid-feedback delivery_note_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Payment Mode: <span class="text-danger">*</span></label>
                        {!! Form::select('payment_mode_id',$payment ,null, ['class' => 'form-control js-example-basic-single','placeholder' => 'Select Payment Mode']); !!}
                        <span class="invalid-feedback payment_mode_id_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Reference No: </label>
                        <input type="text" name="reference_no" class="form-control" placeholder="Enter Reference No.">
                        <span class="invalid-feedback reference_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Other Reference No: </label>
                        <input type="text" name="other_reference_no" class="form-control" placeholder="Enter Other Reference No.">
                        <span class="invalid-feedback other_reference_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Buyers Order No: </label>
                        <input type="text" name="buyers_order_no" class="form-control" placeholder="Enter Buyers Order No.">
                        <span class="invalid-feedback buyers_order_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Dated: </label>
                        <input type="date" name="dated" class="form-control">
                        <span class="invalid-feedback dated_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Dispatch Doc No: </label>
                        <input type="text" name="dispatch_doc_no" class="form-control" placeholder="Enter Dispatch Doc No.">
                        <span class="invalid-feedback dispatch_doc_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Delivery Note Date: </label>
                        <input type="date" name="delivery_note_date" class="form-control">
                        <span class="invalid-feedback delivery_note_date_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Dispatched Through: </label>
                        <input type="text" name="dispatched_through" class="form-control" placeholder="Enter Dispatched Through.">
                        <span class="invalid-feedback dispatched_through_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Destination: </label>
                        <input type="text" name="destination" class="form-control" placeholder="Enter Destination.">
                        <span class="invalid-feedback destination_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Bill Of Lading: <span class="text-danger">*</span></label>
                        <input type="date" name="bill_of_lading" class="form-control">
                        <span class="invalid-feedback bill_of_lading_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Vehicle No: </label>
                        <input type="text" name="vehicle_no" class="form-control" placeholder="Enter Vehicle No.">
                        <span class="invalid-feedback vehicle_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Status: <span class="text-danger">*</span></label>
                        {!! Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Rejected' => 'Rejected'] ,'Pending', ['class' => 'form-control js-example-basic-single']); !!}
                        <span class="invalid-feedback status_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <input type="hidden" class="re_no" value="{{ $re_no }}">
                <div class="col-md-12">
                    <div class="table-padding table-responsive">
                        <table class="table table-bordered text-left">
                            <thead>
                                <tr>
                                    <th width="3%">S.No.</th>
                                    <th> Marks & Nos./ Container No. </th>
                                    <th>No. & Kind of Pkgs. </th>
                                    <th>Description of Goods</th>
                                    <th>HSN / SAC</th>
                                    <th width="100px">Quantity</th>
                                    <th width="100px">Rate</th>
                                    <th width="100px">per</th>
                                    <th width="100px">Amount</th>
                                    <th width="50px"><span class="add btn f-right add_product_{{ $re_no }}" data-bs-toggle="offcanvas" role="button"  aria-controls="offcanvasExampleadd"> <i class="fa fa-plus"></i> </span></th>
                                </tr>
                            </thead>
                            <tbody class="product_list_{{ $re_no }}">
                            </tbody>
                            <tfoot >
                                <tr >
                                    <th style="text-align: right !important;" colspan="5"> Total</th>
                                    <td><input type="number" style="font-weight: bold; text-align: right !important;" name="gqty" class="gqty_{{ $re_no }}" value="0" readonly></td>
                                    <th style="text-align: right !important;"></th>
                                    <th style="text-align: right !important;">₹</th>
                                    <td><input type="number" style="font-weight: bold; text-align: right !important;" name="gproA" class="gproA_{{ $re_no }}" value="0.00" step="0.01" readonly></td>
                                    <td style="text-align: right !important;"><span class="add btn f-right add_tax_{{ $re_no }}" data-bs-toggle="offcanvas" role="button"  aria-controls="offcanvasExampleadd"> <i class="fa fa-plus"></i> </span></td>
                                </tr>
                                <tr class="tax_list_{{ $re_no }}">
                                    <th style="text-align: right !important;" colspan="8">Round of</th>
                                    <td><input type="text" style="font-weight: bold; text-align: right !important;" name="round" class="round_{{ $re_no }}" value="0.00"  readonly></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th style="text-align: right !important;" colspan="5">Grand total</th>
                                    <td></td>
                                    <th style="text-align: right !important;"></th>
                                    <th style="text-align: right !important;">₹</th>
                                    <td><input type="number" style="font-weight: bold; text-align: right !important;" name="gtotal" class="gtotal_{{ $re_no }}" value="0.00" step="0.01" readonly></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Amount in words : <span class="text-danger">*</span></label>
                        <textarea name="word_amount" class="form-control word_amount_{{ $re_no }}" placeholder="Amount in words" cols="30" rows="3" readonly></textarea>
                        <span class="invalid-feedback word_amount_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Terms of Delivery	: </label>
                        <textarea name="terms_of_delivery" class="form-control terms_of_delivery_{{ $re_no }}" placeholder="Enter Terms of Delivery" cols="30" rows="3" onInput="handleInput(event)"></textarea>
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
</div>
<script>
    $(document).ready(function() {
        re_no = $('.re_no').val();
        $(".js-example-basic-single").select2();
        
        $(document).on('change', '.companie_data_'+re_no, function(e){
            companie = $( this ).val();
            if(companie){
                $.ajax({
                    type:'post',
                    url:'proforma/bank_list',
                    data:{'companie':companie,'_token':'{{csrf_token()}}'},
                    success:function(result) {
                        if(result.length == 0){
                            Toastify({text: 'Bank not added', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                            $('.bank_data_'+re_no).html('<option value="">Select Bank</option>');
                        } else {
                            var html = '<option value="">Select Bank</option>';
                            $.each(result, function( index, data ) {
                                html += '<option value="'+data.id+'">'+data.name+'</option>'
                                
                            });
                            $('.bank_data_'+re_no).html(html);
                        }
                    }
                });
            } else {
                $('.bank_data_'+re_no).html('<option value="">Select Bank</option>');
            }
        });
        var no_of_row = 1;
        $(document).on('click', '.remove_product_'+re_no, function(e) {
            row = $(this).data('row');
            $( '.row_'+row +'_'+re_no ).remove();
            total();
        });
        $(document).on('change', '.proforma_id_'+re_no, function(e) {
            row = $(this).data('row');
            hsn = $('.proforma_id_'+re_no+'_'+row+' option:selected').data('hsn');
            $( '.hsn_'+row +'_'+re_no ).val(hsn);
        });
        $(document).on('click', '.add_product_'+re_no, function(e) {
            $.ajax({
                type:'post',
                url:'proforma/product_list',
                data:{'_token':'{{csrf_token()}}'},
                success: function(result) {
                    if(result.length == 0){
                        Toastify({text: 'Product not added', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                    } else {
                        var html = '';
                        html += '<tr class="row_'+no_of_row +'_'+re_no+'">'
                            +'<td style="text-align: center;">'+no_of_row +'</td>'
                            +'<td style="text-align: center;"><input type="text" name="container_no[]"  class="container_no_'+re_no+'"></td>'
                            +'<td style="text-align: center;"><input type="text" name="no_and_kind_of_pkgs[]"  class="no_and_kind_of_pkgs_'+re_no+'"></td>'
                            +'<td><select name="product_id[]" class=" proforma_id_'+re_no+' proforma_id_'+re_no+'_'+no_of_row+' col-sm-12" data-row="'+no_of_row+'" required>'
                                +'<option value="" data-hsn="">Select Product</option>';
                                $.each(result, function( index, data ) {
                                    html +='<option value="'+data.id+'" data-hsn="'+data.HSN_code+'">'+data.name+'</option>';
                                });
                            html +='</select></td>'
                            +'<td style="text-align: center;"><input type="text" name="hsn[]"  class="hsn_'+no_of_row+'_'+re_no+'" readonly></td>'
                            +'<td style="text-align: center;"><input type="number" name="qty[]" style="text-align: right;" min="0" required step="0.001" data-row="'+no_of_row+'" class="qty_'+no_of_row+'_'+re_no+' qty_'+re_no+'" ></td>'
                            +'<td style="text-align: center;"><input type="number" name="rate[]" style="text-align: right;" min="0" step="0.01" data-row="'+no_of_row+'" required class="rate_'+no_of_row+'_'+re_no+' rate_'+re_no+'" ></td>'
                            +'<td style="text-align: center;"><input type="text" name="per[]" style="text-align: right;" value="Mtr" required class="pre_'+no_of_row+'_'+re_no+'" ></td>'
                            +'<td style="text-align: center;"><input type="number" name="Amo[]" style="text-align: right;" required data-row="'+no_of_row+'" class="Amo_'+no_of_row+'_'+re_no+' Amo_'+re_no+'" readonly></td>'
                            +'<td><span class="add btn f-right remove_product_'+re_no+'" data-row="'+no_of_row+'" role="button"  aria-controls="offcanvasExampleadd"> <i class="fa fa-trash"></i> </span></td>'
                            +'</tr>';
                            no_of_row ++;
                        $('.product_list_'+re_no).append(html);
                    }
                }
            });
        });

        var no_of_tax_row = 1;
        $(document).on('click', '.remove_tax_'+re_no, function(e) {
            row = $(this).data('row');
            $( '.tax_row_'+row +'_'+re_no ).remove();
            total();
        });
        $(document).on('change', '.tax_id_'+re_no, function(e) {
            row = $(this).data('row');
            percentage = $('.tax_id_'+re_no+'_'+row+' option:selected').data('percentage');
            $( '.percentage_'+re_no +'_'+row ).val(percentage);
            total();
        });

        $(document).on('click', '.add_tax_'+re_no, function(e) {
            $.ajax({
                type:'post',
                url:'proforma/tax_list',
                data:{'_token':'{{csrf_token()}}'},
                success: function(result) {
                    if(result.length == 0){
                        Toastify({text: 'Tax not added', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                    } else {
                        html = '';
                        html +='<tr class="tax_row_'+no_of_tax_row +'_'+re_no+'">' 
                                +'<td style="text-align: center;" colspan="6"></td>'
                                +'<td>'
                                    +'<select name="tax_id[]" class=" tax_id_'+re_no+' tax_id_'+re_no+'_'+no_of_tax_row+' col-sm-12" data-row="'+no_of_tax_row+'" required>'
                                        +'<option value="" data-hsn="">Select tax</option>';
                                    $.each(result, function( index, data ) {
                                        html +='<option value="'+data.id+'" data-percentage="'+data.percentage+'" >'+data.name+' - '+data.percentage+' %</option>';
                                    });
                                html +='</select></td>'
                                    +'<td style="text-align: center;"><input type="text" name="percentage[]" class="percentage_'+re_no+' percentage_'+re_no+'_'+no_of_tax_row+'" data-row="'+no_of_tax_row+'" readonly></td>'
                                    +'<td style="text-align: center;"><input type="number" name="tax_a[]" style="text-align: right;" required class="tax_a_'+re_no+' tax_a_'+re_no+'_'+no_of_tax_row+'" step="0.01" data-row="'+no_of_tax_row+'" readonly></td>'
                                    +'<td><span class="add btn f-right remove_tax_'+re_no+'" data-row="'+no_of_tax_row+'" role="button"  aria-controls="offcanvasExampleadd"> <i class="fa fa-trash"></i> </span></td>'
                            +'</tr>';
                        
                        no_of_tax_row ++;
                        $(html).insertBefore('tr.tax_list_'+re_no);
                    }
                }
            });
        });
        

        $(document).on('change', '.qty_'+re_no +', .rate_'+re_no, function(e){
            code = $(this).data('row');
            total(code);
        });
        $(document).on('keyup', '.qty_'+re_no +', .rate_'+re_no, function(e){
            code = $(this).data('row');
            total(code);
        });
        function total(code = null){
            if(code){
                var qut = $('.qty_'+code+'_'+re_no).val();
                if(!qut || qut == null || qut == undefined || qut == 0){
                    qut = 0;
                }
                var rate = $('.rate_'+code+'_'+re_no).val();
                if(!rate || rate == null || rate == undefined || rate == 0){
                    rate = 0;
                }
                var Amo = (parseFloat(qut)* parseFloat(rate)).toFixed(2);
                $('.Amo_'+code+'_'+re_no).val(Amo);
            }
            var gqty = 0.00;
            $(".qty_"+re_no).each(function(){
                total_q = $(this).val();
                if(!total_q || total_q == null || total_q == undefined || total_q == 0){
                    total_q = 0;
                }
                gqty += + parseFloat(total_q);
            });
            $('.gqty_'+re_no).val((gqty));
            var gproA = 0.00;
            $(".Amo_"+re_no).each(function(){
                total_l = $(this).val();
                if(!total_l || total_l == null || total_l == undefined || total_l == 0){
                    total_l = 0;
                }
                gproA += + parseFloat(total_l);
            });
            $('.gproA_'+re_no).val((gproA).toFixed(2));
            
            var gtotal = gproA;
            $(".percentage_"+re_no).each(function(){
                total_a = 0.00;
                per = $(this).val();
                row = $(this).data('row');
                if(!per || per == null || per == undefined || per == 0){
                    per = 0;
                }
                total_a = ((gproA * per) /100).toFixed(2);
                $('.tax_a_'+re_no+'_'+row+'').val(total_a);
                gtotal += + parseFloat(total_a);
            });
            round = ((gtotal).toFixed() - (gtotal).toFixed(2)).toFixed(2);
            $('.round_'+re_no).val(round);
            $('.gtotal_'+re_no).val((gtotal).toFixed());
            price_in_words((gtotal).toFixed());
        }
       
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
        $('.word_amount_'+re_no).val(words_string);

    }

    let previousLength = 0;

    const handleInput = (event) => {
        const bullet = "\u2022";
        const newLength = event.target.value.length;
        const characterCode = event.target.value.substr(-1).charCodeAt(0);

        if (newLength > previousLength) {
            if (characterCode === 10) {
            event.target.value = `${event.target.value}${bullet} `;
            } else if (newLength === 1) {
            event.target.value = `${bullet} ${event.target.value}`;
            }
        }

        previousLength = newLength;
    }
</script>
