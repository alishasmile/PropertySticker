<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    //
    

    public function token_check(Request $request)
    {
    	$result = array();
		$token_input = $request->input('token');
		$b = 1;

		$getusers = \App\Member::all();
		foreach ($getusers as $user) {
			if (Hash::check($token_input, $user->token)) {
				session(['user' => $user->user]);
	        	$result['status'] = 'success';
	        	$result['user'] = $user->user;
	        	$b = 0;
			}
		}

		if($b){ 
			$result['status'] = 'failed';
			$result['error'] = 'no this token';
		}
		
		return response()->json($result);
    }

    public function session_check(Request $request)//進管理頁面前做的事情集合
    {
    	$getusers = \App\Member::all();
    	foreach ($getusers as $user) {
    		
    		if($status = $request->session()->has('user')){
                $getDataQuantity = \App\datum::all()->count();
    			return view('admin_test',['DataSize'=>$getDataQuantity]);
    		}
    		else{
    			return view('login');
    		}
    	}
    }

    public function logout(Request $request)
    {
    	$request->session()->forget('user');
    	return view('login');
    }

}
