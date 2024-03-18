<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Customer</h5>

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
                            <p class="c-text">Name : <span class="d-text"> {{ $customer->company_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">PAN No : <span class="d-text"> {{ $customer->company_pan_card_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text"> Mobile No : <span class="d-text"> {{ $customer->company_mobile_no }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Email : <span class="d-text"> {{ $customer->company_email }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Address : <span class="d-text"> {{ $customer->company_address }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Factory Address : <span class="d-text"> {{ $customer->factory_address }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Pincode : <span class="d-text"> {{ $customer->company_pincode }}</span></p>
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
                            <p class="c-text">Bank Name : <span class="d-text"> {{ $customer->bank_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Account Number : <span class="d-text"> {{ $customer->account_number }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">IFSC Code : <span class="d-text"> {{ $customer->ifsc_code }}</span></p>
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
                            <p class="c-text">First Name : <span class="d-text"> {{ $customer->first_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Last Name : <span class="d-text"> {{ $customer->last_name }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="c-text">Mobile No : <span class="d-text"> {{ $customer->mobile_number }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <h5 class="a-title">4. Terms And Conditions</h5>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="c-text">Credit Period : <span class="d-text"> {{ $customer->credit_period }}</span></p>
                        </div>
                        <div class="col-md-12">
                            <p class="c-text">Declaration : <span class="d-text" style="word-break: break-all;"> {!! nl2br($customer->declaration) !!}</span></p>
                        </div>
                        <div class="col-md-12">
                            <p class="c-text">Terms : <span class="d-text" style="word-break: break-all;"> {!!  ($customer->terms) !!}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_cus" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
