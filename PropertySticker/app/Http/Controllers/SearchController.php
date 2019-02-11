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
		$keyword = $request->input('key');
		if($keyword==NULL){
			$items = \App\datum::skip($pageSize*($page-1))->take($pageSize)->get();
		}
		else{
			$items = \App\datum::where('property_id', 'LIKE', '%'.$keyword.'%')->skip($pageSize*($page-1))->take($pageSize)->get();
		}
		$result['items'] = $items;
		return response()->json($result);
    }
	
	public function getSearchSize(Request $request)
	{
		$result = array();
		$keyword = $request->input('key');
		$size = \App\datum::where('property_id', 'LIKE', '%'.$keyword.'%')->count();
		$result['size'] = $size;
		return response()->json($result);
	}
}
