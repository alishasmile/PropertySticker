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
		$mode = $request->input('type');
		
		if($keyword==NULL){
			$items = \App\datum::skip($pageSize*($page-1))->take($pageSize)->get();
		}
		else{
			if($mode==1){
				$items = \App\datum::where('property_id', 'LIKE', '%'.$keyword.'%')->skip($pageSize*($page-1))->take($pageSize)->get();
			}
			else if($mode==2){
				$items = \App\datum::where('place', 'LIKE', '%'.$keyword.'%')->skip($pageSize*($page-1))->take($pageSize)->get();
			}
			else if($mode==3){
				$items = \App\datum::where('name', 'LIKE', '%'.$keyword.'%')->skip($pageSize*($page-1))->take($pageSize)->get();
			}
			else if($mode==4){
				$items = \App\datum::where('Stick_user', 'LIKE', '%'.$keyword.'%')->skip($pageSize*($page-1))->take($pageSize)->get();
			}
		}
		$result['items'] = $items;
		return response()->json($result);
    }
	
	public function getSearchSize(Request $request)
	{
		$result = array();
		$keyword = $request->input('key');
		$mode = $request->input('type');
		if($mode == 1){
			$size = \App\datum::where('property_id', 'LIKE', '%'.$keyword.'%')->count();
		}
		else if($mode == 2){
			$size = \App\datum::where('place', 'LIKE', '%'.$keyword.'%')->count();
		}
		else if($mode == 3){
			$size = \App\datum::where('name', 'LIKE', '%'.$keyword.'%')->count();
		}
		else if($mode == 4){
			$size = \App\datum::where('Stick_user', 'LIKE', '%'.$keyword.'%')->count();
		}
		
		$result['size'] = $size;
		return response()->json($result);
	}
}
