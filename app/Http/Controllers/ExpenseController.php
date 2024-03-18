<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\expense_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $expense = expense::with(['expense_type'])->get();
            // dd($expense_type);
            return Datatables::of($expense)
            ->addColumn( 'img', url('/'))->escapeColumns(['img'])
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\ExpenseController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('expense.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expense_type = expense_type::where('status', '=','Active')->pluck('name','id');
        return view('expense.create')->with(compact('expense_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                if($request->is_bill == 'No'){
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'expense_type_id' => 'required',
                        'date' => 'required|date|date_format:Y-m-d',
                        'amount' => 'required',
                        'is_bill' => 'required',
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'expense_type_id' => 'required',
                        'date' => 'required|date|date_format:Y-m-d',
                        'amount' => 'required',
                        'is_bill' => 'required',
                        'bill_img' => 'required',
                    ]);
                }
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $bill_name = '';
                if($request->hasfile('bill_img'))
                {
                    $bill_name = 'BIl'.date('dHmiys').'.'.$request->bill_img->extension();  
                    $request->bill_img->move(public_path('uploads/bill'), $bill_name);
                }

                $input = $request->all();
                $input['bill_img'] = $bill_name;
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                $taxe = expense::create($input);
                $output = array('success' => true, 'msg' => 'expense added Successfully');
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
    public function show(expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = expense::where('id', $id)->first();
        $expense_type = expense_type::where('status', '=','Active')->pluck('name','id');
        return view('expense.edit')->with(compact('expense_type', 'expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $expense = expense::where('id',$id)->first();
                if($expense->is_bill == 'Yes'){
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'expense_type_id' => 'required',
                        'date' => 'required|date|date_format:Y-m-d',
                        'amount' => 'required',
                        'is_bill' => 'required',
                    ]);
                } else if($request->is_bill == 'No'){
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'expense_type_id' => 'required',
                        'date' => 'required|date|date_format:Y-m-d',
                        'amount' => 'required',
                        'is_bill' => 'required',
                    ]);
                }else {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'expense_type_id' => 'required',
                        'date' => 'required|date|date_format:Y-m-d',
                        'amount' => 'required',
                        'is_bill' => 'required',
                        'bill_img' => 'required',
                    ]);
                }
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $bill_name = '';
                if($request->hasfile('bill_img'))
                {
                    $bill_name = 'BIl'.date('dHmiys').'.'.$request->bill_img->extension();  
                    $request->bill_img->move(public_path('uploads/bill'), $bill_name);
                }
                if($bill_name){
                    $expense->bill_img = $bill_name;
                }
                $expense->name = $request->name;
                $expense->expense_type_id = $request->expense_type_id;
                $expense->date = $request->date;
                $expense->amount = $request->amount;
                $expense->is_bill = $request->is_bill;
                $expense->add_by = Auth::user()->id;
                if ($expense->save()) {
                    $output = array('success' => true, 'msg' => 'Expense updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Expense not updated Successfully');
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
    public function destroy(expense $expense)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = expense::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                return '1';
            }
        }
        return '0';
    }
}
