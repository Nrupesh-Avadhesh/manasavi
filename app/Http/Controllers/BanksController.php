<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $Banks = Banks::with(['company'])->get();
            return Datatables::of($Banks)
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\BanksController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('banks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = company::where('status', '=','Active')->pluck('name','id');
        return view('banks.create')->with(compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'company' => 'required',
                    'name' => 'required',
                    'AC_number' => 'required|min:9|max:14',
                    'IFS_Code' => 'required|size:11',
                    'AC_Holder_Name' => 'required',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }


                $input = $request->all();
                $input['company_id'] = $request->company;
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                $taxe = Banks::create($input);
                $output = array('success' => true, 'msg' => 'Bank added Successfully');
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
    public function show(Banks $banks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bank = Banks::where('id', $id)->first();
        $company = company::where('status', '=','Active')->pluck('name','id');
        return view('banks.edit')->with(compact('company', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'company' => 'required',
                    'name' => 'required',
                    'AC_number' => 'required|min:9|max:14',
                    'IFS_Code' => 'required|size:11',
                    'AC_Holder_Name' => 'required',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }


                $Banks = Banks::where('id',$id)->first();
                $Banks->company_id = $request->company;
                $Banks->name = $request->name;
                $Banks->AC_number = $request->AC_number;
                $Banks->IFS_Code = $request->IFS_Code;
                $Banks->AC_Holder_Name = $request->AC_Holder_Name;
                $Banks->add_by = Auth::user()->id;
                if($Banks->save()){
                    $output = array('success' => true, 'msg' => 'Bank updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Bank not updated Successfully');
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
    public function destroy(Banks $banks)
    {
        //
    }

    public function status(Request $request)
    {
        $old_data = Banks::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                return '1';
            }
        }
        return '0';
    }
}
