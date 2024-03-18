<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Hash;

class homeController extends Controller
{
    public function dashboard(){
        if (!Auth::check()) {
            return view('auth.login');
        } else {
            Log::info("admin get dashboard :- ");
            $data = [];
            $data['branch'] = 0;
            $data['vendor'] = 0;
            $data['product'] = 0;
            $data['quotation'] = 0;
            $data['act_req'] =0;
            $data['act_req_list'] = [];
            $data['act_bra_inv_list'] = [];
            $data['act_inv'] = 0;
            $data['act_inv_list'] = [];
            $data['below_par'] = 0;
            $data['below_par_list'] = [];
            return view('dashboard')->with(compact('data'));
        }
    }

    public function login(){
        if (!Auth::check()) {
            return view('auth.login');
        } else {
                return redirect()->route('dashboard');
                // Session::flush();
                // Auth::logout();
                // return redirect('/login');
        }
    }
    public function cpassword($pas){
        return Hash::make($pas);
    }

    public function login_attempt(Request $request){
        $request->validate([
            'user_name' => ['required'],
            'password' => ['required'],
        ]);
        $remember = ($request->remember) ? true : false;

        $auth = Auth::attempt(
            [
                'email'  => $request->user_name,
                'password'  => $request->password    
            ], $remember
        );
        if ($auth) {
            return redirect('/');

        } /* else {
           Session::flush();
           Auth::logout();
           return redirect('/');
       }   */

        return back()->withErrors(['user_name' => 'The provided credentials do not match our records.',])->onlyInput('user_name');

    }

    public function logout(Request $request){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
