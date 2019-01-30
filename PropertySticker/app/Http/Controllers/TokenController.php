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
}
