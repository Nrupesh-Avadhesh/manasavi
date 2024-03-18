<div class="modal-dialog modal-invoice-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\RawMaterialStockController@store'), 'method' => 'post', 'files' => true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-body">
            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                    <div class="form-group">
                        <label class="form-label">Vendor: <span class="text-danger">*</span></label>
                        <select name="vendors" class="form-control js-example-basic-single vendor_{{ $re_no }} col-sm-12">
                            <option value="">Select Vendor</option>
                            @foreach ($vendors as $val2)
                                <option value="{{ $val2->id }}">{{ $val2->company_name }} - {{ $val2->first_name }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback vendors_error error" role="alert">
                            <strong class="msg"></strong>
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
                        <label class="form-label">Date: <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                        <span class="invalid-feedback date_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
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
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Payment Mode: <span class="text-danger">*</span></label>
                        {!! Form::select('payment_mode_id',$payment ,null, ['class' => 'form-control js-example-basic-single','placeholder' => 'Select Payment Mode']); !!}
                        <span class="invalid-feedback payment_mode_id_error error" role="alert">
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
                <input type="hidden" class="re_no" value="{{ $re_no }}">
                <div class="col-md-12">
                    <div class="table-padding table-responsive">
                        <table class="table table-bordered text-left">
                            <thead>
                                <tr>
                                    <th width="3%">S.No.</th>
                                    <th width="3%">Check</th>
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
                            </tbody>
                            <tfoot>
                                <th style="text-align: right !important;" colspan="5">Grand Total</th>
                                <td><input type="number" style="font-weight: bold; text-align: right !important;" name="gqty" class="gqty_{{ $re_no }}" value="0" readonly></td>
                                <th style="text-align: right !important;">₹</th>
                                <td><input type="number" style="font-weight: bold; text-align: right !important;" name="gamount" class="gamount_{{ $re_no }}" value="0.00" readonly></td>
                                <th style="text-align: right !important;">₹</th>
                                <td><input type="number" style="font-weight: bold; text-align: right !important;" name="gproA" class="gproA_{{ $re_no }}" value="0.00" readonly></td>
                                {{-- <th ><input type="number" style="font-weight: bold; text-align: right !important;" name="gtotal" class="gtotal_{{ $re_no }}" value="{{  number_format((float)$gtotal, 2, '.', '') }}" readonly></th> --}}
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 row mb-2">
                    <div class="col-md-4 col-12">
                        <span class="invalid-feedback product_check_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                    <div class="col-md-4 col-12">
                        <span class="invalid-feedback qty_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                    <div class="col-md-4 col-12">
                        <span class="invalid-feedback rate_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                    <div class="col-md-4 col-12">
                        <span class="invalid-feedback amount_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                    <div class="col-md-4 col-12">
                        <span class="invalid-feedback proposs_percentage_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                    <div class="col-md-4 col-12">
                        <span class="invalid-feedback proposs_amount_error error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Terms of Delivery	: <span class="text-danger">*</span></label>
                        <textarea name="terms_of_delivery" class="form-control" placeholder="Enter Terms of Delivery" cols="30" rows="3" onInput="handleInput(event)"></textarea>
                        <span class="invalid-feedback terms_of_delivery_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6 col-12 mb-2">
                    <div class="form-group">
                        <label class="form-label">Description: <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" placeholder="Enter Description" cols="30" rows="3"></textarea>
                        <span class="invalid-feedback description_error error" role="alert">
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
        
        $(document).on('change', '.vendor_'+re_no, function(e){
            selected_vendor = $( this ).val();
            if(selected_vendor){
                $.ajax({
                    type:'post',
                    url:'Raw-Material/product_list',
                    data:{'selected_vendor':selected_vendor,'_token':'{{csrf_token()}}'},
                    success:function(result) {
                        if(result.length == 0){
                            Toastify({text: 'Raw Material not added', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                        } else {
                            var html = '';
                            $.each(result, function( index, data ) {
                                // console.log(data);
                                no = index +1 ;
                                html += '<tr>'
                                    +'<td style="text-align: center;">'+no +'</td>'
                                    +'<td style="text-align: center;"><input type="checkbox" name="product_check[]" value="'+data.raw_material_id+'" class="input_check_po_'+re_no+'"></td>'
                                    +'<td>'+data.raw_material.name+'</td>'
                                    +'<td style="text-align: center;">'+data.raw_material.HSN_code+'</td>'
                                    +'<td style="text-align: center;">'+data.raw_material.measures.name+'</td>'
                                    +'<td><input type="number" class="qty_'+re_no+' qty_'+data.raw_material_id+' qty_'+data.raw_material_id+'_'+re_no+'" data-code="'+data.raw_material_id+'" value="0" style="text-align: right;" disabled></td>'
                                    +'<td><input type="number" class="rate_'+re_no+' rate_'+data.raw_material_id+' rate_'+data.raw_material_id+'_'+re_no+'" data-code="'+data.raw_material_id+'" value="0" style="text-align: right;" disabled></td>'
                                    +'<td><input type="number" class="Amo_'+data.raw_material_id+' Amo_'+data.raw_material_id+'_'+re_no+'" data-code="'+data.raw_material_id+'" value="0" style="text-align: right;" disabled readonly></td>'
                                    +'<td><input type="number" class="proP_'+re_no+' proP_'+data.raw_material_id+' proP_'+data.raw_material_id+'_'+re_no+'" data-code="'+data.raw_material_id+'" value="0" style="text-align: right;" disabled></td>'
                                    +'<td><input type="number" class="proA_'+data.raw_material_id+' proA_'+data.raw_material_id+'_'+re_no+'" data-code="'+data.raw_material_id+'" value="0" style="text-align: right;" disabled readonly></td>'
                                +'</tr>';
                            });
                            $('.product_list_'+re_no).html(html);
                        }
                    }
                });
            } else {
                $('.product_list_'+re_no).html('');
            }
            
        });
        $(document).on('click', ".input_check_po_"+re_no, function () {
            _this = this;
            pro = $(this).val();
            // console.log($(this).val());
            type = $("input[name='type']:checked").val();
            if ($(this).is(":checked")) {
                $('.qty_'+pro).removeAttr("disabled").attr("required", "required").attr("name", "qty[]").attr("min", "1").attr("step", "1");
                $('.rate_'+pro).removeAttr("disabled").attr("required", "required").attr("name", "rate[]").attr("min", "1").attr("step", "0.01");
                $('.Amo_'+pro).removeAttr("disabled").attr("required", "required").attr("name", "amount[]").attr("min", "0").attr("step", "0.01").addClass('Amo_'+re_no);
                $('.proP_'+pro).removeAttr("disabled").attr("required", "required").attr("name", "proposs_percentage[]").attr("min", "0").attr("step", "0.01");
                $('.proA_'+pro).removeAttr("disabled").attr("required", "required").attr("name", "proposs_amount[]").attr("min", "0").attr("step", "0.01").addClass('proA_'+re_no);
            } else {
                $('.qty_'+pro).attr("disabled", "disabled").removeAttr("required").removeAttr("name").removeAttr("min").removeAttr("step").val("0");
                $('.rate_'+pro).attr("disabled", "disabled").removeAttr("required").removeAttr("name").removeAttr("min").removeAttr("step").val("0");
                $('.Amo_'+pro).attr("disabled", "disabled").removeAttr("required").removeAttr("name").removeAttr("min").removeAttr("step").val("0").removeClass('Amo_'+re_no);
                $('.proP_'+pro).attr("disabled", "disabled").removeAttr("required").removeAttr("name").removeAttr("min").removeAttr("step").val("0");
                $('.proA_'+pro).attr("disabled", "disabled").removeAttr("required").removeAttr("name").removeAttr("min").removeAttr("step").val("0").removeClass('proA_'+re_no);
            }
        });
        $(document).on('change', '.qty_'+re_no +', .rate_'+re_no +', .proP_'+re_no, function(e){
            code = $(this).data('code');
            total(code);
        });
        $(document).on('keyup', '.qty_'+re_no +', .rate_'+re_no +', .proP_'+re_no, function(e){
            code = $(this).data('code');
            total(code);
        });
        function total(code){
            var qut = $('.qty_'+code+'_'+re_no).val();
            if(!qut || qut == null || qut == undefined || qut == 0){
                qut = 0;
                // $('.qty_'+code+'_'+re_no).val(qut);
            }
            var rate = $('.rate_'+code+'_'+re_no).val();
            if(!rate || rate == null || rate == undefined || rate == 0){
                rate = 0;
                // $('.rate_'+code+'_'+re_no).val(rate);
            }
            var Amo = (parseFloat(qut)* parseFloat(rate)).toFixed(2);
            $('.Amo_'+code+'_'+re_no).val(Amo);
            var proP = $('.proP_'+code+'_'+re_no).val();
            var proA = 0.00;
            // console.log(qut);
            // console.log(rate);
            // console.log(Amo);
            // console.log(proP);
            if(proP != null && proP != undefined && proP != 0){
                propt = (Amo * proP) / 100;
                // console.log(propt);
                proA = (parseFloat(Amo)+ parseFloat(propt)).toFixed(2);
                // console.log(proA);
            } else {
                proA = (parseFloat(Amo)).toFixed(2);
                // console.log(proA);
            }
            $('.proA_'+code+'_'+re_no).val(proA);

           
            var gqty = 0.00;
            $(".qty_"+re_no).each(function(){
                total_l = $(this).val();
                if(!total_l || total_l == null || total_l == undefined || total_l == 0){
                    total_l = 0;
                }
                gqty += + parseFloat(total_l);
            });
            $('.gqty_'+re_no).val((gqty));
            var gtotal = 0.00;
            $(".Amo_"+re_no).each(function(){
                total_l = $(this).val();
                if(!total_l || total_l == null || total_l == undefined || total_l == 0){
                    total_l = 0;
                }
                gtotal += + parseFloat(total_l);
            });
            $('.gamount_'+re_no).val((gtotal).toFixed(2));
            var gproA = 0.00;
            $(".proA_"+re_no).each(function(){
                total_l = $(this).val();
                if(!total_l || total_l == null || total_l == undefined || total_l == 0){
                    total_l = 0;
                }
                gproA += + parseFloat(total_l);
            });
            $('.gproA_'+re_no).val((gproA).toFixed(2));
        }
    });
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
