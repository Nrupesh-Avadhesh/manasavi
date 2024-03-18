<div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\ProductController@store'), 'method' => 'post','files'=>true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he' ,'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Measures: <span class="text-danger">*</span></label>
                            {!! Form::select('measure_id',$measures ,null, ['class' => 'form-control js-example-basic-single','placeholder' => 'Select Measures']); !!}
                            <span class="invalid-feedback measure_id_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Name: <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name.">
                            <span class="invalid-feedback name_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Description: </label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Description">
                            <span class="invalid-feedback description_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">HSN Code: <span class="text-danger">*</span></label>
                            <input type="text" name="HSN_code" class="form-control" placeholder="Enter HSN Code.">
                            <span class="invalid-feedback HSN_code_error error" role="alert">
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