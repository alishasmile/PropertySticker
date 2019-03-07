@extends('head')

@section('title')

  <title>PropertySticker_login</title>


@endsection

@section('body')

<body>

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
							<input type="file" name="excel" class="form-control" id="catagry_logo">
						</div>
						<div class="group">
							<input type="submit" class="button" id="upload" value="新增"  style="width: auto;">
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
						<input type="submit" class="button pull-right" style="width: auto;" value="創建資料庫" >
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
	      			$('#selc').append('<option>'+response['filename']+'</option>');
	      			swal("檔案新增成功", "請至下方選擇所需檔案", "success");
	      		}
	      		else{
	      			if(response['error type'] == 1){
	      				swal("上傳失敗", "請刷新網頁再上傳一次", "error");
	      			}
	      			else if(response['error type'] == 3){
	      				swal("此檔案已存在", "請更換檔案或者更換檔名", "error");
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
	</script>

</body>

@endsection
