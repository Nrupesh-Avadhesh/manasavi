<?php

namespace App\Http\Controllers;

use App\Models\{ raw_material_stock, raw_material_stock_detail, raw_material_stock_tax_detail, raw_material , payment_mode, vendor, raw_material_to_vendor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class RawMaterialStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $raw_material = raw_material_stock::with(['vendor'])->where('is_edit','!=','1')->get();
            return Datatables::of($raw_material)
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\RawMaterialStockController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>
                    <button data-href="{{action(\'App\Http\Controllers\RawMaterialStockController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('RawMaterialStock.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $re_no = date('dHmiys');
        $vendors = vendor::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        $payment = payment_mode::where('status', '=','Active')->pluck('name','id');
        return view('RawMaterialStock.create')->with(compact('vendors', 'payment', 're_no'));
    }

    public function product_list(Request $request){
        $product_vendor = raw_material_to_vendor::with(['raw_material', 'raw_material.measures'])->where('vendor_id',$request->selected_vendor)->where('raw_material_vendor_status', 'Active')->where('status', 'Active')->orderBy('raw_material_id','ASC')->get();
        
        return $product_vendor;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'vendors' => 'required',
                    'payment_mode_id' => 'required',
                    'date' => 'required|date',
                    'product_check' => 'required|array|min:1',
                    'qty' => 'required|array',
                    'rate' => 'required|array',
                    'amount' => 'required|array',
                    'proposs_percentage' => 'required|array',
                    'proposs_amount' => 'required|array',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $raw_material_stock = new raw_material_stock;
                $raw_material_stock->vendor_id = $request->vendors;
                $raw_material_stock->reference_no = $request->reference_no;
                $raw_material_stock->date = $request->date;
                $raw_material_stock->e_way_bill_no = $request->e_way_bill_no;
                $raw_material_stock->payment_mode_id = $request->payment_mode_id;
                $raw_material_stock->vehicle_no = $request->vehicle_no;
                $raw_material_stock->total_amount = $request->gamount;
                $raw_material_stock->total_proposs_amount = $request->gproA;
                $raw_material_stock->terms_of_delivery = htmlentities($request->terms_of_delivery);
                $raw_material_stock->description = htmlentities($request->description);
                $raw_material_stock->save();

                foreach ($request->product_check as $key => $value) {
                    $new_stock_detail = new raw_material_stock_detail;
                    $new_stock_detail->raw_material_stock_id = $raw_material_stock->id;
                    $new_stock_detail->raw_material_id = $request->product_check[$key];
                    $new_stock_detail->quantity = $request->qty[$key];
                    $new_stock_detail->rate = $request->rate[$key];
                    $new_stock_detail->amount = $request->amount[$key];
                    $new_stock_detail->proposs_percentage = $request->proposs_percentage[$key];
                    $new_stock_detail->proposs_amount = $request->proposs_amount[$key];
                    $new_stock_detail->save();
                }

                $output = array('success' => true, 'msg' => 'Raw Material Stock added Successfully');
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
        $re_no = date('dHmiys');
        $raw_material_stock = raw_material_stock::with(['vendor', 'payment_mode', 'raw_material_stock_detail', 'raw_material_stock_detail.raw_material', 'raw_material_stock_detail.raw_material.measures'])->where('id', $id)->first();
        return view('RawMaterialStock.show')->with(compact('raw_material_stock', 're_no'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $re_no = date('dHmiys');
        $raw_material_stock = raw_material_stock::with(['vendor'])->where('id', $id)->first();
        $raw_material_to_vendor = raw_material_to_vendor::with(['raw_material_stock_detail' => function ($q) use($raw_material_stock) {
            $q->where('raw_material_stock_id', $raw_material_stock->id);
        }, 'raw_material', 'raw_material.measures'])->where('vendor_id',$raw_material_stock->vendor_id)->where('raw_material_vendor_status', 'Active')->where('status', 'Active')->orderBy('raw_material_id','ASC')->get();
        $vendors = vendor::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        $payment = payment_mode::where('status', '=','Active')->pluck('name','id');
        return view('RawMaterialStock.edit')->with(compact('raw_material_stock', 'raw_material_to_vendor', 'payment', 'vendors', 're_no'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'vendors' => 'required',
                    'payment_mode_id' => 'required',
                    'date' => 'required|date',
                    'product_check' => 'required|array|min:1',
                    'qty' => 'required|array',
                    'rate' => 'required|array',
                    'amount' => 'required|array',
                    'proposs_percentage' => 'required|array',
                    'proposs_amount' => 'required|array',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }
                
                $raw_material_stock = raw_material_stock::where('id', $id)->first();
                raw_material_stock_detail::where('is_edit', '!=','1')->where('raw_material_stock_id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                if($raw_material_stock->vendor_id != $request->vendors){
                    raw_material_stock::where('id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                    $raw_material_stock = new raw_material_stock;
                } 
                
                $raw_material_stock->vendor_id = $request->vendors;
                $raw_material_stock->reference_no = $request->reference_no;
                $raw_material_stock->date = $request->date;
                $raw_material_stock->e_way_bill_no = $request->e_way_bill_no;
                $raw_material_stock->payment_mode_id = $request->payment_mode_id;
                $raw_material_stock->vehicle_no = $request->vehicle_no;
                $raw_material_stock->total_amount = $request->gamount;
                $raw_material_stock->total_proposs_amount = $request->gproA;
                $raw_material_stock->terms_of_delivery = htmlentities($request->terms_of_delivery);
                $raw_material_stock->description = htmlentities($request->description);
                $raw_material_stock->save();

                foreach ($request->product_check as $key => $value) {
                    $new_stock_detail = new raw_material_stock_detail;
                    $new_stock_detail->raw_material_stock_id = $raw_material_stock->id;
                    $new_stock_detail->raw_material_id = $request->product_check[$key];
                    $new_stock_detail->quantity = $request->qty[$key];
                    $new_stock_detail->rate = $request->rate[$key];
                    $new_stock_detail->amount = $request->amount[$key];
                    $new_stock_detail->proposs_percentage = $request->proposs_percentage[$key];
                    $new_stock_detail->proposs_amount = $request->proposs_amount[$key];
                    $new_stock_detail->save();
                }

                $output = array('success' => true, 'msg' => 'Raw Material Stock update Successfully');
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
    public function destroy(raw_material_stock $raw_material_stock)
    {
        //
    }
}
