@extends('layouts.app')
@section('title', ' / Proforma')
@section('header_titel', 'Proforma')
@section('sub_page', 'Proforma')
@section('header_link')
@endsection
@section('content')

    @include('layouts.breadcrumb')
    <div class="row">
        <!-- statustic-card start -->
        <div class="col-xl-12 col-md-12">
            <div class="card bg-c-white text-black">
                <div class="card-block table-responsive mb-2">
                    <h4 class="flex-row-reverse justify-content-between m-0 row w-100">
                        <button class="add btn f-right cus_form_open_btn" data-href="{{ action('App\Http\Controllers\ProformaController@create') }}"
                            data-bs-toggle="offcanvas" role="button" data-container=".company_add_modal" aria-controls="offcanvasExampleadd">
                            <i class="fa fa-plus"></i>
                        </button>
                    </h4>
                    <div class="table-responsive">

                        <table class="table  text-center data-table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Proforma No</th>
                                    <th>Com Name</th>
                                    <th>Customer Com Name</th>
                                    <th>date</th>
                                    <th>Amount</th>
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
                ajax: "{{ url('/proforma') }}",
                deferRender: true,
                retrieve: true,
                columns: [
                    {data: 'id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'proforma_no' , name: 'proforma_no'},
                    {data: function(data){ return data.company.name; }, name: 'company.name'},
                    {data: function(data){ return data.customer.company_name; }, name: 'customer.company_name'},
                    {data: 'date', name: 'date'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'status', name: 'status'},
                    {data: function(data){ 
                        if(data.status == 'Approved'){
                            return data.action +' '+data.edita; 
                        }else {
                            return data.action +' '+data.edit; 
                        }
                    }, name: 'action'},
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
                            setTimeout(function(){
                                    window.location.reload();
                            }, 1000);
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
                            setTimeout(function(){
                                    window.location.reload();
                            }, 1000);
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
    </script>
@endsection
