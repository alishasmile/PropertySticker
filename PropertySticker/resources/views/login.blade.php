@extends('head')

@section('title')

  <title>PropertySticker_login</title>

@endsection

@section('body')

<body style="background: url('/img/material-design-4k-2048x1152.jpg'); background-position: center; background-size: cover;">
	<div class="row align-items-center justify-content-center">
		<div class="login-wrap" style="margin-top: 10px;">
	        <div class="login-html">

				<input id="tab-1" type="radio" name="tab" class="sign-in" checked>
				<label for="tab-1" class="tab">
					<img src="/img/mcl_propertySticker.png" class="img-circle" style="height: 20px; width: 20px;">
					登入
				</label>
				<input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">不要點我</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<div class="group"></div>
			            <div class="form-group pass_show"> 
			                <input id="login_pw" type="password" class="form-control" placeholder="請輸入密碼" style="border-radius: 25px;"> 
			            </div> 
			            <div id="user_wrong" class="has-error " style="text-align: center; display:none">
							<label class="control-label" for="inputError" >使用者錯誤</label>
						</div>
						<div class="group">
							<input id="login_submit" type="submit" class="button" value="登入" onclick="sendLoginInformation();">
						</div>
						
						<div class="hr"></div>
					</div>
					<!--
					<div class="for-pwd-htm">
						<div class="group">
							<label for="pass" class="label">Current Password</label>
						</div>
					    <div class="form-group pass_show"> 
			                <input type="password"  class="form-control" placeholder="Current Password"> 
			            </div> 

						<div class="group">
							<label for="pass" class="label">New Password</label>
						</div>
			            <div class="form-group pass_show"> 
			                <input type="password" class="form-control" placeholder="New Password"> 
			            </div> 

			            <div class="group">
							<label for="pass" class="label">Confirm Password</label>
						</div>
			            <div class="form-group pass_show"> 
			                <input type="password" class="form-control" placeholder="Confirm Password"> 
			            </div> 

						<div class="group">
							<input type="submit" class="button" value="Submit">
						</div>

						<div class="hr"></div>
					</div>
					-->
				</div>
			</div>
		</div>
	</div>

	

	<script type="text/javascript">

		function sendLoginInformation(){
		  $.ajax({
		    url: '/api/token_check',
		    type: 'POST',
		    headers: {
	          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	        },
		    data: {
		      token: $('#login_pw').val()
		    },
		    error: function(xhr) {
		      alert('Ajax request 發生錯誤');
		    },
		    success: function(response) {
		      if(response['status'] == 'success'){
		      	document.location.href="/";
		      }
		      else{
		      	$('#user_wrong').css('display', '');
		      }
		    }
		  });
		}

		//enter key
		$("#login_pw").keypress(function(e){
		  code = (e.keyCode ? e.keyCode : e.which);
		  if (code == 13)
		  {
		      sendLoginInformation();
		  }
		});

		$(document).ready(function(){
			$('.pass_show').append('<span class="ptxt">顯示</span>');  
		});
		  

		$(document).on('click','.pass_show .ptxt', function(){ 

			$(this).text($(this).text() == "顯示" ? "隱藏" : "顯示"); 

			$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

		});  
	</script>

</body>

@endsection
