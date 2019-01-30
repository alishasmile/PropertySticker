<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function createMember(Request $request){
    	$member = new \App\Member;
    	$user = $request->input('user');
    	$member -> user = $user;
    	$token = $request->input('token');
    	$member -> token = Hash::make($token);
    	$member->save();

    	return 'success';
    }
}
