<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">vendor Add Raw Material</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\VendorController@store_raw_material_vendor', [$vendor->id]),
        'method' => 'PUT', 'id' => 'company_edit_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data' ]) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Name :- </label> {{ $vendor->company_name }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Status :- </label> {{ $vendor->status }}
                        </div>
                    </div>
                    <input type="hidden" class="re_no" value="{{ $re_no }}">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Raw Material Name</th>
                                        <th>Raw Material Status</th>
                                        <th style="min-width: 130px;">Status</th>
                                        <th><span class=" btn {{ $re_no }}_add_product"><i class="fa fa-plus"></i></span></th>
                                    </tr>
                                </thead>
                                <tbody id="product_vendor">
                                    @foreach ($vendor->raw_material_to_vendor as $key=>$val)
                                        <tr class="{{ $re_no }}no_of_row">
                                            <td>{{ $key+1 }}<input name="old_id[]" type="hidden" value="{{ $val->id }}"><input name="selected_raw_material[]" class="selected_raw_material" type="hidden" value="{{ $val->raw_material_id }}"></td>
                                            <td>
                                                <select class="form-control" disabled>
                                                    <option selected> {{ $val->raw_material->name }}</option>
                                                </select>
                                            </td>
                                            <td>{{ $val->raw_material_status }}</td>
                                            <td>
                                                {!! Form::select('old_status[]',['Active'=>'Active', 'InActive'=>'InActive'] ,$val->status, ['class' => 'form-control','placeholder' => 'Select Status', 'required']); !!}
                                            </td>
                                            <td ><button disabled class="btn"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $(document).on('click', '.'+re_no+'_add_product', function(e){
            selected_raw_material = '';
            $('.selected_raw_material').each(function( index ) {
                if(index == 0){
                    selected_raw_material +=$( this ).val();
                } else{
                    selected_raw_material +=','+$( this ).val();
                }
            });
            $.ajax({
                type:'post',
                url:'vendor/RawMateriallist',
                data:{'selected_raw_material':selected_raw_material,'_token':'{{csrf_token()}}'},
                success:function(result) {
                    if(result.raw_material.length == 0){
                        Toastify({text: 'All raw_materials are selected or raw_material status is InActiv', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                    } else {
                        count = $('.'+re_no+'no_of_row').length + 1;
                        var html = '<tr class="'+re_no+'no_of_row">'
                            +'<td>'+count+'</td>'
                            +'<td class="form-group">'
                                +'<select class="form-control new_'+re_no+'raw_material" name="raw_material_id[]" required>'
                                    +'<option value="">select Raw Material</option>';
                                    $(result.raw_material).each(function( index, key ) {
                                        html += '<option value="'+key.id+'">'+key.name+'</option>';
                                    });
                            html+='</select><input name="new_raw_material_status[]" class="status_val" type="hidden" value="">'
                            +'<span class="invalid-feedback raw_material_id_error error" role="alert"> <strong class="msg"></strong> </span>'
                            +'</td>'
                            +'<td class="status"></td>'
                            +'<td class="form-group">'
                                +'<select class="form-control" name="status[]" required>'
                                    +'<option value="Active">Active</option>'
                                    +'<option value="Inactive">Inactive</option>'
                                +'</select>'
                                +'<span class="invalid-feedback status_error error" role="alert"> <strong class="msg"></strong> </span>'
                            +'</td>'
                            +'<td><span class="btn remove"><i class="fa fa-close"></i></span></td>'
                        +'</tr>';
                        $('#product_vendor').append(html);
                    }
                }
            });
            
        });
        $(document).on('click', '.remove', function(e){
            e.preventDefault();
            $(this).parents('tr').remove();
        });
        $(document).on('change', '.new_'+re_no+'raw_material', function(e){
            raw_material = $(this).val();
            if(raw_material){
                _this = $(this);
                $.ajax({
                    type:'post',
                    url:'vendor/RawMaterialdata',
                    data:{'raw_material':raw_material,'_token':'{{csrf_token()}}'},
                    success:function(result) {
                        _this.parents('tr').find('.status').html(result);
                        _this.parents('tr').find('.status_val').val(result);
                    }
                });
            } else {
                _this.parents('tr').find('.status').html('');
                _this.parents('tr').find('.status_val').val('');
            }
        });
    });
</script>
