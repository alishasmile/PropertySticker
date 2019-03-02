<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{

	public function createData(){

		\App\datum::query()->delete();

		$filePath = 'storage/app/excel'.iconv('UTF-8', 'GBK', 'PropertyList').'.xlsx';
		
		Excel::load($filePath, function($reader) {
			$data = $reader->all();
			$index = 1;
			foreach($data as $n){
				$d = $n->toArray();

				$dd = $d["財產編號"];
				$pieces = explode("-", $dd);

				for($i = 0 ; $i < $d["數量"] ; $i++) {

					$datum = new \App\datum;
					$property_id_third = (string)((int)$pieces[2]+$i); 

					if($d["憑單編號"] == null) { $datum -> Voucher_number = 'null'; }
					else { $datum -> Voucher_number = $d["憑單編號"]; }
					
					if($d["財產名稱"] == null) { $datum -> name = 'null'; }
					else { $datum -> name = $d["財產名稱"]; }

					if($d["單位"] == null) { $datum -> unit = 'null'; }
					else { $datum -> unit = $d["單位"]; }

					if($d["保管者"] == null) { $datum -> assignee = 'null'; }
					else { $datum -> assignee = $d["保管者"]; }
					
					if($d["房間"] == null) { $datum -> place = 'null'; }
					else { $datum -> place = $d["房間"]; }

					if($d["財產編號"] == null) { $datum -> property_id = 'null'; }
					else { $datum -> property_id = $pieces[0].'-'.$pieces[1].'-'.$property_id_third; }

					if($d["購買日期"] == null) { $datum -> purchase_date = 'null'; }
					else { $datum -> purchase_date = $d["購買日期"]; };

					$datum -> unit_price = $d["單價"];
					$datum -> id = $index++;
					$datum -> quantity = 1;
					$datum -> price = $d["總價"];
					$datum -> confirmed = false;

					$datum->save();
				} 

			}
			
		});

	}

}
