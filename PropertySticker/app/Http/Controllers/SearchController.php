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
		$showsticked = $request->input('showsticked');
		
		if($keyword==NULL){
			if($showsticked==1){
				$items = \App\datum::skip($pageSize*($page-1))->take($pageSize)->get();
			}else{
				$items = \App\datum::where('confirmed',0)->skip($pageSize*($page-1))->take($pageSize)->get();
			}
			$result['items'] = $items;
		}
		else{
			if($mode==1){
				$items = \App\datum::where('property_id', 'LIKE', '%'.$keyword.'%');
			}
			else if($mode==2){
				$items = \App\datum::where('place', 'LIKE', '%'.$keyword.'%');
			}
			else if($mode==3){
				$items = \App\datum::where('name', 'LIKE', '%'.$keyword.'%');
			}
			else if($mode==4){
				$items = \App\datum::where('Stick_user', 'LIKE', '%'.$keyword.'%');
			}
			
			if($showsticked==1){
				$result['items'] = $items->skip($pageSize*($page-1))->take($pageSize)->get();
				
			}else{
				$result['items'] = $items->where('confirmed',0)->skip($pageSize*($page-1))->take($pageSize)->get();
			}
		}
		return response()->json($result);
    }
	
	public function getSearchSize(Request $request)
	{
		$result = array();
		$keyword = $request->input('key');
		$mode = $request->input('type');
		$showsticked = $request->input('showsticked');
		
		if($mode == 1){
			$size = \App\datum::where('property_id', 'LIKE', '%'.$keyword.'%');
		}
		else if($mode == 2){
			$size = \App\datum::where('place', 'LIKE', '%'.$keyword.'%');
		}
		else if($mode == 3){
			$size = \App\datum::where('name', 'LIKE', '%'.$keyword.'%');
		}
		else if($mode == 4){
			$size = \App\datum::where('Stick_user', 'LIKE', '%'.$keyword.'%');
		}
		else if($mode == 0){
			$size = \App\datum::get();
		}
		
		if($showsticked == 1){//showall
			$result['size'] = $size->count();
		}
		else{//only show the unchecked property
			$result['size'] = $size->where('confirmed',0)->count();
		}
		return response()->json($result);
	}
}
