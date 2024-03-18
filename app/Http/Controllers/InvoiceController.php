<?php

namespace App\Http\Controllers;

    use App\Models\{ invoice, invoice_detal, invoice_tax,  payment_mode, company, customer, Banks, product, tax};
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\DB;
    use Yajra\Datatables\Datatables;
    use Illuminate\Validation\Rule;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $invoice = invoice::with(['company', 'customer'])->where('is_edit', '!=', '1')->get();
            return Datatables::of($invoice)
                ->addColumn( 'edit',
                    '<button data-href="{{action(\'App\Http\Controllers\InvoiceController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['edit'])
                ->addColumn( 'edita',
                    '<button class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 "><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['edita'])
                ->addColumn( 'action',
                '<button data-href="{{action(\'App\Http\Controllers\InvoiceController@show\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 mr-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="show"></i></button>'
                )->escapeColumns(['action'])
                ->setRowClass('text-center')->make(true);
        }
        return view('invoice.index');
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
        return view('invoice.create')->with(compact('company', 'customer', 'payment', 're_no'));
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

                $lastdata = invoice::orderBy('invoice_no', 'desc')->where('is_edit', '!=', '1')->first();
                if (empty($lastdata) || $lastdata == '' || $lastdata == NULL) {
                    $invoice_no = 'IN000001';
                } else {
                    $lastid = substr($lastdata->invoice_no, 2);
                    $invoice_no = 'IN'.str_pad(++$lastid, 6, '0', STR_PAD_LEFT);
                }

                $invoice = new invoice;
                $invoice->invoice_no = $invoice_no;
                $invoice->companie_id = $request->companie_id;
                $invoice->customer_id = $request->customer_id;
                $invoice->bank_id = $request->bank_id;
                $invoice->e_way_bill_no = $request->e_way_bill_no;
                $invoice->date = $request->date;
                $invoice->delivery_note = $request->delivery_note;
                $invoice->payment_mode_id = $request->payment_mode_id;
                $invoice->reference_no = $request->reference_no;
                $invoice->other_reference_no = $request->other_reference_no;
                $invoice->buyers_order_no = $request->buyers_order_no;
                $invoice->dated = $request->dated;
                $invoice->dispatch_doc_no = $request->dispatch_doc_no;
                $invoice->delivery_note_date = $request->delivery_note_date;
                $invoice->dispatched_through = $request->dispatched_through;
                $invoice->destination = $request->destination;
                $invoice->bill_of_lading = $request->bill_of_lading;
                $invoice->motor_vehicle_no = $request->vehicle_no;
                $invoice->round = $request->round;
                $invoice->total_amount = $request->gtotal;
                $invoice->word_amount = $request->word_amount;
                $invoice->status = $request->status;
                $invoice->terms_of_delivery = $request->terms_of_delivery;
                // $invoice->terms_of_delivery = $request->terms_of_delivery?htmlentities($request->terms_of_delivery):htmlentities($customer->terms);
                $invoice->add_by = Auth::user()->id;
                $invoice->save();
                if(isset($request->product_id)){
                    foreach ($request->product_id as $key => $value) {
                        $NEW_invoice_detal = new invoice_detal;
                        $NEW_invoice_detal->invoice_id = $invoice->id;
                        $NEW_invoice_detal->container_no = $request->container_no[$key];
                        $NEW_invoice_detal->no_and_kind_of_pkgs = $request->no_and_kind_of_pkgs[$key];
                        $NEW_invoice_detal->product_id = $request->product_id[$key];
                        $NEW_invoice_detal->HSN_code = $request->hsn[$key];
                        $NEW_invoice_detal->quantity = $request->qty[$key];
                        $NEW_invoice_detal->rate = $request->rate[$key];
                        $NEW_invoice_detal->per = $request->per[$key];
                        $NEW_invoice_detal->amount = $request->Amo[$key];
                        $NEW_invoice_detal->add_by = Auth::user()->id;
                        $NEW_invoice_detal->save();
                    }
                }
                if(isset($request->tax_id)){
                    foreach ($request->tax_id as $key => $value2) {
                        $NEW_invoice_tax = new invoice_tax;
                        $NEW_invoice_tax->invoice_id = $invoice->id;
                        $NEW_invoice_tax->tax_id = $request->tax_id[$key];
                        $NEW_invoice_tax->amount = $request->tax_a[$key];
                        $NEW_invoice_tax->add_by = Auth::user()->id;
                        $NEW_invoice_tax->save();
                    }
                }

                $output = array('success' => true, 'msg' => 'Invoice added Successfully');
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
        $invoice_data = invoice::where('id', $id)->first();
        $invoice = invoice::with(['company', 'company.Banks' => function($q) use($invoice_data){
            $q->where('id', $invoice_data->bank_id);
        }, 'payment_mode', 'customer', 'invoice_detal', 'invoice_detal.product', 'invoice_tax', 'invoice_tax.tax'])->where('id', $id)->first();
     
        return view('invoice.show')->with(compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $re_no = date('dHmiys');
        $invoice = invoice::with(['invoice_detal', 'invoice_tax'])->where('id', $id)->first();
        $company = company::where('status', '=','Active')->pluck('name', 'id');
        $customer = customer::where('status', '=','Active')->select('company_name', 'first_name', 'id')->get();
        $payment = payment_mode::where('status', '=','Active')->pluck('name','id');
        $bank = Banks::where('company_id', $invoice->companie_id)->where('status', '=','Active')->pluck('name','id');
        $product = product::where('status', '=','Active')->get();
        $tax = tax::where('status', '=','Active')->get();
        // dd($bank);
        return view('invoice.edit')->with(compact('invoice', 'company', 'customer', 'payment', 'bank', 'product', 'tax', 're_no'));
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
                invoice::where('id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                invoice_detal::where('invoice_id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                invoice_tax::where('invoice_id', $id)->update(['is_edit' => '1', 'edit_date' => date('Y-m-d')]);
                $lastdata = invoice::where('id', $id)->first();

                $invoice = new invoice;
                $invoice->invoice_no = $lastdata->invoice_no;
                $invoice->companie_id = $request->companie_id;
                $invoice->customer_id = $request->customer_id;
                $invoice->bank_id = $request->bank_id;
                $invoice->e_way_bill_no = $request->e_way_bill_no;
                $invoice->date = $request->date;
                $invoice->delivery_note = $request->delivery_note;
                $invoice->payment_mode_id = $request->payment_mode_id;
                $invoice->reference_no = $request->reference_no;
                $invoice->other_reference_no = $request->other_reference_no;
                $invoice->buyers_order_no = $request->buyers_order_no;
                $invoice->dated = $request->dated;
                $invoice->dispatch_doc_no = $request->dispatch_doc_no;
                $invoice->delivery_note_date = $request->delivery_note_date;
                $invoice->dispatched_through = $request->dispatched_through;
                $invoice->destination = $request->destination;
                $invoice->bill_of_lading = $request->bill_of_lading;
                $invoice->motor_vehicle_no = $request->vehicle_no;
                $invoice->round = $request->round;
                $invoice->total_amount = $request->gtotal;
                $invoice->word_amount = $request->word_amount;
                $invoice->status = $request->status;
                $invoice->terms_of_delivery = $request->terms_of_delivery;
                $invoice->add_by = Auth::user()->id;
                $invoice->save();
                if(isset($request->product_id)){
                    foreach ($request->product_id as $key => $value) {
                        $NEW_invoice_detal = new invoice_detal;
                        $NEW_invoice_detal->invoice_id = $invoice->id;
                        $NEW_invoice_detal->container_no = $request->container_no[$key];
                        $NEW_invoice_detal->no_and_kind_of_pkgs = $request->no_and_kind_of_pkgs[$key];
                        $NEW_invoice_detal->product_id = $request->product_id[$key];
                        $NEW_invoice_detal->HSN_code = $request->hsn[$key];
                        $NEW_invoice_detal->quantity = $request->qty[$key];
                        $NEW_invoice_detal->rate = $request->rate[$key];
                        $NEW_invoice_detal->per = $request->per[$key];
                        $NEW_invoice_detal->amount = $request->Amo[$key];
                        $NEW_invoice_detal->add_by = Auth::user()->id;
                        $NEW_invoice_detal->save();
                    }
                }
                if(isset($request->tax_id)){
                    foreach ($request->tax_id as $key => $value2) {
                        $NEW_invoice_tax = new invoice_tax;
                        $NEW_invoice_tax->invoice_id = $invoice->id;
                        $NEW_invoice_tax->tax_id = $request->tax_id[$key];
                        $NEW_invoice_tax->amount = $request->tax_a[$key];
                        $NEW_invoice_tax->add_by = Auth::user()->id;
                        $NEW_invoice_tax->save();
                    }
                }

                $output = array('success' => true, 'msg' => 'Invoice Upadated Successfully');
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
    public function destroy(invoice $invoice)
    {
        //
    }
}
