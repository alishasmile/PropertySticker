<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    /*
    public function getsearch(Request $request)
    {
    	$result = array();
		$search_key = $request->input('search_key');

		

		while(){

		}

		return response()->json($result);
    }
	*/

    public function getpage(Request $request)
    {
    	$result = array();
		//suppose a page 8 info
		$pageSize = $request->input('pageSize');
		$page = $request->input('page');
		$items = \App\datum::whereBetween('id',[$pageSize*($page-1)+1,$pageSize*$page])->get();
		$result['items'] = $items;
		return response()->json($result);
    }
}
