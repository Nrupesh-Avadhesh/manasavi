<?php

namespace App\Http\Controllers;

use App\Models\{ raw_material , measures, vendor, raw_material_to_vendor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $raw_material = raw_material::with(['measures'])->get();
            return Datatables::of($raw_material)
                ->addColumn( 'add_vendor',
                    '<button data-href="{{action(\'App\Http\Controllers\RawMaterialController@add_raw_material_vendor\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-plus" data-toggle="tooltip" title="" data-original-title="show"></i></button>'
                )->escapeColumns(['add_vendor'])
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\RawMaterialController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>
                    <button data-href="{{action(\'App\Http\Controllers\RawMaterialController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('RawMaterial.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendor = vendor::where('status', '=','Active')->select('company_name', 'first_name','id')->get();
        $measures = measures::where('status', '=','Active')->pluck('name','id');
        return view('RawMaterial.create')->with(compact('measures', 'vendor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'measure_id' => 'required',
                    'name' => ['required',Rule::unique('raw_materials')->where(function (Builder $query) use($request) {
                        return $query->where('name', $request->name)->where('HSN_code', $request->HSN_code);
                    })],
                    'HSN_code' => ['required',Rule::unique('raw_materials')->where(function (Builder $query) use($request) {
                        return $query->where('name', $request->name)->where('HSN_code', $request->HSN_code);
                    })],
                ]);
                
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $input = $request->all();
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                $raw_material = raw_material::create($input);
                // dd($raw_material);
                if(isset($request->vendors) && sizeof($request->vendors) != 0){
                    foreach($request->vendors as $val){
                        $new_data = new raw_material_to_vendor;
                        $new_data->raw_material_id = $raw_material->id;
                        $new_data->vendor_id = $val;
                        $new_data->add_by = Auth::user()->id;
                        $new_data->raw_material_status = 'Active';
                        $new_data->vendor_status = 'Active';
                        $new_data->raw_material_vendor_status = 'Active';
                        $new_data->status = 'Active';
                        $new_data->save();
                    }
                }
                $output = array('success' => true, 'msg' => 'Raw Material added Successfully');
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
        $raw_material = raw_material::with(['measures'])->where('id',$id)->first();
        $raw_material_to_vendor = raw_material_to_vendor::with(['vendor'])->where('raw_material_id',$id)->get();
        return view('RawMaterial.show')->with(compact('raw_material', 'raw_material_to_vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $raw_material= raw_material::where('id',$id)->first();
        $measures = measures::where('status', '=','Active')->pluck('name','id');
        return view('RawMaterial.edit')->with(compact('raw_material', 'measures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'measure_id' => 'required',
                    'name' => ['required',Rule::unique('raw_materials')->where(function (Builder $query) use($request, $id) {
                        return $query->where('name', $request->name)->where('HSN_code', $request->HSN_code)->where('id', '!=', $id);
                    })],
                    'HSN_code' => ['required',Rule::unique('raw_materials')->where(function (Builder $query) use($request, $id) {
                        return $query->where('name', $request->name)->where('HSN_code', $request->HSN_code)->where('id', '!=', $id);
                    })],
                ]);
                
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $raw_material = raw_material::where('id', $id)->first();
                $raw_material->measure_id = $request->measure_id;
                $raw_material->name = $request->name;
                $raw_material->HSN_code = $request->HSN_code;
                $raw_material->add_by = Auth::user()->id;
                if ($raw_material->save()) {
                    $output = array('success' => true, 'msg' => 'Raw Material updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Raw Material not updated Successfully');
                }
            } catch (Throwable $e) {
                Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                $output = array( 'success' => false, 'msg' => 'Something went wrong, please try again');
            }
            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(raw_material $raw_material)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = raw_material::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                $raw_material = raw_material_to_vendor::where('raw_material_id', $request->id)->get();
                foreach($raw_material as $val){
                    $raw_material_data = raw_material_to_vendor::where('id', $val->id)->first();
                    if($raw_material_data){
                        $raw_material_data->raw_material_status = $request->status;
                        if($raw_material_data->vendor_status == 'Active' && $request->status == 'Active'){
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
        $raw_material = raw_material::with(['raw_material_to_vendor', 'raw_material_to_vendor.vendor'])->where('id', $id)->first();
        $re_no = date('dHmiys');
        return view('RawMaterial.add_raw_material_vendor')->with(compact('raw_material','re_no'));
    }
    public function store_raw_material_vendor(Request $request, $id)
    {
        if (request()->ajax()) {
            $raw_material = raw_material::where('id', $id)->first();
            try {
                // dd($request->all());
                foreach ($request->old_id as $key => $value) {
                    $raw_material_data = raw_material_to_vendor::where('id', $value)->first();
                    $raw_material_data->status = $request->old_status[$key];
                    $raw_material_data->save();
                }
                if(isset($request->vendor_id) && sizeof($request->vendor_id) != 0){

                    foreach($request->vendor_id as $keyV =>$val){
                        $new_data = raw_material_to_vendor::where('raw_material_id', $raw_material->id)->where('vendor_id', $val)->first();
                        if(!$new_data){
                            $new_data = new raw_material_to_vendor;
                            $new_data->raw_material_id = $raw_material->id;
                            $new_data->vendor_id = $val;
                        }
                        $new_data->raw_material_status = $raw_material->status;
                        $new_data->vendor_status = $request->new_vendor_status[$keyV];
                        if($raw_material->status == 'Active' && $request->new_vendor_status[$keyV] == 'Active'){
                            $new_data->raw_material_vendor_status = 'Active';
                        } else {
                            $new_data->raw_material_vendor_status = 'InActive';
                        }
                        $new_data->status = $request->status[$keyV];
                        $new_data->add_by = Auth::user()->id;
                        $new_data->save();
                    }
                }
                $output = array('success' => true, 'msg' => 'Raw Material add vendor Successfully');
            } catch (Throwable $e) {
                Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                $output = array( 'success' => false, 'msg' => 'Something went wrong, please try again');
            }
            return $output;
        }
    }
    public function vendorlist(Request $request)
    {
        $selected_vendor = explode(",",$request->selected_vendor);
        $data = [];
        // $data['vendor'] = vendor::select('company_name', 'first_name', 'id')->get();
        $data['vendor'] = vendor::whereNotIn('id',$selected_vendor)->select('company_name', 'first_name', 'id')->get();
        return $data;
    }
    public function vendordata(Request $request)
    {
        $vendor = vendor::where('id',$request->vendor)->select('status')->first();
        return $vendor->status;
    }
}
