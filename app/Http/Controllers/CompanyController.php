<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $company = company::get();
            return Datatables::of($company)
                ->addColumn( 'img',
                url('/')
                )->escapeColumns(['img'])
                ->addColumn( 'action',
                    '<button data-href="{{action(\'App\Http\Controllers\CompanyController@edit\', [$id])}}" class="edit-icon btn text-center text-white rounded-circle p-2 cus_form_open_btn" data-container=".company_add_modal"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="" data-original-title="Edit"></i></button>'
                )->escapeColumns(['action'])->setRowClass('text-center')->make(true);
        }
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => ['required',Rule::unique('companies')->where(function (Builder $query) use($request) {
                        return $query->where('name', $request->name);
                    })],
                    'phone' => 'required|size:10',
                    'email' => 'required|email',
                    'address' => 'required',
                    'logo' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zipcode' => 'required|size:6',
                    'pan_card_no' => 'required|size:10',
                    'GST' => 'required|size:15',
                    // 'declaration' => 'required',
                    // 'terms' => 'required',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $filename = '';
                if($request->hasfile('logo'))
                {
                    $filename = 'COM'.date('dHmiys').'.'.$request->logo->extension();  
                    $request->logo->move(public_path('uploads/logo'), $filename);
                }

                $input = $request->all();
                $input['logo'] = $filename;
                $input['declaration'] = htmlentities($request->declaration);
                $input['terms'] = htmlentities($request->terms);
                $input['status'] = 'Active';
                $input['add_by'] = Auth::user()->id;
                $taxe = company::create($input);
                $output = array('success' => true, 'msg' => 'Company added Successfully');
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
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = company::where('id',$id)->first();
        return view('company.edit')->with(compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => ['required',Rule::unique('companies')->where(function (Builder $query) use($request, $id) {
                        return $query->where('name', $request->name)->where('id', '!=', $id);
                    })],
                    'phone' => 'required|size:10',
                    'email' => 'required|email',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zipcode' => 'required|size:6',
                    'pan_card_no' => 'required|size:10',
                    'GST' => 'required|size:15',
                    // 'declaration' => 'required',
                    // 'terms' => 'required',
                ]);
                if ($validator->fails()) {
                    $output = array( 'success' => false, 'data' => $validator->errors(), 'msg' => 'Something went wrong, please try again');
                    return $output;
                }

                $filename = '';
                if($request->hasfile('logo'))
                {
                    $filename = 'COM'.date('dHmiys').'.'.$request->logo->extension();  
                    $request->logo->move(public_path('uploads/logo'), $filename);
                }

                $company = company::where('id',$id)->first();
                $company->name = $request->name;
                $company->phone = $request->phone;
                $company->email = $request->email;
                $company->address = $request->address;
                $company->city = $request->city;
                $company->state = $request->state;
                $company->zipcode = $request->zipcode;
                $company->pan_card_no = $request->pan_card_no;
                $company->GST = $request->GST;
                // $company->declaration = $request->declaration;
                // $company->terms = $request->terms;
                $company->add_by = Auth::user()->id;
                if($filename){
                    $company->logo = $filename;
                }
                if($company->save()){
                    $output = array('success' => true, 'msg' => 'Company updated Successfully');
                } else {
                    $output = array('success' => true, 'msg' => 'Company not updated Successfully');
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
    public function destroy(company $company)
    {
        //
    }
    public function status(Request $request)
    {
        $old_data = company::where('id', '=', $request->id)->first();
        if($old_data){
            $old_data->status = $request->status;
            if ($old_data->save()) {
                return '1';
            }
        }
        return '0';
    }
}
