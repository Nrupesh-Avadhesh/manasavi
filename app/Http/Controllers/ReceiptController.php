<?php

namespace App\Http\Controllers;

use App\Models\{ receipt, invoice, company, customer };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $receipt = receipt::with(['company', 'customer'])->where('is_edit', '!=', '1')->get();
            return Datatables::of($receipt)
                ->addColumn( 'edit',
                    '<button data-href="{{action(\'App\Http\Controllers\ReceiptController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )
                ->addColumn( 'action',
                '<button data-href="{{action(\'App\Http\Controllers\ReceiptController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>'
                )->escapeColumns(['action'])
                ->setRowClass('text-center')->make(true);
        }
        return view('receipt.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $re_no = date('dHmiys');
        $company = company::where('status', '=','Active')->pluck('name', 'id');
        $customer = customer::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        return view('receipt.create')->with(compact('company', 'customer', 're_no'));
    }

    public function invoice_list(Request $request){
        $invoice = invoice::with(['receipt', 'credit_note'])->where('companie_id', $request->companie)->where('customer_id', $request->customer)->where('status', 'Approved')->where('is_edit', '!=', '1')->get();
        // dd($invoice);
        $data = [];
        $kd = 1;
        foreach ($invoice as $key => $value) {
            
            $remaining_amount = 0.00;
            $credit_note_amount = 0.00;
            $credit_note_no = '';
            if (sizeof($value->credit_note) != 0) {
                foreach ($value->credit_note as $key3 => $value3) {
                    $credit_note_amount += $value3->credit_amount;
                    if($key3 == 0){
                        $credit_note_no = $value3->credit_no;
                    } else {
                        $credit_note_no = $credit_note_no.', '.$value3->credit_no;
                    }
                }
                $remaining_amount -= $credit_note_amount;
            }
            if (sizeof($value->receipt) != 0) {
                $payed_amount = 0.00;

                foreach ($value->receipt as $key2 => $value2) {
                    $payed_amount += $value2->payble_amount;
                }
                $remaining_amount = $value->total_amount - $payed_amount;
            } else {
                $remaining_amount = $value->total_amount;
            }

            if($remaining_amount != 0 && $remaining_amount != 0.00){
                $data[$kd]['id'] = $value->invoice_no;
                $data[$kd]['invoice_no'] = $value->invoice_no;
                $data[$kd]['date'] = $value->date;
                $data[$kd]['amount'] = $value->total_amount;
                $data[$kd]['credit_note_no'] = $credit_note_no;
                $data[$kd]['credit_note_amount'] = $credit_note_amount;
                $data[$kd]['remaining_amount'] = $remaining_amount;
                $kd++;
            }
        }

        return $data;
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
                    'payment_method' => 'required',
                    
                    'id' => 'required|array',
                    'amount' => 'required|array',
                    'remaining_amount' => 'required|array',
                    'payble_amount' => 'required|array',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                if (isset($request->payble_amount)) {
                    foreach ($request->payble_amount as $key => $val) {
                        if($val && $val > 0){
                            $lastdata = receipt::orderBy('receipt_no', 'desc')->where('is_edit', '!=', '1')->first();
                            if (empty($lastdata) || $lastdata == '' || $lastdata == NULL) {
                                $receipt_no = 'RE000001';
                            } else {
                                $lastid = substr($lastdata->receipt_no, 2);
                                $receipt_no = 'RE'.str_pad(++$lastid, 6, '0', STR_PAD_LEFT);
                            }
                            $receipt = new receipt;
                            $receipt->companie_id = $request->companie_id;
                            $receipt->customer_id = $request->customer_id;
                            $receipt->invoice_no = $request->id[$key];
                            $receipt->receipt_no = $receipt_no;
                            $receipt->date = date('Y-m-d');
                            $receipt->amount = $request->amount[$key];
                            $receipt->remaining_amount = $request->remaining_amount[$key];
                            $receipt->payble_amount = $request->payble_amount[$key];
                            $receipt->remark = $request->remark;
                            $receipt->payment_method = $request->payment_method;
                            $receipt->utr_no = $request->utr_no;
                            $receipt->bank_name = $request->bank_name;
                            $receipt->branch = $request->branch;
                            $receipt->cheque_no = $request->cheque_no;
                            $receipt->cheque_date = $request->cheque_date;
                            $receipt->add_by = Auth::user()->id;
                            $receipt->save();
                        }
                    }

                }


                $output = array('success' => true, 'msg' => 'Receipt added Successfully');
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
        $receipt = receipt::where('id', $id)->first();
        $company = company::where('id', $receipt->companie_id)->where('status', '=','Active')->first();
        $customer = customer::where('id', $receipt->customer_id)->select('company_name', 'first_name', 'id')->first();
        return view('receipt.show')->with(compact('company', 'customer', 'receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $re_no = date('dHmiys');
        $receipt = receipt::where('id', $id)->first();
        $company = company::where('id', $receipt->companie_id)->where('status', '=','Active')->first();
        $customer = customer::where('id', $receipt->customer_id)->select('company_name', 'first_name', 'id')->first();
        return view('receipt.edit')->with(compact('company', 'customer', 're_no', 'receipt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $receipt = receipt::where('id', $id)->first();
                $receipt->remark = $request->remark;
                $receipt->payment_method = $request->payment_method;
                if($request->payment_method == 'Cheque'){
                    $receipt->bank_name = $request->bank_name;
                    $receipt->branch = $request->branch;
                    $receipt->cheque_no = $request->cheque_no;
                    $receipt->cheque_date = $request->cheque_date;
                    $receipt->utr_no = '';
                } else if($request->payment_method == 'Electronics Transfer'){
                    $receipt->bank_name = $request->bank_name;
                    $receipt->branch = $request->branch;
                    $receipt->utr_no = $request->utr_no;
                    $receipt->cheque_no = '';
                    $receipt->cheque_date = null;
                } else {
                    $receipt->bank_name = '';
                    $receipt->branch = '';
                    $receipt->cheque_no = '';
                    $receipt->cheque_date = null;
                    $receipt->utr_no = '';
                }
                $receipt->add_by = Auth::user()->id;
                if($receipt->save()){
                    $output = array('success' => true, 'msg' => 'Receipt Update Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Receipt Not Update Successfully');
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
    public function destroy(receipt $receipt)
    {
        //
    }
}
