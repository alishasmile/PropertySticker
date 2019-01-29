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

///////////////////////////////////////////////////////////////

//type 1
    public function reponse_property(Request $request)//API
    {


        //error: 1.user wrong 2.no this property(contains format error)

        $result = array();
        
/*
        $token = $request->input('token');
        $geterror_user = \App\datum::where('token', $token)->exists();
        if($geterror_user == false){
            $result['status'] = 'failed';
            $result['error type'] = 1;
            $result['error message'] = 'user wrong';
        }
        else{
*/
            $property_id_input = $request->input('property_id');

            $no_property = 1;

            if(substr_count($property_id_input, '-') == 2){//two dash?

                $property_id = $this->convert_property_id($property_id_input);
                $geterror_property = \App\datum::where('property_id', $property_id)->exists();
                //$geterror_property is format correct but no property
                if($geterror_property){ $no_property = 0; }

            }


            if($no_property){//$no_property == 1 means format error or format correct but no property

                $result['status'] = 'failed';
                $result['error type'] = 2;
                $result['error message'] = 'no this property';
                
            }
            else{
                $getname = \App\datum::where('property_id', $property_id)->first()->name;
                $getconfirmed = \App\datum::where('property_id', $property_id)->first()->confirmed;
                
                $result['status'] = 'success';
                $result['name'] = $getname;//財產名稱
                $result['confirmed'] = $getconfirmed;//貼過沒
            }
//        }

        return response()->json($result);
        
    }
///////////////////////////////////////////////////////////////

            
    public function reponse_check(Request $request)//API2
    {
        $result = array();

        //error 1.前後端不同(後端貼過還請求貼) 
        //ignore now 2.note放入資料出現錯誤(沒放成功)

/*
        
        $token = $request->input('token');
        $geterror_user = \App\datum::where('token', $token)->exists();
        if($geterror_user == false){
            $result['status'] = 'failed';
            $result['error type'] = 1;
            $result['error message'] = 'user wrong';
        }
        else{
*/
            $property_id_input = $request->input('property_id');
            $no_property = 1;

            if(substr_count($property_id_input, '-') == 2){//two dash?

                $property_id = $this->convert_property_id($property_id_input);
                $geterror_property = \App\datum::where('property_id', $property_id)->exists();
                //$geterror_property is format correct but no property
                if($geterror_property){ $no_property = 0; }

            }


            if($no_property){//$no_property == 1 means format error or format correct but no property

                $result['status'] = 'failed';
                $result['error type'] = 2;
                $result['error message'] = 'no this property';
                
            }
            else{
                $property_id = $this->convert_property_id($property_id_input);
            

                $property= \App\datum::where('property_id', $property_id)->first();
                $getconfirmed = $property->confirmed;
                
                
                if($getconfirmed == 1){//貼過 error 1.前後端不同(後端貼過還請求貼) 
                    $result['status'] = 'failed';
                    $result['error type'] = 1;
                    $result['error message'] = 'Property has been sticked.';
                }
                else{
                    $Note = new \App\Note;
                    $note = $request->input('note');
                    $Note -> property_id = $property_id;
                    $Note -> content = $note;
                    //$Note -> user = $token;
                    $property->confirmed = 1;
                    /*//ignore now
                    if(){//error 2.note放入資料出現錯誤(沒放成功)
                        $result['status'] = 'failed';
                        $result['error type'] = 2;
                        $result['error message'] = 'Note failed';
                    }
                    else{
                    */

                        $Note->save();
                        $property->save();
                    
                        $result['status'] = 'success';

                    //}

                }
            }

            
//        }

        return response()->json($result);
        
    }



///////////////////////////////////////////////////////////////
/*
    public function reponse_check(Request $request)//API2
    {
        $property_id = $this->convert_property_id($request->input('property_id'));
        
        //$note = $request->input('note');
        //$token = $request->input('token');

        $property= \App\datum::where('property_id', $property_id)->first();
        $getconfirmed = $property->confirmed;
        
        $Note = new \App\Note;
        //error 1.前後端不同(後端貼過還請求貼) 
        //ignore now 2.note放入資料出現錯誤(沒放成功)

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

        	//ignore now
	        if(){//error 2.note放入資料出現錯誤(沒放成功)
	        	return response()->json([
		        	'status' => 'failed',
				    'error type' => 2,
			    	'error message' => 'Note failed',
				]);
	        }
	        else{
	        

        		$Note->save();
        		$property->save();
        	
	        	return response()->json([
		        	'status' => 'success',
				]);

			//}
        }
        
    }
    */

}
