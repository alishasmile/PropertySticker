<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function search_user($token){
        
        $b = 1;

        $getusers = \App\Member::all();
        foreach ($getusers as $user) {
            if (Hash::check($token, $user->token)) {
                $b = 0;
                return $user->user;
            }
        }

        if($b){ 
            return 'NULL';
        }
    }

///////////////////////////////////////////////////////////////

//type 1
    public function reponse_property(Request $request)//API
    {


        //error: 1.user wrong 2.no this property(contains format error)

        $result = array();
        
        $token = $request->input('token');

        $finduser = $this->search_user($token);
        
        if($finduser == 'NULL'){
            $result['status'] = 'failed';
            $result['error type'] = 1;
            $result['error message'] = 'user wrong';
        }
        else{

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
        }

        return response()->json($result);
        
    }
///////////////////////////////////////////////////////////////

            
    public function reponse_check(Request $request)//API2
    {
        $result = array();

        //error 1.前後端不同(後端貼過還請求貼) 
        //ignore now 2.note放入資料出現錯誤(沒放成功)


        
        $token = $request->input('token');
        $finduser = $this->search_user($token);

        if($finduser == 'NULL'){
            $result['status'] = 'failed';
            $result['error type'] = 1;
            $result['error message'] = 'user wrong';
        }
        else{

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
                
                
                if($getconfirmed == 1){//貼過 error 3.前後端不同(後端貼過還請求貼) 
                    $result['status'] = 'failed';
                    $result['error type'] = 3;
                    $result['error message'] = 'Property has been sticked.';
                }
                else{
                    $note = $request->input('note');
                    if($note != NULL){
                        $Note = new \App\Note;
                        $Note -> property_id = $property_id;
                        $Note -> content = $note;
                        $Note -> user = $finduser;

                        $Note->save();
                    }
                    
                    $property->confirmed = 1;
                    $property->Stick_user = $finduser;
                    /*//ignore now
                    if(){//error 2.note放入資料出現錯誤(沒放成功)
                        $result['status'] = 'failed';
                        $result['error type'] = 2;
                        $result['error message'] = 'Note failed';
                    }
                    else{
                    */
                        $property->save();
                    
                        $result['status'] = 'success';

                    //}

                }
            }

            
        }

        return response()->json($result);
        
    }



///////////////////////////////////////////////////////////////


}
