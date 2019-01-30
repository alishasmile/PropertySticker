<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search_count(Request $request)
    {
    	$result = array();
		$search_key = $request->input('search_key');

		

		while(){

		}

		$geterror_token = \App\Member::where('token', $token)->exist();
		if($geterror_token){
        	$getuser = \App\Member::where('token', $token)->first()->user;
        	$result['status'] = 'success';
        	$result['user'] = $getuser;
		}
		else{
			$result['status'] = 'failed';
			$result['error'] = 'no this token';
		}

		return response()->json($result);
    }
}
