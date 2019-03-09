@extends('head')

@section('title')

  <title>PropertySticker_register</title>


@endsection

@section('body')

<body style="background: url('/img/material-design-4k-2048x1152.jpg'); background-position: center; background-size: cover;">

	<div class="login-wrap" style="margin-top: 10px;">
		<div class="login-html">
			<input id="tab-3" type="radio" name="tab" class="sign-in" checked><label for="tab-3" class="tab">註冊</label>
			<input id="tab-4" type="radio" name="tab" class="for-pwd"><label for="tab-4" class="tab">上傳檔案</label>
			<div class="login-form">
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">使用者名稱</label>
						<input id="userr" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">密碼</label>
					</div>
		            <div class="form-group pass_show"> 
		                <input id="pw" type="password" class="form-control" placeholder="請輸入密碼" style="border-radius: 25px;"> 
		            </div> 
					<div class="group">
						<input type="submit" class="button" value="送出" onclick="send();" >
					</div>
					<div class="hr"></div>
				</div>
				<div class="for-pwd-htm">
					<form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >
						<div class="form-group">
							<input type="file" name="excel" class="form-control" id="catagry_logo" enctype="multipart/form-data">
						</div>
						<div class="group">
							<input class="button" id="upload" value="新增"  style="width: 68px;">
						</div>
					</form>

					<div class="hr"></div>

					<div class="form-group" >
						<div class="group">
							<label for="selc" class="label">選擇檔案：</label>
						</div>
						<select class="form-control" id="selc" >
						</select>
					</div>
					<div class="group">
						<input class="button pull-right" id="create_data" style="width: 104px" value="創建資料庫" >
					</div>



				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">

	send = function (){
	  $.ajax({
	    url: '{{URL::asset('/createMember')}}',
	    type: 'POST',
	    headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
	    data: {
	      user: $('#userr').val(),
	      token: $('#pw').val()
	    },
	    error: function(xhr) {
	      swal("錯誤", "ajax請求錯誤", "warning");
	    },
	    success: function(response) {
	      swal("資料已送出", "", "success");
	      $('#pw').val('');
	      $('#userr').val('');
	    }
	  });
	};


	$("#create_data").click(function(){
		$('#create_data').prop('disabled', true);
		waitingDialog.show();//請耐心稍後再前往頁面瀏覽
		$.ajax({
		    url: '{{URL::asset('/createData')}}',
		    type: 'POST',
		    headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        },
	        data: {
	        	ff: $('#selc').val(),
	        },
		    error: function(xhr) {
				swal("ajax請求錯誤", "請刷新網頁後重新動作", "warning");
		    },
		    success: function(response) {
		    	waitingDialog.hide();
		    	if(response['status']=='success'){
		    		swal("資料創建成功", "謝謝您耐心的等候", "success");
		    	}
		    	else{
		    		swal("資料創建失敗", "請重新創建", "error");
		    	}
		    	$('#create_data').prop('disabled', false);
		    }
		});
	  
	});

	$("#upload").click(function(){
		$.ajax({
	      	url:'{{URL::asset('/upload')}}',
	      	headers: {
        	  	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	      	},
	      	data:new FormData($("#upload_form")[0]),
	      	dataType:'json',
	      	async:false,
	      	type:'post',
	      	processData: false,
	      	contentType: false,
	      	error: function(xhr) {
				swal("錯誤", "ajax請求錯誤", "warning");
			},
	      	success:function(response){
	      		if(response['status'] == 'success'){
	      			$('#selc').append('<option value="excel/'+response['filename']+'">excel/'+response['filename']+'</option>');
	      			swal("檔案新增成功", "請至下方選擇所需檔案", "success");
	      		}
	      		else{
	      			if(response['error type'] == 1){
	      				swal("上傳失敗", "請刷新網頁再上傳一次", "error");
	      			}
	      			else if(response['error type'] == 3){
	      				swal("此檔案已存在", "請更換檔案或者更換檔名", "error");
	      			}
	      			else if(response['error type'] == 4){
	      				swal("請選擇上傳檔案", "您未選擇檔案", "warning");
	      			}
	      			else{
	      				swal("上傳格式錯誤", "只允許上傳xls/xlsx", "error");
	      			}
	      		}
	      	},
	    });
	 });

	//enter key
	$("#pw").keypress(function(e){
	  code = (e.keyCode ? e.keyCode : e.which);
	  if (code == 13)
	  {
	      send();
	  }
	});

		  
	$(document).ready(function(){
		$('.pass_show').append('<span class="ptxt">顯示</span>');  
		$.ajax({
	      	url:'{{URL::asset('/selc_files')}}',
	      	headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	      	},
		    dataType:'json',
		    type:'post',
		    error: function(xhr) {
				swal("錯誤", "ajax請求錯誤", "warning");
		    },
		    success: function(response) {
		    	$('#selc').html("");
				for(var i = 0 ; i < response.length ; i++){
					$('#selc').append('<option>'+response[i]+'</option>');
				}
		    },
	    });
	});
	  

	$(document).on('click','.pass_show .ptxt', function(){ 

	$(this).text($(this).text() == "顯示" ? "隱藏" : "顯示"); 

	$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

	});  


	var waitingDialog = waitingDialog || (function ($) {
	    'use strict';

		// Creating modal dialog's DOM
		var $dialog = $(
			'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
			'<div class="modal-dialog modal-m">' +
			'<div class="modal-content">' +
				'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
				'<div class="modal-body">' +
					'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
				'</div>' +
			'</div></div></div>');

		return {
			show: function (message, options) {
				// Assigning defaults
				if (typeof options === 'undefined') {
					options = {};
				}
				if (typeof message === 'undefined') {
					message = 'Loading...';
				}
				var settings = $.extend({
					dialogSize: 'm',
					progressType: '',
					onHide: null // This callback runs after the dialog was hidden
				}, options);

				// Configuring dialog
				$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
				$dialog.find('.progress-bar').attr('class', 'progress-bar');
				if (settings.progressType) {
					$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
				}
				$dialog.find('h3').text(message);
				// Adding callbacks
				if (typeof settings.onHide === 'function') {
					$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
						settings.onHide.call($dialog);
					});
				}
				// Opening dialog
				$dialog.modal();
			},
			/**
			 * Closes dialog
			 */
			hide: function () {
				$dialog.modal('hide');
			}
		};

	})(jQuery);

	</script>

</body>

@endsection
