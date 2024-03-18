<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Vendor</h5>

            <button type="button" class="close close_cus" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body my_view_new_he">
            <div class="row">
                <!--Row1 Start-->
                <div class="col-md-6">
                    <h5 class="a-title">1. Company Details</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="c-text">Name : <span class="d-text"> {{ $vendor->company_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">PAN No : <span class="d-text"> {{ $vendor->company_pan_card_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> Mobile No : <span class="d-text"> {{ $vendor->company_mobile_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Email : <span class="d-text"> {{ $vendor->company_email }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Address : <span class="d-text"> {{ $vendor->company_address }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Pincode : <span class="d-text"> {{ $vendor->company_pincode }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <h5 class="a-title">2. Bank Details</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="c-text">Bank Name : <span class="d-text"> {{ $vendor->bank_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Account Number : <span class="d-text"> {{ $vendor->account_number }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">IFSC Code : <span class="d-text"> {{ $vendor->ifsc_code }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <h5 class="a-title">3. User Details</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="c-text">First Name : <span class="d-text"> {{ $vendor->first_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Last Name : <span class="d-text"> {{ $vendor->last_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Mobile No : <span class="d-text"> {{ $vendor->mobile_number }}</span></p>
                        </div>
                    </div>
                </div>
                {{-- raw_material_to_vendor --}}
                <div class="col-md-6 mt-3">
                    <h5 class="a-title">4. Raw Material Details</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>name</th>
                                    <th>Raw Material Status</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raw_material_to_vendor as $key=>$val)
                                    <tr >
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $val->raw_material->name }}</td>
                                        <td>{{ $val->raw_material_status }}</td>
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
