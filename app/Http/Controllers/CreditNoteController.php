<?php

namespace App\Http\Controllers;

use App\Models\{ credit_note, credit_note_detals, credit_note_tax, invoice, company, customer, payment_mode, product, tax };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $credit_note = credit_note::with(['company', 'customer'])->where('is_edit', '!=', '1')->get();
            return Datatables::of($credit_note)
                ->addColumn( 'edit',
                    '<button data-href="{{action(\'App\Http\Controllers\CreditNoteController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['edit'])
                ->addColumn( 'edita',
                    '<button class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 "><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['edita'])
                ->addColumn( 'action',
                '<button data-href="{{action(\'App\Http\Controllers\CreditNoteController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>'
                )->escapeColumns(['action'])
                ->setRowClass('text-center')->make(true);
        }
        return view('credit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $re_no = date('dHmiys');
        $company = company::where('status', '=','Active')->pluck('name', 'id');
        $customer = customer::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        return view('credit.create')->with(compact('company', 'customer', 're_no'));
    }

    public function invoice_list(Request $request){
        $this->invoice_formate($request->companie, $request->customer, $request->inv);
    }


    public function invoice_formate($companie_id, $customer_id, $inv){
        $invoice = invoice::with(['receipt'])->where('companie_id', $companie_id)->where('customer_id', $customer_id)->where('status', 'Approved')->where('is_edit', '!=', '1');
        if ($inv) {
            $invoice->where('invoice_no', $inv);    
        }
        $invoice = $invoice->get();
        $data = [];
        $kd = 1;
        foreach ($invoice as $key => $value) {
            
            $remaining_amount = 0.00;
            $payed_amount = 0.00;
            if (sizeof($value->receipt) != 0) {
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
                $data[$kd]['payed'] = $payed_amount;
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
                $validator = Validator::make($request->all(), [
                    'companie_id' => 'required',
                    'customer_id' => 'required',
                    'invoice_no' => ['required',Rule::unique('credit_notes')->where(function (Builder $query) use($request) {
                        return $query->where('invoice_no', $request->invoice_no)->where('is_edit', '!=', '1');
                    })],
                    'date' => 'required|date',
                    'status' => 'required',
                    'credit_amount' => 'required',
                    'credit_word_amount' => 'required',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $lastdata = credit_note::orderBy('credit_no', 'desc')->where('is_edit', '!=', '1')->first();
                if (empty($lastdata) || $lastdata == '' || $lastdata == NULL) {
                    $credit_no = 'CR000001';
                } else {
                    $lastid = substr($lastdata->credit_no, 2);
                    $credit_no = 'CR'.str_pad(++$lastid, 6, '0', STR_PAD_LEFT);
                }
                $invoice = invoice::with(['invoice_detal', 'invoice_tax'])->where('invoice_no', $request->invoice_no)->where('is_edit', '!=', '1')->first();
                // dd($invoice);
                $credit_note = new credit_note;
                $credit_note->companie_id = $request->companie_id;
                $credit_note->payment_mode_id = $invoice->payment_mode_id;
                $credit_note->customer_id = $request->customer_id;
                $credit_note->invoice_no = $invoice->invoice_no;
                $credit_note->credit_no = $credit_no;
                $credit_note->e_way_bill_no = $invoice->e_way_bill_no;
                $credit_note->date = $request->date;
                $credit_note->reference_no = $invoice->reference_no;
                $credit_note->other_reference_no = $invoice->other_reference_no;
                $credit_note->buyers_order_no = $invoice->buyers_order_no;
                $credit_note->dated = $invoice->dated;
                $credit_note->dispatch_doc_no = $invoice->dispatch_doc_no;
                $credit_note->delivery_note_date = $invoice->delivery_note_date;
                $credit_note->dispatched_through = $invoice->dispatched_through;
                $credit_note->destination = $invoice->destination;
                $credit_note->terms_of_delivery = $invoice->terms_of_delivery;
                $credit_note->round = $invoice->round;
                $credit_note->total_amount = $invoice->total_amount;
                $credit_note->word_amount = $invoice->word_amount;
                $credit_note->status = $request->status;
                $credit_note->credit_amount = $request->credit_amount;
                $credit_note->credit_word_amount = $request->credit_word_amount;
                $credit_note->remark = $request->remark;
                $credit_note->add_by = Auth::user()->id;
                $credit_note->save();
                if(isset($invoice->invoice_detal)){
                    foreach ($invoice->invoice_detal as $key => $value) {
                        $NEW_credit_note_detals = new credit_note_detals;
                        $NEW_credit_note_detals->credit_id = $credit_note->id;
                        $NEW_credit_note_detals->product_id = $value->product_id;
                        $NEW_credit_note_detals->HSN_code = $value->HSN_code;
                        $NEW_credit_note_detals->quantity = $value->quantity;
                        $NEW_credit_note_detals->rate = $value->rate;
                        $NEW_credit_note_detals->per = $value->per;
                        $NEW_credit_note_detals->amount = $value->amount;
                        $NEW_credit_note_detals->add_by = Auth::user()->id;
                        $NEW_credit_note_detals->save();
                    }
                }
                if(isset($invoice->invoice_tax)){
                    foreach ($invoice->invoice_tax as $key => $value2) {
                        $NEW_credit_note_tax = new credit_note_tax;
                        $NEW_credit_note_tax->credit_id = $credit_note->id;
                        $NEW_credit_note_tax->tax_id = $value2->tax_id;
                        $NEW_credit_note_tax->amount = $value2->amount;
                        $NEW_credit_note_tax->add_by = Auth::user()->id;
                        $NEW_credit_note_tax->save();
                    }
                }

                $output = array('success' => true, 'msg' => 'Credit Note added Successfully');
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
    public function show(credit_note $credit_note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $re_no = date('dHmiys');
        $credit_note_data = credit_note::where('id', $id)->first();
        $credit_note = credit_note::with(['company', 'company.Banks' => function($q) use($credit_note_data){
            $q->where('id', $credit_note_data->bank_id);
        }, 'payment_mode', 'customer', 'credit_note_detal', 'credit_note_detal.product', 'credit_note_tax', 'credit_note_tax.tax'])->where('id', $id)->first();
       
        $credit_data = $this->invoice_formate($credit_note->companie_id, $credit_note->customer_id, $credit_note->invoice_no);
        $payment = payment_mode::where('status', '=','Active')->pluck('name','id');

        return view('credit.edit')->with(compact('credit_note', 're_no', 'credit_data', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'payment_mode_id' => 'required',
                    'date' => 'required|date',
                    'status' => 'required',
                    'credit_amount' => 'required',
                    'credit_word_amount' => 'required',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $credit_note = credit_note::where('id', $id)->first();
                
                $credit_note->payment_mode_id = $request->payment_mode_id;
                $credit_note->e_way_bill_no = $request->e_way_bill_no;
                $credit_note->date = $request->date;
                $credit_note->reference_no = $request->reference_no;
                $credit_note->other_reference_no = $request->other_reference_no;
                $credit_note->buyers_order_no = $request->buyers_order_no;
                $credit_note->dated = $request->dated;
                $credit_note->dispatch_doc_no = $request->dispatch_doc_no;
                $credit_note->delivery_note_date = $request->delivery_note_date;
                $credit_note->dispatched_through = $request->dispatched_through;
                $credit_note->destination = $request->destination;
                $credit_note->terms_of_delivery = $request->terms_of_delivery;
                $credit_note->status = $request->status;
                $credit_note->credit_amount = $request->credit_amount;
                $credit_note->credit_word_amount = $request->credit_word_amount;
                $credit_note->add_by = Auth::user()->id;
                $credit_note->save();

                $output = array('success' => true, 'msg' => 'Credit Note update Successfully');
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
    public function destroy(credit_note $credit_note)
    {
        //
    }
}
