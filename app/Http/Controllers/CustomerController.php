<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customer = customer::get();
        if (request()->ajax()) {
            $customer = customer::get();
            // dd($customer);
            return Datatables::of($customer)
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\CustomerController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>
                    <button data-href="{{action(\'App\Http\Controllers\CustomerController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'company_name' => ['required',Rule::unique('customers')->where(function (Builder $query) use($request) {
                        return $query->where('company_name', $request->company_name)->where('gst_number', $request->gst_number);
                    })],
                    'gst_number' => ['required','min:15', 'size:15',Rule::unique('customers')->where(function (Builder $query) use($request) {
                        return $query->where('gst_number', $request->gst_number);
                    })],
                    'company_pan_card_no' => 'required|min:10|size:10',
                    'company_mobile_no' => 'required|min:10|size:10',
                    'company_email' => 'required|email',
                    'company_address' => 'required|max:150',
                    'factory_address' => 'required|max:150',
                    'company_pincode' => 'required|min:6|size:6',
                    'bank_name' => 'required',
                    'account_number' => 'required|min:8|max:18',
                    'ifsc_code' => 'required|size:11',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile_number' => 'required|min:10|size:10',
                    'credit_period' => 'required',
                    'declaration' => 'required',
                    'terms' => 'required',
                ]);

                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $input = $request->all();
                $input['declaration'] = htmlentities($request->declaration);
                $input['terms'] = htmlentities($request->terms);
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                customer::create($input);
                Log::info("admin create vendors Successfully :- ". Auth::user()->id);
                $output = array('success' => true, 'msg' => 'Customer added Successfully');
            } catch (Throwable $e) {
                Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                $output = array( 'success' => false, 'msg' => 'Something went wrong, please try again');
            }
            return $output;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = customer::where('id',$id)->first();
        return view('customer.show')->with(compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = customer::where('id',$id)->first();
        return view('customer.edit')->with(compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'company_name' => ['required',Rule::unique('customers')->where(function (Builder $query) use($request, $id) {
                        return $query->where('company_name', $request->company_name)->where('gst_number', $request->gst_number)->where('id', '!=', $id);
                    })],
                    'gst_number' => ['required','min:15', 'size:15',Rule::unique('customers')->where(function (Builder $query) use($request, $id) {
                        return $query->where('gst_number', $request->gst_number)->where('id', '!=', $id);
                    })],
                    'company_pan_card_no' => 'required|min:10|size:10',
                    'company_mobile_no' => 'required|min:10|size:10',
                    'company_email' => 'required|email',
                    'company_address' => 'required|max:150',
                    'factory_address' => 'required|max:150',
                    'company_pincode' => 'required|min:6|size:6',
                    'bank_name' => 'required',
                    'account_number' => 'required|min:8|max:18',
                    'ifsc_code' => 'required|size:11',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile_number' => 'required|min:10|size:10',
                    'credit_period' => 'required',
                    'declaration' => 'required',
                    'terms' => 'required',
                ]);

                if ($validator->fails()) {
                    $output = array('success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $vendor = customer::where('id', '=', $id)->first();
                $vendor->company_name = $request->company_name;
                $vendor->company_pan_card_no = $request->company_pan_card_no;
                $vendor->company_mobile_no = $request->company_mobile_no;
                $vendor->company_email = $request->company_email;
                $vendor->company_address = $request->company_address;
                $vendor->factory_address = $request->factory_address;
                $vendor->company_pincode = $request->company_pincode;
                $vendor->bank_name = $request->bank_name;
                $vendor->account_number = $request->account_number;
                $vendor->ifsc_code = $request->ifsc_code;
                $vendor->gst_number = $request->gst_number;
                $vendor->first_name = $request->first_name;
                $vendor->last_name = $request->last_name;
                $vendor->mobile_number = $request->mobile_number;
                $vendor->credit_period = $request->credit_period;
                $vendor->declaration = htmlentities($request->declaration);
                $vendor->terms = htmlentities($request->terms);
                $vendor->add_by = Auth::user()->id;
                

                if ($vendor->save()) {
                    $output = array('success' => true, 'msg' => 'Customer updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Customer not updated Successfully');
                }
            } catch(exception $e){
                Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

                $output = array('success' => false, 'msg' => 'Something went wrong, please try again');
            }
            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = customer::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                return '1';
            }
        }
        return '0';
    }
}
