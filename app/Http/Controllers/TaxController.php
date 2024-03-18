<?php

namespace App\Http\Controllers;

use App\Models\tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $tax = tax::get();
            return Datatables::of($tax)
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\TaxController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('tax.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => ['required',Rule::unique('taxes')->where(function (Builder $query) use($request) {
                        return $query->where('name', $request->name)->where('percentage', $request->percentage);
                    })],
                    'percentage' => 'required',
                    'description' => 'required',
                ]);

                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $input = $request->all();
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                tax::create($input);
                $output = array('success' => true, 'msg' => 'Tax added Successfully');
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
    public function show(tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tax= tax::where('id',$id)->first();
        return view('tax.edit')->with(compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => ['required',Rule::unique('taxes')->where(function (Builder $query) use($request, $id) {
                        return $query->where('name', $request->name)->where('percentage', $request->percentage)->where('id', '!=',$id);
                    })],
                    'percentage' => 'required',
                    'description' => 'required',
                ]);

                if ($validator->fails()) {
                    $output = array('success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $tax = tax::where('id', '=', $id)->first();
                $tax->name = $request->name;
                $tax->percentage = $request->percentage;
                $tax->description = $request->description;
                $tax->add_by = Auth::user()->id;
                

                if ($tax->save()) {
                    $output = array('success' => true, 'msg' => 'Tax updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Tax not updated Successfully');
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
    public function destroy(tax $tax)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = tax::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                return '1';
            }
        }
        return '0';
    }
}
