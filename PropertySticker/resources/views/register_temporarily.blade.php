@extends('head')

@section('title')

  <title>PropertySticker_login</title>

@endsection

@section('body')

<body>
	<div class="login-wrap" style="margin-top: 80px;">
		<div class="login-html">
			<input id="tab-3" type="radio" name="tab" class="sign-in" checked><label for="tab-3" class="tab">Register</label>
			<input id="tab-4" type="radio" name="tab" class="for-pwd"><label for="tab-4" class="tab"></label>
			<div class="login-form">
				<div class="sign-in-htm">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="userr" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
					</div>
		            <div class="form-group pass_show"> 
		                <input id="pw" type="password" class="form-control" placeholder="Password"> 
		            </div> 
					<div class="group">
						<input type="submit" class="button" value="Submit" onclick="send();" >
					</div>
					<div class="hr"></div>
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
	      alert('Ajax request 發生錯誤');
	    },
	    success: function(response) {
	      alert('create successfully');
	      $('#pw').val('');
	      $('#userr').val('');
	    }
	  });
	};

	//enter key
	$("#pw").keypress(function(e){
	  code = (e.keyCode ? e.keyCode : e.which);
	  if (code == 13)
	  {
	      send();
	  }
	});

		  
	$(document).ready(function(){
	$('.pass_show').append('<span class="ptxt">Show</span>');  
	});
	  

	$(document).on('click','.pass_show .ptxt', function(){ 

	$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

	$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

	});  
	</script>

</body>

@endsection
