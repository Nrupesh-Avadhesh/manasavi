<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Bank</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\BanksController@store'), 'method' => 'post','files'=>true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he' ,'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">company: <span class="text-danger">*</span></label>
                            {!! Form::select('company',$company ,null, ['class' => 'form-control js-example-basic-single','placeholder' => 'Select Company']); !!}
                            <span class="invalid-feedback company_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Name: <span class="text-danger">*</span></label>
                            <input type="test" name="name" class="form-control" placeholder="Enter Name.">
                            <span class="invalid-feedback name_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">A/C Number: <span class="text-danger">*</span></label>
                            <input type="text" name="AC_number" class="form-control" placeholder="Enter A/C Number">
                            <span class="invalid-feedback AC_number_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">IFS Code: <span class="text-danger">*</span></label>
                            <input type="text" name="IFS_Code" class="form-control" placeholder="Enter IFS Code.">
                            <span class="invalid-feedback IFS_Code_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">A/C Holder Name: <span class="text-danger">*</span></label>
                            <input type="text" name="AC_Holder_Name" class="form-control" placeholder="Enter A/C Holder Name">
                            <span class="invalid-feedback AC_Holder_Name_error error" role="alert">
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