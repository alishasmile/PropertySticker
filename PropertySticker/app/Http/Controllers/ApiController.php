<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ApiController extends Controller
{
    //

    public function reponse_property(Request $request)
    {
        $property_id = $request->input('property_id');
        //$token = $request->input('token');
        //
        $getname = \App\datum::where('property_id', $property_id)->first()->name;
        //dd($getname->name);
        return response()->json([
        	//'status' => 'success',
		    'name' => $getname,

		]);
    }


    public function reponse_check(Request $request)
    {
        $property_id = $request->input('property_id');
        //$token = $request->input('token');
        //
        $getcomfirmed = \App\datum::where('property_id', $property_id)->first()->comfirmed;
        //dd($getname->name);
        return response()->json([
        	//'status' => 'success',
		    'comfirmed' => $getcomfirmed,

		]);
    }

}
