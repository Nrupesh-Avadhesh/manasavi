<?php

namespace App\Http\Controllers;

use App\Models\{ proforma, proforma_detal, proforma_tax,  payment_mode, company, customer, Banks, product, tax};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class ProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $proforma = proforma::with(['company', 'customer'])->where('is_edit', '!=', '1')->get();
            return Datatables::of($proforma)
                ->addColumn( 'edit',
                    '<button data-href="{{action(\'App\Http\Controllers\ProformaController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['edit'])
                ->addColumn( 'edita',
                    '<button class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 "><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['edita'])
                ->addColumn( 'action',
                '<button data-href="{{action(\'App\Http\Controllers\ProformaController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>'
                )->escapeColumns(['action'])
                ->setRowClass('text-center')->make(true);
        }
        return view('proforma.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $re_no = date('dHmiys');
        $company = company::where('status', '=','Active')->pluck('name', 'id');
        $customer = customer::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        $payment = payment_mode::where('status', '=','Active')->pluck('name','id');
        return view('proforma.create')->with(compact('company', 'customer', 'payment', 're_no'));
    }

    public function bank_list(Request $request)
    {
        $bank = Banks::where('company_id', $request->companie)->where('status', '=','Active')->get();
        return $bank;
    }
    public function product_list(Request $request)
    {
        // $product = product::with(['measures'])->where('status', '=','Active')->get();
        $product = product::where('status', '=','Active')->get();
        return $product;
    }
    public function tax_list(Request $request)
    {
        $tax = tax::where('status', '=','Active')->get();
        return $tax;
    }
    public function customer_terms(Request $request)
    {
        $customer = customer::where('id', $request->customer)->first();
        return $customer->terms;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                // dd($request->all(), $request->per[0]);
                $validator = Validator::make($request->all(), [
                    'companie_id' => 'required',
                    'customer_id' => 'required',
                    'bank_id' => 'required',
                    'payment_mode_id' => 'required',
                    'date' => 'required|date',
                    'status' => 'required',
                    'word_amount' => 'required',
                    // 'terms_of_delivery' => 'required',
                    'product_id' => 'required|array',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $lastdata = proforma::orderBy('proforma_no', 'desc')->where('is_edit', '!=', '1')->first();
                if (empty($lastdata) || $lastdata == '' || $lastdata == NULL) {
                    $proforma_no = 'PR000001';
                } else {
                    $lastid = substr($lastdata->proforma_no, 2);
                    $proforma_no = 'PR'.str_pad(++$lastid, 6, '0', STR_PAD_LEFT);
                }
                $customer = customer::where('id', $request->customer_id)->first();

                $proforma = new proforma;
                $proforma->proforma_no = $proforma_no;
                $proforma->companie_id = $request->companie_id;
                $proforma->customer_id = $request->customer_id;
                $proforma->bank_id = $request->bank_id;
                $proforma->e_way_bill_no = $request->e_way_bill_no;
                $proforma->date = $request->date;
                $proforma->delivery_note = $request->delivery_note;
                $proforma->payment_mode_id = $request->payment_mode_id;
                $proforma->reference_no = $request->reference_no;
                $proforma->other_reference_no = $request->other_reference_no;
                $proforma->buyers_order_no = $request->buyers_order_no;
                $proforma->dated = $request->dated;
                $proforma->dispatch_doc_no = $request->dispatch_doc_no;
                $proforma->delivery_note_date = $request->delivery_note_date;
                $proforma->dispatched_through = $request->dispatched_through;
                $proforma->destination = $request->destination;
                $proforma->bill_of_lading = $request->bill_of_lading;
                $proforma->motor_vehicle_no = $request->vehicle_no;
                $proforma->round = $request->round;
                $proforma->total_amount = $request->gtotal;
                $proforma->word_amount = $request->word_amount;
                $proforma->status = $request->status;
                $proforma->terms_of_delivery = $request->terms_of_delivery;
                // $proforma->terms_of_delivery = $request->terms_of_delivery?htmlentities($request->terms_of_delivery):htmlentities($customer->terms);
                $proforma->add_by = Auth::user()->id;
                $proforma->save();
                if(isset($request->product_id)){
                    foreach ($request->product_id as $key => $value) {
                        $NEW_proforma_detal = new proforma_detal;
                        $NEW_proforma_detal->proforma_id = $proforma->id;
                        $NEW_proforma_detal->container_no = $request->container_no[$key];
                        $NEW_proforma_detal->no_and_kind_of_pkgs = $request->no_and_kind_of_pkgs[$key];
                        $NEW_proforma_detal->product_id = $request->product_id[$key];
                        $NEW_proforma_detal->HSN_code = $request->hsn[$key];
                        $NEW_proforma_detal->quantity = $request->qty[$key];
                        $NEW_proforma_detal->rate = $request->rate[$key];
                        $NEW_proforma_detal->per = $request->per[$key];
                        $NEW_proforma_detal->amount = $request->Amo[$key];
                        $NEW_proforma_detal->add_by = Auth::user()->id;
                        $NEW_proforma_detal->save();
                    }
                }
                if(isset($request->tax_id)){
                    foreach ($request->tax_id as $key => $value2) {
                        $NEW_proforma_tax = new proforma_tax;
                        $NEW_proforma_tax->proforma_id = $proforma->id;
                        $NEW_proforma_tax->tax_id = $request->tax_id[$key];
                        $NEW_proforma_tax->amount = $request->tax_a[$key];
                        $NEW_proforma_tax->add_by = Auth::user()->id;
                        $NEW_proforma_tax->save();
                    }
                }

                $output = array('success' => true, 'msg' => 'Proforma added Successfully');
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
        $proforma_data = proforma::where('id', $id)->first();
        $proforma = proforma::with(['company', 'company.Banks' => function($q) use($proforma_data){
            $q->where('id', $proforma_data->bank_id);
        }, 'payment_mode', 'customer', 'proforma_detal', 'proforma_detal.product', 'proforma_tax', 'proforma_tax.tax'])->where('id', $id)->first();
     
        return view('proforma.show')->with(compact('proforma'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $re_no = date('dHmiys');
        $proforma = proforma::with(['proforma_detal', 'proforma_tax'])->where('id', $id)->first();
        $company = company::where('status', '=','Active')->pluck('name', 'id');
        $customer = customer::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        $payment = payment_mode::where('status', '=','Active')->pluck('name','id');
        $bank = Banks::where('company_id', $proforma->companie_id)->where('status', '=','Active')->pluck('name','id');
        $product = product::where('status', '=','Active')->get();
        $tax = tax::where('status', '=','Active')->get();
        // dd($bank);
        return view('proforma.edit')->with(compact('proforma', 'company', 'customer', 'payment', 'bank', 'product', 'tax', 're_no'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                // dd($request->all(), $request->per[0]);
                $validator = Validator::make($request->all(), [
                    'companie_id' => 'required',
                    'customer_id' => 'required',
                    'bank_id' => 'required',
                    'payment_mode_id' => 'required',
                    'date' => 'required|date',
                    'status' => 'required',
                    'word_amount' => 'required',
                    // 'terms_of_delivery' => 'required',
                    'product_id' => 'required|array',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }
                proforma::where('id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                proforma_detal::where('proforma_id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                proforma_tax::where('proforma_id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                $lastdata = proforma::where('id', $id)->first();

                $proforma = new proforma;
                $proforma->proforma_no = $lastdata->proforma_no;
                $proforma->companie_id = $request->companie_id;
                $proforma->customer_id = $request->customer_id;
                $proforma->bank_id = $request->bank_id;
                $proforma->e_way_bill_no = $request->e_way_bill_no;
                $proforma->date = $request->date;
                $proforma->delivery_note = $request->delivery_note;
                $proforma->payment_mode_id = $request->payment_mode_id;
                $proforma->reference_no = $request->reference_no;
                $proforma->other_reference_no = $request->other_reference_no;
                $proforma->buyers_order_no = $request->buyers_order_no;
                $proforma->dated = $request->dated;
                $proforma->dispatch_doc_no = $request->dispatch_doc_no;
                $proforma->delivery_note_date = $request->delivery_note_date;
                $proforma->dispatched_through = $request->dispatched_through;
                $proforma->destination = $request->destination;
                $proforma->bill_of_lading = $request->bill_of_lading;
                $proforma->motor_vehicle_no = $request->vehicle_no;
                $proforma->round = $request->round;
                $proforma->total_amount = $request->gtotal;
                $proforma->word_amount = $request->word_amount;
                $proforma->status = $request->status;
                $proforma->terms_of_delivery = $request->terms_of_delivery;
                $proforma->add_by = Auth::user()->id;
                $proforma->save();
                if(isset($request->product_id)){
                    foreach ($request->product_id as $key => $value) {
                        $NEW_proforma_detal = new proforma_detal;
                        $NEW_proforma_detal->proforma_id = $proforma->id;
                        $NEW_proforma_detal->container_no = $request->container_no[$key];
                        $NEW_proforma_detal->no_and_kind_of_pkgs = $request->no_and_kind_of_pkgs[$key];
                        $NEW_proforma_detal->product_id = $request->product_id[$key];
                        $NEW_proforma_detal->HSN_code = $request->hsn[$key];
                        $NEW_proforma_detal->quantity = $request->qty[$key];
                        $NEW_proforma_detal->rate = $request->rate[$key];
                        $NEW_proforma_detal->per = $request->per[$key];
                        $NEW_proforma_detal->amount = $request->Amo[$key];
                        $NEW_proforma_detal->add_by = Auth::user()->id;
                        $NEW_proforma_detal->save();
                    }
                }
                if(isset($request->tax_id)){
                    foreach ($request->tax_id as $key => $value2) {
                        $NEW_proforma_tax = new proforma_tax;
                        $NEW_proforma_tax->proforma_id = $proforma->id;
                        $NEW_proforma_tax->tax_id = $request->tax_id[$key];
                        $NEW_proforma_tax->amount = $request->tax_a[$key];
                        $NEW_proforma_tax->add_by = Auth::user()->id;
                        $NEW_proforma_tax->save();
                    }
                }

                $output = array('success' => true, 'msg' => 'Proforma Upadated Successfully');
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
    public function destroy(proforma $proforma)
    {
        //
    }
}
