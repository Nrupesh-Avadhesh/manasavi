<?php

namespace App\Http\Controllers;

use App\Models\payment_mode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $payment_mode = payment_mode::get();
            return Datatables::of($payment_mode)
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\PaymentModeController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('payment_mode.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment_mode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => ['required',Rule::unique('payment_modes')->where(function (Builder $query) use($request) {
                        return $query->where('name', $request->name);
                    })],
                    'description' => 'required',
                ]);

                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $input = $request->all();
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                $taxe = payment_mode::create($input);
                $output = array('success' => true, 'msg' => 'Payment Mode added Successfully');
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
    public function show(payment_mode $payment_mode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment_mode = payment_mode::where('id',$id)->first();
        return view('payment_mode.edit')->with(compact('payment_mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => ['required',Rule::unique('payment_modes')->where(function (Builder $query) use($request, $id) {
                        return $query->where('name', $request->name)->where('id', '!=',$id);
                    })],
                    'description' => 'required',
                ]);

                if ($validator->fails()) {
                    $output = array('success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $payment_mode = payment_mode::where('id', '=', $id)->first();
                $payment_mode->name = $request->name;
                $payment_mode->description = $request->description;
                $payment_mode->add_by = Auth::user()->id;
                

                if ($payment_mode->save()) {
                    $output = array('success' => true, 'msg' => 'Payment Mode updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Payment Mode not updated Successfully');
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
    public function destroy(payment_mode $payment_mode)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = payment_mode::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                return '1';
            }
        }
        return '0';
    }
}
