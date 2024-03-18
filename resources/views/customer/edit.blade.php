{{-- <div class="modal-dialog modal-lg" role="document"> --}}
    <div class="modal-dialog modal-invoice-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                
                <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => action('App\Http\Controllers\CustomerController@update', [$customer->id]), 'method' => 'PUT', 'id' => 'company_edit_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data' ]) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Company Name: <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" value="{{ $customer->company_name }}" class="form-control" placeholder="Enter Company Name">
                            <span class="invalid-feedback company_name_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Company Pan Card No: <span class="text-danger">*</span></label>
                            <input type="text" name="company_pan_card_no" value="{{ $customer->company_pan_card_no }}" class="form-control" placeholder="Enter Company Pan Card No">
                            <span class="invalid-feedback company_pan_card_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Company Mobile No: <span class="text-danger">*</span></label>
                            <input type="number" name="company_mobile_no" value="{{ $customer->company_mobile_no }}" class="form-control" placeholder="Enter Company Mobile No">
                            <span class="invalid-feedback company_mobile_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Company Email: <span class="text-danger">*</span></label>
                            <input type="email" name="company_email" value="{{ $customer->company_email }}" class="form-control email" placeholder="Enter Company Email">
                            <span class="invalid-feedback company_email_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>                
                    
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Bank Name: <span class="text-danger">*</span></label>
                            <input type="text" name="bank_name" value="{{ $customer->bank_name }}" class="form-control" placeholder="Enter Bank Name">
                            <span class="invalid-feedback error bank_name_error" role="alert">
                                <strong class="msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Account Number: <span class="text-danger">*</span></label>
                            <input type="text" name="account_number" value="{{ $customer->account_number }}" class="form-control" placeholder="Enter Account Number">
                            <span class="invalid-feedback error account_number_error" role="alert">
                                <strong class="msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">IFSC Code: <span class="text-danger">*</span></label>
                            <input type="text" name="ifsc_code" value="{{ $customer->ifsc_code }}" class="form-control" placeholder="Enter IFSC Code">
                            <span class="invalid-feedback error ifsc_code_error" role="alert">
                                <strong class="msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">GST Number: <span class="text-danger">*</span></label>
                            <input type="text" name="gst_number" value="{{ $customer->gst_number }}" class="form-control" placeholder="Enter GST Number">
                            <span class="invalid-feedback error gst_number_error" role="alert">
                                <strong class="msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">First Name: <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" value="{{ $customer->first_name }}" class="form-control f_name" placeholder="Enter First Name">
                            <span class="invalid-feedback first_name_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Last Name: <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" value="{{ $customer->last_name }}" class="form-control l_name" placeholder="Enter Last Name">
                            <span class="invalid-feedback last_name_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Mobile Number: <span class="text-danger">*</span></label>
                            <input type="number" name="mobile_number" value="{{ $customer->mobile_number }}" class="form-control" placeholder="Enter Mobile Number">
                            <span class="invalid-feedback mobile_number_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Credit Period: <span class="text-danger">*</span></label>
                            <input type="text" name="credit_period" value="{{ $customer->credit_period }}" class="form-control" placeholder="Enter Credit Period">
                            <span class="invalid-feedback credit_period_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Company Address: <span class="text-danger">*</span></label>
                            <textarea name="company_address"  class="form-control" placeholder="Enter Company Address" cols="30" rows="5">{{ $customer->company_address }}</textarea>
                            <span class="invalid-feedback company_address_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Factory Address: <span class="text-danger">*</span></label>
                            <textarea name="factory_address" class="form-control" placeholder="Enter Factory Address" cols="30" rows="5">{{ $customer->factory_address }}</textarea>
                            <span class="invalid-feedback factory_address_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Company Pincode: <span class="text-danger">*</span></label>
                            <input type="text" name="company_pincode" value="{{ $customer->company_pincode }}" class="form-control" placeholder="Enter Company Pincode">
                            <span class="invalid-feedback error company_pincode_error" role="alert">
                                <strong class="msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12"></div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Declaration: <span class="text-danger">*</span></label>
                            <textarea name="declaration"  class="form-control" placeholder="Enter Declaration" cols="30" rows="5" onInput="handleInput(event)" >{!! $customer->declaration !!}</textarea>
                            <span class="invalid-feedback declaration_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label">Terms: <span class="text-danger">*</span></label>
                            <textarea name="terms" class="form-control" placeholder="Enter Terms" cols="30" rows="5" onInput="handleInput(event)" >{!! $customer->terms !!}</textarea>
                            <span class="invalid-feedback terms_error error" role="alert">
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