<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
//use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    //
    public function convert_property_id($property_id_input){

        $pieces = explode("-", $property_id_input);
        $p2 = (string)((int)$pieces[2]);

        $property_id = $pieces[0].'-'.$pieces[1].'-'.$p2;

        return $property_id;
    }

    /*
    public function test(){
    	return $this->convert_property_id('103-3-0023');
    }
	*/

    public function reponse_property(Request $request)//API
    {

        $property_id = $this->convert_property_id($request->input('property_id'));

        //$token = $request->input('token');
        
        //error: 1.user wrong 2.no this property(contains barcode type error)

//type 1
        $geterror_user = \App\datum::where('token', $token)->exists();
        if($geterror_user == true){

            $geterror_property = \App\datum::where('property_id', $property_id)->exists();
            if($geterror_property == true){
                $getname = \App\datum::where('property_id', $property_id)->first()->name;
                $getconfirmed = \App\datum::where('property_id', $property_id)->first()->confirmed;
                return response()->json([
                    'status' => 'success',
                    'name' => $getname,//財產名稱
                    'confirmed' => $getconfirmed,//貼過沒
                ]);
            }
            else{
                return response()->json([
                    'status' => 'failed',
                    'error type' => 2,
                    'error message' => 'no this property',
                ]);
            }
	    }
	    else{	    
            
            return response()->json([
                'status' => 'failed',
                'error type' => 1,
                'error message' => 'user wrong',
            ]);

	    }
        
    }


    public function reponse_check(Request $request)//API2
    {
        $property_id = $this->convert_property_id($request->input('property_id'));
        
        //$note = $request->input('note');
        //$token = $request->input('token');

        $property= \App\datum::where('property_id', $property_id)->first();
        $getconfirmed = $property->confirmed;
        
        $Note = new \App\Note;
        //error 1.前後端不同(後端貼過還請求貼) 2.note放入資料出現錯誤(沒放成功)

        if($getconfirmed == 1){//貼過 error 1.前後端不同(後端貼過還請求貼) 
        	return response()->json([
	        	'status' => 'failed',
			    'error type' => 1,
			    'error message' => 'Property has been sticked.',
			]);
        }
        else{
        	$Note -> property_id = $property_id;
        	$Note -> content = $note;
        	//$Note -> user = $token;
        	$property->confirmed = 1;

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
