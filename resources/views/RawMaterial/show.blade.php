<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Raw Material</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body my_view_new_he">
            <div class="row">
                <!--Row1 Start-->
                <div class="col-md-6">
                    <h5 class="a-title">1. Raw Material Details</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="c-text">Name : <span class="d-text"> {{ $raw_material->name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Measures : <span class="d-text"> {{ $raw_material->measures->name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Description : <span class="d-text"> {{ $raw_material->description }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">HSN Code : <span class="d-text"> {{ $raw_material->HSN_code }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Status : <span class="d-text"> {{ $raw_material->status }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <h5 class="a-title">2. Vendor Details</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>name</th>
                                    <th>Vendor Status</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raw_material_to_vendor as $key=>$val)
                                    <tr >
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $val->vendor->company_name }} / {{ $val->vendor->first_name }}</td>
                                        <td>{{ $val->vendor_status }}</td>
                                        <td>{{$val->status}}</td>
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
        </div>
    </div>
</div>
