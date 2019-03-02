<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;



class UploadController extends Controller
{
	public function upload_data(Request $request){

		$file = $request->file('excel');

		$result = array();

	    if (!$file->isValid())
	    {
			$result['status'] = 'failed';
			$result['error type'] = 1;
			$result['error message'] = 'upload failed';
	    }
	   	else{
	   		// 获取文件相关信息

		    $ext = $file->getClientOriginalExtension();    // 副檔名

			//文件格式

		    $fileTypes = ['xls', 'xlsx'];

		    $isInFileType = in_array($ext, $fileTypes);

		    //文件格式是否成功

		    if (!$isInFileType) {

		        $result['status'] = 'failed';
				$result['error type'] = 2;
				$result['error message'] = 'format incorrect';

		    }
		    else{
		    	// 上传文件
		    	$filename = $file->getClientOriginalName();

			    //路径

			    $path = $request->file('excel')->storeAs('excel', $filename);

			    $result['status'] = 'success';
				$result['path'] = $path;
				$result['filename'] = $filename;
		    }
	   	}

		return response()->json($result);

	}

	/////////////

	public function storage_files(Request $request){
		$files = Storage::allFiles('excel');
		return $files;
	}
}
