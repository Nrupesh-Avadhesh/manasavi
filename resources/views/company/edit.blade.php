<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\CompanyController@update', [$company->id]),
        'method' => 'PUT', 'id' => 'company_edit_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data' ]) !!}
            <div class="modal-body">
            {{-- <form action=""> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $company->name }}" placeholder="Enter Name">
                            <span class="invalid-feedback name_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">logo: </label>
                            <input type="file" name="logo" class="form-control" placeholder="Enter Description">
                            <span class="invalid-feedback error logo_error" role="alert">
                                <strong class="msg"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone no: <span class="text-danger">*</span></label>
                            <input type="number" name="phone" class="form-control" value="{{ $company->phone }}" placeholder="Enter Phone No.">
                            <span class="invalid-feedback phone_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email: <span class="text-danger">*</span></label>
                            <input type="Email" name="email" class="form-control" value="{{ $company->email }}" placeholder="Enter Email">
                            <span class="invalid-feedback email_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Pan no: <span class="text-danger">*</span></label>
                            <input type="text" name="pan_card_no" class="form-control" value="{{ $company->pan_card_no }}" placeholder="Enter Pan No.">
                            <span class="invalid-feedback pan_card_no_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">GST No: <span class="text-danger">*</span></label>
                            <input type="text" name="GST" class="form-control" value="{{ $company->GST }}" placeholder="Enter GST No">
                            <span class="invalid-feedback GST_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Address: <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control" value="{{ $company->address }}" placeholder="Enter Address">
                            <span class="invalid-feedback address_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">City: <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control" value="{{ $company->city }}" placeholder="Enter City">
                            <span class="invalid-feedback city_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">State: <span class="text-danger">*</span></label>
                            <input type="text" name="state" class="form-control" value="{{ $company->state }}" placeholder="Enter State">
                            <span class="invalid-feedback state_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Zipcode: <span class="text-danger">*</span></label>
                            <input type="number" name="zipcode" class="form-control" value="{{ $company->zipcode }}" placeholder="Enter Zipcode">
                            <span class="invalid-feedback zipcode_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Declaration: <span class="text-danger">*</span></label>
                            <textarea name="declaration" class="form-control" cols="30" rows="5">{{ $company->declaration }}</textarea>
                            <span class="invalid-feedback declaration_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Terms: <span class="text-danger">*</span></label>
                            <textarea name="terms" class="form-control" cols="30" rows="5">{{ $company->terms }}</textarea>
                            <span class="invalid-feedback terms_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div> --}}
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
