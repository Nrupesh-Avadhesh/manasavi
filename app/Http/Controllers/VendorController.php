<?php

namespace App\Http\Controllers;

use App\Models\{ vendor, raw_material_to_vendor, raw_material};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $vendor = vendor::get();
            return Datatables::of($vendor)
            ->addColumn( 'add_raw_material',
                '<button data-href="{{action(\'App\Http\Controllers\VendorController@add_raw_material_vendor\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-plus" data-toggle="tooltip" title="" data-original-title="show"></i></button>'
            )->escapeColumns(['add_raw_material'])
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\VendorController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>
                    <button data-href="{{action(\'App\Http\Controllers\VendorController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $raw_material = raw_material::where('status', '=','Active')->pluck('name','id');
        return view('vendor.create')->with(compact('raw_material'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'company_name' => ['required',Rule::unique('vendors')->where(function (Builder $query) use($request) {
                        return $query->where('company_name', $request->company_name)->where('gst_number', $request->gst_number);
                    })],
                    'gst_number' => ['required','min:15', 'size:15',Rule::unique('vendors')->where(function (Builder $query) use($request) {
                        return $query->where('gst_number', $request->gst_number);
                    })],
                    'company_pan_card_no' => 'required|min:10|size:10',
                    'company_mobile_no' => 'required|min:10|size:10',
                    'company_email' => 'required|email',
                    'company_address' => 'required|max:150',
                    'company_pincode' => 'required|min:6|size:6',
                    'bank_name' => 'required',
                    'account_number' => 'required|min:8|max:18',
                    'ifsc_code' => 'required|size:11',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile_number' => 'required|min:10|size:10',
                ]);

                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $input = $request->all();
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                $vendors = vendor::create($input);
                if(isset($request->raw_material) && sizeof($request->raw_material) != 0){
                    foreach($request->raw_material as $val){
                        $new_data = new raw_material_to_vendor;
                        $new_data->raw_material_id = $val;
                        $new_data->vendor_id = $vendors->id;
                        $new_data->add_by = Auth::user()->id;
                        $new_data->raw_material_status = 'Active';
                        $new_data->vendor_status = 'Active';
                        $new_data->raw_material_vendor_status = 'Active';
                        $new_data->status = 'Active';
                        $new_data->save();
                    }
                }
                Log::info("admin create vendors Successfully :- ". Auth::user()->id);
                $output = array('success' => true, 'msg' => 'Vendor added Successfully');
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
        $vendor = vendor::where('id',$id)->first();
        $raw_material_to_vendor = raw_material_to_vendor::with(['raw_material'])->where('vendor_id',$id)->get();
        return view('vendor.show')->with(compact('vendor', 'raw_material_to_vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendor= vendor::where('id',$id)->first();
        return view('vendor.edit')->with(compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'company_name' => ['required',Rule::unique('vendors')->where(function (Builder $query) use($request, $id) {
                        return $query->where('company_name', $request->company_name)->where('gst_number', $request->gst_number)->where('id', '!=', $id);
                    })],
                    'gst_number' => ['required','min:15', 'size:15',Rule::unique('vendors')->where(function (Builder $query) use($request, $id) {
                        return $query->where('gst_number', $request->gst_number)->where('id', '!=', $id);
                    })],
                    'company_pan_card_no' => 'required|min:10|size:10',
                    'company_mobile_no' => 'required|min:10|size:10',
                    'company_email' => 'required|email',
                    'company_address' => 'required|max:150',
                    'company_pincode' => 'required|min:6|size:6',
                    'bank_name' => 'required',
                    'account_number' => 'required|min:8|max:18',
                    'ifsc_code' => 'required|size:11',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'mobile_number' => 'required|min:10|size:10',
                ]);

                if ($validator->fails()) {
                    $output = array('success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $vendor = vendor::where('id', '=', $id)->first();
                $vendor->company_name = $request->company_name;
                $vendor->company_pan_card_no = $request->company_pan_card_no;
                $vendor->company_mobile_no = $request->company_mobile_no;
                $vendor->company_email = $request->company_email;
                $vendor->company_address = $request->company_address;
                $vendor->company_pincode = $request->company_pincode;
                $vendor->bank_name = $request->bank_name;
                $vendor->account_number = $request->account_number;
                $vendor->ifsc_code = $request->ifsc_code;
                $vendor->gst_number = $request->gst_number;
                $vendor->first_name = $request->first_name;
                $vendor->last_name = $request->last_name;
                $vendor->mobile_number = $request->mobile_number;
                $vendor->add_by = Auth::user()->id;
                

                if ($vendor->save()) {
                    $output = array('success' => true, 'msg' => 'Vendor updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Vendor not updated Successfully');
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
    public function destroy(vendor $vendor)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = vendor::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                $raw_material = raw_material_to_vendor::where('vendor_id', $request->id)->get();
                foreach($raw_material as $val){
                    $raw_material_data = raw_material_to_vendor::where('id', $val->id)->first();
                    if($raw_material_data){
                        $raw_material_data->vendor_status = $request->status;
                        if($raw_material_data->raw_material_status == 'Active' && $request->status == 'Active'){
                            $raw_material_data->raw_material_vendor_status = 'Active';
                        } else {
                            $raw_material_data->raw_material_vendor_status = 'InActive';
                        }
                        $raw_material_data->save();
                    }
                }
                return '1';
            }
        }
        return '0';
    }
    public function add_raw_material_vendor($id)
    {
        $vendor = vendor::with(['raw_material_to_vendor', 'raw_material_to_vendor.raw_material'])->where('id', $id)->first();
        $re_no = date('dHmiys');
        return view('vendor.add_raw_material_vendor')->with(compact('vendor','re_no'));
    }
    public function store_raw_material_vendor(Request $request, $id)
    {
        if (request()->ajax()) {
            $vendor = vendor::where('id', $id)->first();
            try {
                // dd($request->all());
                foreach ($request->old_id as $key => $value) {
                    $raw_material_data = raw_material_to_vendor::where('id', $value)->first();
                    $raw_material_data->status = $request->old_status[$key];
                    $raw_material_data->save();
                }
                if(isset($request->raw_material_id) && sizeof($request->raw_material_id) != 0){
                    foreach($request->raw_material_id as $keyV =>$val){
                        $new_data = raw_material_to_vendor::where('raw_material_id', $val)->where('vendor_id', $vendor->id)->first();
                        if(!$new_data){
                            $new_data = new raw_material_to_vendor;
                            $new_data->raw_material_id = $val;
                            $new_data->vendor_id = $vendor->id;
                        }
                        $new_data->raw_material_status = $request->new_raw_material_status[$keyV];
                        $new_data->vendor_status = $vendor->status;
                        if($request->new_raw_material_status[$keyV] == 'Active' && $vendor->status == 'Active'){
                            $new_data->raw_material_vendor_status = 'Active';
                        } else {
                            $new_data->raw_material_vendor_status = 'InActive';
                        }
                        $new_data->status = $request->status[$keyV];
                        $new_data->add_by = Auth::user()->id;
                        $new_data->save();
                    }
                }
                $output = array('success' => true, 'msg' => 'Vendor Add Raw Material Successfully');
            } catch (Throwable $e) {
                Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                $output = array( 'success' => false, 'msg' => 'Something went wrong, please try again');
            }
            return $output;
        }
    }
    public function RawMateriallist(Request $request)
    {
        $selected_raw_material = explode(",",$request->selected_raw_material);
        $data = [];
        $data['raw_material'] = raw_material::whereNotIn('id',$selected_raw_material)->select('name', 'id')->get();
        return $data;
    }
    public function RawMaterialdata(Request $request)
    {
        $raw_material = raw_material::where('id',$request->raw_material)->select('status')->first();
        return $raw_material->status;
    }
}
