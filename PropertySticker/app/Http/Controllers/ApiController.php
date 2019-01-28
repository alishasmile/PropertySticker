<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    //

    public function reponse_property(Request $request)//API
    {
        $property_id = $request->input('property_id');
        //$token = $request->input('token');
        
        //error: 1.user wrong 2.no this property 

/*
        $geterror_user = \App\datum::where('token', $token)->exists();
        if($geterror_user == false){
        	return response()->json([
	        	'status' => 'failed',
			    'error type' => 1,
				'error message' => 'user wrong',
			]);
	    }
	    else{
*/	    
	    	$geterror_property = \App\datum::where('property_id', $property_id)->exists();
	        if($geterror_property == true){
	        	$getname = \App\datum::where('property_id', $property_id)->first()->name;
	        	$getcomfirmed = \App\datum::where('property_id', $property_id)->first()->comfirmed;
	        	return response()->json([
		        	'status' => 'success',
				    'name' => $getname,//財產名稱
				    'comfirmed' => $getcomfirmed,//貼過沒
				]);
	        }
	        else{
	        	return response()->json([
		        	'status' => 'failed',
				    'error type' => 2,
				    'error message' => 'no this property',
				]);
	        }
//	    }
        
    }


    public function reponse_check(Request $request)//API2
    {
        $property_id = $request->input('property_id');
        //$note = $request->input('note');
        //$token = $request->input('token');

        $property= \App\datum::where('property_id', $property_id)->first();
        $getcomfirmed = $property->comfirmed;
        
        $Note = new \App\Note;
        //error 1.前後端不同(後端貼過還請求貼) 2.note放入資料出現錯誤(沒放成功)

        if($getcomfirmed == 1){//貼過 error 1.前後端不同(後端貼過還請求貼) 
        	return response()->json([
	        	'status' => 'failed',
			    'error type' => 1,
			    'error message' => 'Property has been sticked.',
			]);
        }
        else{
        	$Note -> property_id = $property_id;
        	//$Note -> content = $note;
        	//$Note -> user = $token;
        	$property->comfirmed = 1;

        	/*
	        if(){//error 2.note放入資料出現錯誤(沒放成功)
	        	return response()->json([
		        	'status' => 'failed',
				    'error type' => 2,
			    	'error message' => 'Note failed',
				]);
	        }
	        else{
	        */

        		$Note->save();
        		$property->save();
        	
	        	return response()->json([
		        	'status' => 'success',
				]);

			//}
        }
        
    }

}
