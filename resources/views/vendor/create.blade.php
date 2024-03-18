<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Vendor</h5>
            
            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\VendorController@store'), 'method' => 'post','files'=>true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he' ,'enctype' => 'multipart/form-data']) !!}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Company Name: <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name">
                        <span class="invalid-feedback company_name_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Company Pan Card No: <span class="text-danger">*</span></label>
                        <input type="text" name="company_pan_card_no" class="form-control" placeholder="Enter Company Pan Card No">
                        <span class="invalid-feedback company_pan_card_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Company Mobile No: <span class="text-danger">*</span></label>
                        <input type="number" name="company_mobile_no" class="form-control" placeholder="Enter Company Mobile No">
                        <span class="invalid-feedback company_mobile_no_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Company Email: <span class="text-danger">*</span></label>
                        <input type="email" name="company_email" class="form-control email" placeholder="Enter Company Email">
                        <span class="invalid-feedback company_email_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Company Address: <span class="text-danger">*</span></label>
                        <input type="text" name="company_address" class="form-control" placeholder="Enter Company Address">
                        <span class="invalid-feedback error company_address_error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Company Pincode: <span class="text-danger">*</span></label>
                        <input type="text" name="company_pincode" class="form-control" placeholder="Enter Company Pincode">
                        <span class="invalid-feedback error company_pincode_error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Bank Name: <span class="text-danger">*</span></label>
                        <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name">
                        <span class="invalid-feedback error bank_name_error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Account Number: <span class="text-danger">*</span></label>
                        <input type="text" name="account_number" class="form-control" placeholder="Enter Account Number">
                        <span class="invalid-feedback error account_number_error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">IFSC Code: <span class="text-danger">*</span></label>
                        <input type="text" name="ifsc_code" class="form-control" placeholder="Enter IFSC Code">
                        <span class="invalid-feedback error ifsc_code_error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">GST Number: <span class="text-danger">*</span></label>
                        <input type="text" name="gst_number" class="form-control" placeholder="Enter GST Number">
                        <span class="invalid-feedback error gst_number_error" role="alert">
                            <strong class="msg"></strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">First Name: <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control f_name" placeholder="Enter First Name">
                        <span class="invalid-feedback first_name_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Last Name: <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control l_name" placeholder="Enter Last Name">
                        <span class="invalid-feedback last_name_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Mobile Number: <span class="text-danger">*</span></label>
                        <input type="number" name="mobile_number" class="form-control" placeholder="Enter Mobile Number">
                        <span class="invalid-feedback mobile_number_error error" role="alert">
                            <strong class="msg"> </strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Raw Material: <span class="text-danger">*</span></label>
                        {!! Form::select('raw_material[]',$raw_material ,null, ['class' => 'form-control js-example-basic-multiple', 'multiple']); !!}
                        <span class="invalid-feedback raw_material_error error" role="alert">
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
    $(".js-example-basic-single").select2();
    $(".js-example-basic-multiple").select2();
</script>