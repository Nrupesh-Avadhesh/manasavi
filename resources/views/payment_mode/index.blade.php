@extends('layouts.app')
@section('title', ' / Payment Mode')
@section('header_titel', 'Payment Mode')
@section('sub_page', 'Master')
@section('header_link')
@endsection
@section('content')
    @include('layouts.breadcrumb')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card bg-c-white text-black">
                <div class="card-block table-responsive mb-2">
                    <h4 class="flex-row-reverse justify-content-between m-0 row w-100">
                        <button class="add btn f-right cus_form_open_btn" data-href="{{ action('App\Http\Controllers\PaymentModeController@create') }}"
                            data-bs-toggle="offcanvas" role="button" data-container=".company_add_modal" aria-controls="offcanvasExampleadd">
                            <i class="fa fa-plus"></i>
                        </button>
                    </h4>
                    <div class="table-responsive">
                        <table class="table  text-center data-table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th style="max-width: 200px;">Description</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade company_add_modal" id="exampleModalCenterview" aria-modal="true" role="dialog"></div>
    </div>
@endsection
@section('footer_script')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/PaymentMode') }}",
                deferRender: true,
                retrieve: true,
                columns: [
                    {data: 'id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'name' , name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: function(data){
                        if(data.status == 'Active'){
                            return '<div class="form-check form-switch"><label class="switch cus_switch_click" data-code="' + data.code + '" data-id="' + data.id + '" data-status="InActive"> <input type="checkbox" checked><span class="slider round"></span></label></div>';
                        }else{
                            return '<div class="form-check form-switch"><label class="switch cus_switch_click" data-code="' + data.code + '" data-id="' + data.id + '" data-status="Active"> <input type="checkbox"><span class="slider round"></span></label></div>';
                        }
                    }, name: 'status'},
                    {data: 'action', name: 'action'}
                ],
                order: [[1, 'DESC']]
            });

            $(document).on('submit', 'form#company_add_form', function(e) {
                e.preventDefault();
                var data = new FormData($('#company_add_form')[0]);
                data.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (result.success == true) {
                            submit_success(result, table);
                        } else {
                            submit_error(result);
                        }
                    },
                    error: function(result) {
                        submit_error(result);
                    }
                });
            });
            
            $(document).on('submit', 'form#company_edit_form', function(e){
                e.preventDefault();
                var data = new FormData($('#company_edit_form')[0]);
                data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if (result.success == true) {
                            submit_success(result, table);
                        } else {
                            submit_error(result);
                        }
                    },
                    error: function(result) {
                        submit_error(result);
                    }
                });
            });
        });
        $(document).on('click', '.cus_switch_click', function(e){
            e.preventDefault();
            if (confirm('Are you sure?')) {
                id = $(this).data('id');
                status = $(this).data('status');
                $.ajax({
                    type:'post',
                    url:'PaymentMode/status',
                    data:{'id':id, 'status':status,'_token':'{{csrf_token()}}'},
                    success:function(result) {
                        if(result == 1) {
                            Toastify({text: 'Status changed!!', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#088f7d'}).showToast();
                        } else {
                            Toastify({text: 'Something went wrong, please try again', duration: 3000, gravity: "bottom", position: "left", backgroundColor:'#FF0000'}).showToast();
                        }
                        $('.data-table').DataTable().ajax.reload();
                    }
                });
            }
        });
    </script>
@endsection
