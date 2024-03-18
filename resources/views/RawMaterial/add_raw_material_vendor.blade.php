<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Raw Material Add vendor</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {!! Form::open(['url' => action('App\Http\Controllers\RawMaterialController@store_raw_material_vendor', [$raw_material->id]),
        'method' => 'PUT', 'id' => 'company_edit_form', 'class' => 'form-horizontal my_new_he', 'enctype' => 'multipart/form-data' ]) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Name :- </label> {{ $raw_material->name }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Status :- </label> {{ $raw_material->status }}
                        </div>
                    </div>
                    <input type="hidden" class="re_no" value="{{ $re_no }}">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Vondor Name</th>
                                        <th>Vondor Status</th>
                                        <th style="min-width: 130px;">Status</th>
                                        <th><span class=" btn {{ $re_no }}_add_product"><i class="fa fa-plus"></i></span></th>
                                    </tr>
                                </thead>
                                <tbody id="product_vendor">
                                    @foreach ($raw_material->raw_material_to_vendor as $key=>$val)
                                        <tr class="{{ $re_no }}no_of_row">
                                            <td>{{ $key+1 }}<input name="old_id[]" type="hidden" value="{{ $val->id }}"><input name="selected_vendor[]" class="selected_vendor" type="hidden" value="{{ $val->vendor_id }}"></td>
                                            <td>
                                                <select class="form-control" disabled>
                                                    <option selected> {{ $val->vendor->company_name }} / {{ $val->vendor->first_name }}</option>
                                                </select>
                                            </td>
                                            <td>{{ $val->vendor_status }}</td>
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
            selected_vendor = '';
            $('.selected_vendor').each(function( index ) {
                if(index == 0){
                    selected_vendor +=$( this ).val();
                } else{
                    selected_vendor +=','+$( this ).val();
                }
            });
            $.ajax({
                type:'post',
                url:'RawMaterial/vendorlist',
                data:{'selected_vendor':selected_vendor,'_token':'{{csrf_token()}}'},
                success:function(result) {
                    if(result.vendor.length == 0){
                        Toastify({text: 'All Vendors are selected or vendor status is InActiv', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                    } else {
                        count = $('.'+re_no+'no_of_row').length + 1;
                        var html = '<tr class="'+re_no+'no_of_row">'
                            +'<td>'+count+'</td>'
                            +'<td class="form-group">'
                                +'<select class="form-control new_'+re_no+'vendor" name="vendor_id[]" required>'
                                    +'<option value="">select vendor</option>';
                                    $(result.vendor).each(function( index, key ) {
                                        html += '<option value="'+key.id+'">'+key.company_name+' / '+key.first_name+'</option>';
                                    });
                            html+='</select><input name="new_vendor_status[]" class="status_val" type="hidden" value="">'
                            +'<span class="invalid-feedback vendor_id_error error" role="alert"> <strong class="msg"></strong> </span>'
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
        $(document).on('change', '.new_'+re_no+'vendor', function(e){
            vendor = $(this).val();
            if(vendor){
                _this = $(this);
                $.ajax({
                    type:'post',
                    url:'RawMaterial/vendordata',
                    data:{'vendor':vendor,'_token':'{{csrf_token()}}'},
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
