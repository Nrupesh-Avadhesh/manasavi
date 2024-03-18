<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\ExpenseController@store'), 'method' => 'post','files'=>true, 'id' => 'company_add_form', 'class' => 'form-horizontal my_new_he' ,'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Expense Type: <span class="text-danger">*</span></label>
                            {!! Form::select('expense_type_id',$expense_type ,null, ['class' => 'form-control js-example-basic-single','placeholder' => 'Select Expense Type']); !!}
                            <span class="invalid-feedback expense_type_id_error error" role="alert">
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
                            <label class="form-label">Description: </label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Description">
                            <span class="invalid-feedback description_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Date: <span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                            <span class="invalid-feedback date_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Amount: <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" min="0" step="0.01" placeholder="Enter Amount">
                            <span class="invalid-feedback amount_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Is Bill: <span class="text-danger">*</span></label>
                            <div>
                                <label class="mx-2">
                                    <input type="radio" name="is_bill" class="mr-1 is_bill" value="Yes">Yes
                                </label>
                                <label class="mx-2">
                                    <input type="radio" name="is_bill" class="mr-1 is_bill" value="No" checked>No
                                </label>
                            </div>
                            <span class="invalid-feedback is_bill_error error" role="alert">
                                <strong class="msg"> </strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 bill_image">
                        <div class="form-group">
                            <label class="form-label">Bill image: <span class="text-danger">*</span></label>
                            <input type="file" name="bill_img" class="form-control">
                            <span class="invalid-feedback bill_img_error error" role="alert">
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
        is_bill();
        $(document).on('change', '.is_bill', function(e){
            is_bill();
        });
        function is_bill(){
            type = $('input[name=is_bill]:checked').val();
            // console.log(type);
            if(type == 'Yes'){
                $('.bill_image').show();
            } else {
                $('.bill_image').hide();
            }
        }
    });
    $(".js-example-basic-single").select2();
    $(".js-example-basic-multiple").select2();
</script>