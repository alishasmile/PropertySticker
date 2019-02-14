<!DOCTYPE html>
<html>
<head>
	@include('head') 
	@section('title')
		<title>PropertySticker</title>
	@endsection

</head>
<body>
	@section('body')
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="fresh-table full-color-orange">
						<div class="bootstrap-table">
							<div class="fixed-table-toolbar" style="padding-bottom: 0px;">
								<div class="bars pull-left">
									<div class="toolbar">

										<button class="btn btn-default" id="Logout" onclick="logout();" onmouseover="mouseOver();" onmouseout="mouseOut();"  style="font-family:'Noto Sans TC';">
											{{ Session::get('user')}}
										</button>
									</div>
								</div>
								
								<div class="pull-right search" style="width: 25vw; max-width: 150px;">
									<input id="searchbar" class="form-control" placeholder="搜尋" type="text" oninput="searching();" style="height: auto; font-family:'Noto Sans TC';">
								</div>
								<div class="columns columns-right pull-right"  >
									<!--
									<button class="btn btn-default" name="toggle" title="Toggle" type="button">
										<i class="glyphicon fa fa-th-list"></i>
									</button>
									-->
									<div class="keep-open btn-group" title="搜尋選項" id="searchBar" >
										<div class="dropdown" >
											<button class="btn btn-secondary dropdown-toggle" type="button" id="searchBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family:'Noto Sans TC';">
												依編號
											</button>
											<ul class="dropdown-menu" >
												  <li><a href="#" >依編號</a></li>
												  <li><a href="#" >依位置</a></li>
												  <li><a href="#" >依名稱</a></li>
												  <li><a href="#" >抓戰犯</a></li>
											</ul>
										</div>
									</div>
									
								</div>
									
							</div>

										
							<div class="row">
								<div class="col">
									<div class="row align-items-center">
										<label class="switch" style="margin-left: 30px;margin-bottom: 0px;">
										  <input type="checkbox" onchange="ShowStickedChange();">

										  <span class="slider round"></span>
										</label>
										&nbsp
										<p style="color: #FFF;  margin-bottom: 0px;font-size:1em; font-family:'Noto Sans TC';">
											只顯示未貼
										</p>
										<div class="row align-items-center" id="web_switch" style="display:none;">
											&nbsp&nbsp
											<label class="switch" style="margin-left: 15px; margin-bottom: 0px;">
											  <input type="checkbox" onchange="chineseMode();">
											  <span class="slider round"></span>
											</label>
											&nbsp
											<p style="color: #FFF;  margin-bottom: 0px;font-size:1em; font-family:'Noto Sans TC';">
												台灣傳統模式
											</p>
										</div>
									</div>
									<div class="row align-items-center" id="phone_switch" style="display:none;">
										<label class="switch" style="margin-left: 30px;margin-bottom: 0px; margin-top: 5px;">
										  <input type="checkbox" onchange="chineseMode();">
										  <span class="slider round"></span>
										</label>
										&nbsp
										<p style="color: #FFF;  margin-bottom: 0px;font-size:1em; font-family:'Noto Sans TC';">
											台灣傳統模式
										</p>
									</div>
								</div>
								<div class="col">
									<div class="row justify-content-end" style="margin-right: 30px;">
										<div class="row">
											<div class="buttonload" id="loading">
											  <i class="fa fa-spinner fa-spin" style="font-size:1em"></i>
											</div>
											&nbsp
											<p style="color: #FFF;  margin-bottom: 0px;font-size:1em; font-family:'Noto Sans TC';" id="searchInfo">
												全部共有 {{$DataSize}} 筆財產
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="fixed-table-container" style="padding-bottom: 0px;">

								<!-- Modal Check-->
								<div class="modal fade" id="ModalCheck" tabindex="-1" role="dialog" aria-labelledby="pro_id" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="pro_id">真的貼過了嗎</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border-color: #AAAAAA; color: #AAAAAA;">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body" id="pro_id_and_name">
								        
								      </div>
								      <div class="form-group">
								        <label for="message-text" class="col-form-label" style="margin-left: 12px;">註記:</label>
								        <textarea class="form-control" id="message_from_check" style="border-color: rgba(23, 23, 23, 0.3); color: #232323; margin: 10px 10px 10px 12px; width: 95%;"></textarea>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-color: #AAAAAA; color: #AAAAAA;">取消</button>
								        <button type="button" class="btn btn-primary" style="border-color: #3472F7; color: #3472F7;" id="save_check">送出</button>
								      </div>
								    </div>
								  </div>
								</div>

								<!-- Modal Note-->
								<div class="modal fade" id="ModalNote" tabindex="-1" role="dialog" aria-labelledby="pro_id_note" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="pro_id_note">想註記什麼呢</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border-color: #AAAAAA; color: #AAAAAA;">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body" id="pro_id_and_name_note">
								        
								      </div>
								      <div class="modal-body" id="note_list">
								        
								      </div>
								      <div style="text-align: center; display: block;" id="no_note">
									      no note
									      <hr>
								  	  </div>
								      <div class="modal-body" id="note_list2">
								        
								      </div>
								      <div class="form-group">
								        <label for="message-text" class="col-form-label" style="margin-left: 12px;">註記:</label>
								        <textarea class="form-control" id="message_from_note" style="border-color: rgba(23, 23, 23, 0.3); color: #232323; margin: 10px 10px 10px 12px; width: 95%;"></textarea>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-color: #AAAAAA; color: #AAAAAA;">取消</button>
								        <button type="button" class="btn btn-primary" style="border-color: #3472F7; color: #3472F7;" id="save_note">送出</button>
								      </div>
								    </div>
								  </div>
								</div>

								<div class="fixed-table-header" style="display: none;">
									<table></table>
								</div>
								<div class="fixed-table-body">
									<table class="table table-hover table-striped" id="fresh-table" style="margin-top: 0px;">
										<thead style="display: table-header-group;">
											<tr>
												<th data-field="id" style="text-align: center;">
													<div class="th-inner">
														ID
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="property_id" style="">
													<div class="th-inner">
														財產編號
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="name" style="">
													<div class="th-inner">
														財產名稱
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="place" style="">
													<div class="th-inner">
														財產位置
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="Stick_user" style="">
													<div class="th-inner">
														確認人
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="Confirmed" style="">
													<div class="th-inner">
														已確認
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="Note" style="">
													<div class="th-inner">
														註記
													</div>
													<div class="fht-cell"></div>
												</th>
											</tr>
										</thead>
										<tbody id="tbody" >
										</tbody>
									</table>
								</div>





								<div class="fixed-table-footer" style="display: none;">
									<table>
										<tbody>
											<tr>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="fixed-table-pagination">
									<!--
									<div class="pull-left pagination-detail">
										<span class="pagination-info"></span>
										<span class="page-list">
											<span class="btn-group dropup">
												<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
													<span class="page-list">
														<span class="page-size">8</span> 
														<span class="caret"></span>
													</span>
													<ul class="dropdown-menu" role="menu">
														<li class="active">
															<a id="eight_size" href="javascript:void(0)">8</a>
														</li>
														<li>
															<a id="ten_size" href="javascript:void(0)">10</a>
														</li>
														<li>
															<a id="twentyfive_size" href="javascript:void(0)">25</a>
														</li>
													</ul>
												</button>
											</span>
										</span>
									</div>
									-->
									
									
									<div class="pull-right pagination">
										<ul class="pagination">
											<li id="first_page" class="page-first disabled">
												<a href="javascript:void(0)">«</a>
											</li>
											<li id="pre_page" class="page-pre disabled">
												<a href="javascript:void(0)">‹</a>
											</li>
											<li id="first_button" class="page-number active">
												<a  href="javascript:void(0)">1</a>
											</li>
											<li id="second_button" class="page-number">
												<a href="javascript:void(0)">2</a>
											</li>
											<li id="third_button" class="page-number">
												<a href="javascript:void(0)">3</a>
											</li>
											<li id="forth_button" class="page-number">
												<a href="javascript:void(0)">4</a>
											</li>
											<li id="fifth_button" class="page-number">
												<a href="javascript:void(0)">5</a>
											</li>
											<li id="next_page" class="page-next">
												<a href="javascript:void(0)">›</a>
											</li>
											<li id="last_page" class="page-last">
												<a href="javascript:void(0)">»</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="fixed-plugin" style="top: 300px">
		<div class="dropdown">
			<a data-toggle="dropdown" href="#"><i class="fa fa-cog fa-2x"></i></a>
			<ul class="dropdown-menu">
				<li class="header-title">Adjustments</li>
				<li class="adjustments-line">
					<a class="switch-trigger" href="javascript:void(0)">
					<p>Full Background</p>
					<div class="switch has-switch" data-off-label="OFF" data-on-label="ON">
						<div class="switch-animate switch-on">
							<input checked data-target="section-header" data-type="parallax" type="checkbox"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span>
						</div>
					</div>
					<div class="clearfix"></div></a>
				</li>
				<li class="adjustments-line">
					<a class="switch-trigger" href="javascript:void(0)">
					<p>Colors</p>
					<div class="pull-right">
						<span class="badge filter badge-blue" data-color="blue"></span> <span class="badge filter badge-azure" data-color="azure"></span> <span class="badge filter badge-green" data-color="green"></span> <span class="badge filter badge-orange active" data-color="orange"></span> <span class="badge filter badge-red" data-color="red"></span>
					</div>
					<div class="clearfix"></div></a>
				</li>
				<li class="header-title">Layouts</li>
				<li class="active">
					<a class="img-holder" href="compact-table.html"><img src="http://localhost:8880/img/compact.jpg">
					<h5>Compact Table</h5></a>
				</li>
				<li>
					<a class="img-holder" href="full-screen-table.html"><img src="http://localhost:8880/img/full.jpg">
					<h5>Full Screen Table</h5></a>
				</li>
			</ul>
		</div>
	</div>
	-->
</body>

<script type="text/javascript">
	
	//中國人模式
	var ChineseMode = 0;
	var ShowSticked = 1;
	var searchMode;
	var currentPage;
	
	function chineseMode(){
		if(ChineseMode == 1){
			ChineseMode = 0;
			clickPage(currentPage);
		}
		else{
			ChineseMode = 1;
			clickPage(currentPage);
		}
	}
	
	function ShowStickedChange(){
		if(ShowSticked == 1){
			ShowSticked = 0;
		}
		else{
			ShowSticked = 1;
		}
		searching();
	}

	$( document ).ready(function() {
		searchMode = 1;
		dataSize = Number("{{$DataSize}}");
		clickPage(1);
		switch_change();

	});

	function PopCheckModal(item) {
		this.item = Array.from(item.split(','));
		$('#pro_id_and_name').html("");
		$('#message_from_check').val("");
		$('#pro_id_and_name').append('財產編號 : '+this.item[2]+'<br>財產名稱 : '+this.item[3]);
		$('#save_check').attr("onclick","sendStickInfo("+this.item[0]+");");
		$('#ModalCheck').modal('show');
	}

	function PopNoteModal(item) {
		this.item = Array.from(item.split(','));
		$('#note_list2').html("");
		$('#pro_id_and_name_note').html("");
		$('#message_from_note').val("");
		$('#note_list').html("");
		$('#pro_id_and_name_note').append('財產編號 : '+this.item[2]+'<br>財產名稱 : '+this.item[3]);
		$.ajax({
			url: '{{URL::asset('/get_note_web')}}',
			type: 'POST',
			headers: {
			  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			data: {
			  id: this.item[0],
			},
			error: function(xhr) {
			  swal("錯誤", "ajax請求錯誤", "warning");
			},
			success: function(response) {
			  if(response['status'] == 'success'){
			  	$('#note_list').append('<hr>');
			  	if(response['has_note_or_not'] == 'yes'){
			  		$('#no_note').css("display","none");
			  		for(var i in response['notes']){
			  			$('#note_list').append(response['notes'][i]['user'] + ' : '+ response['notes'][i]['content']+'<hr>');
			  		}
			  	}
			  	else{
			  		$('#no_note').css("display","");
			  	}
			  }
			  else{
			  	swal("請重新登入", "您逾時登出", "error").then(
	                function (result) {
	                	document.location.href="{{URL::asset('/logout')}}";
	            });
			  }
			}
		});

		$('#save_note').attr("onclick","sendNoteInfo("+this.item[0]+");");
		$('#ModalNote').modal('show');
	}


	function sendNoteInfo(id_from_PopNoteModal){
	  $.ajax({
	    url: '{{URL::asset('/add_note_web')}}',
	    type: 'POST',
	    headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
	    data: {
	      id: id_from_PopNoteModal,
	      note: $('#message_from_note').val(),
	    },
	    error: function(xhr) {
	      swal("錯誤", "ajax請求錯誤", "warning");
	    },
	    success: function(response) {
	      if(response['status'] == 'success'){
	      	$('#no_note').css("display","none");
	      	$('#note_list').append(response['user'] + ' : '+ response['note']+'<hr>');
	      	$('#message_from_note').val("");
	      	$('#note_list2').html("");
	      }
	      else{
	      	if(response['error type'] == 1){
	      		swal("請重新登入", "您逾時登出", "error").then(
	                function (result) {
	                	document.location.href="{{URL::asset('/logout')}}";
	            });
	      	}
	      	else{
	      		$('#note_list2').html("");
	      		$('#note_list2').append('打啥呢');
	      	}
	      }
	    }
	  });
	}

	function sendStickInfo(id_from_PopCheckModal){
	  $.ajax({
	    url: '{{URL::asset('/stick_web')}}',
	    type: 'POST',
	    headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
	    data: {
	      id: id_from_PopCheckModal,
	      note: $('#message_from_check').val(),
	    },
	    error: function(xhr) {
	      swal("錯誤", "ajax請求錯誤", "warning");
	    },
	    success: function(response) {
	      if(response['status'] == 'success'){
	      	swal("資料已送出", "", "success");
	      	clickPage(currentPage);
	      	$('#ModalCheck').modal('hide');
	      }
	      else{
		    swal("請重新登入", "您逾時登出", "error").then(
                function (result) {
                	document.location.href="{{URL::asset('/logout')}}";
            });
	      }
	    }
	  });
	}

	//switch change depends on the size of interface
	function switch_change() {
		if(document.body.clientWidth > 900){
			$('#web_switch').css("display","");
			$('#phone_switch').css("display","none");
		}
		else{
			$('#web_switch').css("display","none");
			$('#phone_switch').css("display","");
		}
	}

	//search option
	  $(".dropdown-menu li a").click(function(){
		var selText = $(this).text();
		$(this).parents('.btn-group').find('.dropdown-toggle').html(selText);
		if(selText == "依編號"){searchMode=1;}
		else if(selText == "依位置"){searchMode=2;}
		else if(selText == "依名稱"){searchMode=3;}
		else if(selText == "抓戰犯"){searchMode=4;}
		searching();
		$("#searchBar").removeClass('open');
		$("#searchBar").removeClass('show');
	  });	

	var searchBarOpened=0
	$("#searchBtn").click(function() {
		if($("#searchBar").hasClass( "open" )){$("#searchBar").removeClass('open');}
		else{$("#searchBar").addClass('open');}
	});


	var delayTimer;
	function searching() {
		$("#loading").css("display","");
	    if($('#searchbar').val().trim().length !=0){
			    clearTimeout(delayTimer);
				delayTimer = setTimeout(function() {
					$.ajax({
						url: "/getSearchSize",
						type: 'POST',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
						data: {
							type: searchMode,
							showsticked :ShowSticked,
							key: $('#searchbar').val()
						},
						error: function(xhr) {
							swal("搜尋請求錯誤", "請重新登入再試", "warning");
						},
						success: function(response) {
							dataSize = response['size'];
							clickPage(1);
							//console.log(response['size']);
							
							var confirmstr ="";
							if(ShowSticked==0)confirmstr="且未被確認";
							
							if(searchMode == 1){
								$('#searchInfo').text("ID和 '"+$('#searchbar').val()+"' 有關"+confirmstr+"的財產共有 "+response['size']+" 筆");
							}
							else if(searchMode ==2){
								$('#searchInfo').text("位置在 '"+$('#searchbar').val()+"' "+confirmstr+"的財產共有 "+response['size']+" 筆");
							}
							else if(searchMode ==3){
								$('#searchInfo').text("名稱和 '"+$('#searchbar').val()+"' 有關"+confirmstr+"的財產共有 "+response['size']+" 筆");
							}
							else if(searchMode ==4){
								$('#searchInfo').text($('#searchbar').val()+" 確認過"+confirmstr+"的財產共有 "+response['size']+" 筆");
							}
						}
					});
				}, 500);
		}
		else{
			clearTimeout(delayTimer);
			delayTimer = setTimeout(function() {
				if(ShowSticked == 1){
					dataSize = Number("{{$DataSize}}");
					clickPage(1);
					$('#searchInfo').text("全部共有 {{$DataSize}} 筆財產");
				}
				else{
					$.ajax({
						url: "/getSearchSize",
						type: 'POST',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
						data: {
							type: 0,
							showsticked :0,
						},
						error: function(xhr) {
							swal("搜尋請求錯誤","請重新登入再試","warning");
						},
						success: function(response) {
							dataSize = response['size'];
							clickPage(1);
							$('#searchInfo').text("全部共有 "+dataSize+" 筆財產尚未被確認");
						}
					});
				}
				//console.log('null search');
			}, 500);
		}
	}


	function logout() {//logout
	    document.location.href="/logout";
	}

	function mouseOver() {
		document.getElementById("Logout").textContent = "Logout";
	}

	function mouseOut() {
		document.getElementById("Logout").textContent = "{{ Session::get('user')}}";
	}

	//<a href="javascript:void(0)" onclick="clickPage(1)">1</a>
	function clickPage($page){//$page is current page
		var $pageSize = 30;
		$max_page=Math.ceil(dataSize/$pageSize);
		$("#loading").css("display","");
		currentPage = $page;

		$('#first_button').css("display","");
		$('#second_button').css("display","");
		$('#third_button').css("display","");
		$('#forth_button').css("display","");
		$('#fifth_button').css("display","");
		///////////////////////
		if($max_page>5){
			if($page > 2 && $page < $max_page-1){
				$('#first_button>a').text($page-2);
				$('#second_button>a').text($page-1);
				$('#third_button>a').text($page);
				$('#forth_button>a').text($page+1);
				$('#fifth_button>a').text($page+2);

				$('#first_button>a').attr("onclick","clickPage("+($page-2).toString()+");");
				$('#second_button>a').attr("onclick","clickPage("+($page-1).toString()+");");
				$('#third_button>a').attr("onclick","clickPage("+($page).toString()+");");
				$('#forth_button>a').attr("onclick","clickPage("+($page+1).toString()+");");
				$('#fifth_button>a').attr("onclick","clickPage("+($page+2).toString()+");");

				$('#first_button').removeClass('active');
				$('#second_button').removeClass('active');
				$('#third_button').addClass('active');
				$('#forth_button').removeClass('active');
				$('#fifth_button').removeClass('active');
			}
			else if($page == 1){
				$('#first_button>a').text($page);
				$('#second_button>a').text($page+1);
				$('#third_button>a').text($page+2);
				$('#forth_button>a').text($page+3);
				$('#fifth_button>a').text($page+4);

				$('#first_button>a').attr("onclick","clickPage("+($page).toString()+");");
				$('#second_button>a').attr("onclick","clickPage("+($page+1).toString()+");");
				$('#third_button>a').attr("onclick","clickPage("+($page+2).toString()+");");
				$('#forth_button>a').attr("onclick","clickPage("+($page+3).toString()+");");
				$('#fifth_button>a').attr("onclick","clickPage("+($page+4).toString()+");");

				$('#first_button').addClass('active');
				$('#second_button').removeClass('active');
				$('#third_button').removeClass('active');
				$('#forth_button').removeClass('active');
				$('#fifth_button').removeClass('active');
			}
			else if($page == 2){
				$('#first_button>a').text($page-1);
				$('#second_button>a').text($page);
				$('#third_button>a').text($page+1);
				$('#forth_button>a').text($page+2);
				$('#fifth_button>a').text($page+3);

				$('#first_button>a').attr("onclick","clickPage("+($page-1).toString()+");");
				$('#second_button>a').attr("onclick","clickPage("+($page).toString()+");");
				$('#third_button>a').attr("onclick","clickPage("+($page+1).toString()+");");
				$('#forth_button>a').attr("onclick","clickPage("+($page+2).toString()+");");
				$('#fifth_button>a').attr("onclick","clickPage("+($page+3).toString()+");");

				$('#first_button').removeClass('active');
				$('#second_button').addClass('active');
				$('#third_button').removeClass('active');
				$('#forth_button').removeClass('active');
				$('#fifth_button').removeClass('active');
			}
			else if($page == $max_page-1){
				$('#first_button>a').text($page-3);
				$('#second_button>a').text($page-2);
				$('#third_button>a').text($page-1);
				$('#forth_button>a').text($page);
				$('#fifth_button>a').text($page+1);

				$('#first_button>a').attr("onclick","clickPage("+($page-3).toString()+");");
				$('#second_button>a').attr("onclick","clickPage("+($page-2).toString()+");");
				$('#third_button>a').attr("onclick","clickPage("+($page-1).toString()+");");
				$('#forth_button>a').attr("onclick","clickPage("+($page).toString()+");");
				$('#fifth_button>a').attr("onclick","clickPage("+($page+1).toString()+");");

				$('#first_button').removeClass('active');
				$('#second_button').removeClass('active');
				$('#third_button').removeClass('active');
				$('#forth_button').addClass('active');
				$('#fifth_button').removeClass('active');
			}
			else{
				$('#first_button>a').text($page-4);
				$('#second_button>a').text($page-3);
				$('#third_button>a').text($page-2);
				$('#forth_button>a').text($page-1);
				$('#fifth_button>a').text($page);

				$('#first_button>a').attr("onclick","clickPage("+($page-4).toString()+");");
				$('#second_button>a').attr("onclick","clickPage("+($page-3).toString()+");");
				$('#third_button>a').attr("onclick","clickPage("+($page-2).toString()+");");
				$('#forth_button>a').attr("onclick","clickPage("+($page-1).toString()+");");
				$('#fifth_button>a').attr("onclick","clickPage("+($page).toString()+");");

				$('#first_button').removeClass('active');
				$('#second_button').removeClass('active');
				$('#third_button').removeClass('active');
				$('#forth_button').removeClass('active');
				$('#fifth_button').addClass('active');
			}

			//////////////////////////
		}
		//max_page<=5
		else{
			if($max_page<=4){$('#fifth_button').css("display","none");}
			if($max_page<=3){$('#forth_button').css("display","none");}
			if($max_page<=2){$('#third_button').css("display","none");}
			if($max_page<=1){$('#second_button').css("display","none");}
			
			$('#first_button').removeClass('active');
			$('#second_button').removeClass('active');
			$('#third_button').removeClass('active');
			$('#forth_button').removeClass('active');
			$('#fifth_button').removeClass('active');
			
			if($page == 1){$('#first_button').addClass('active');}
			else if($page == 2){$('#second_button').addClass('active');}
			else if($page == 3){$('#third_button').addClass('active');}
			else if($page == 4){$('#forth_button').addClass('active');}
			else if($page == 5){$('#fifth_button').addClass('active');}
			
			
			$('#first_button>a').attr("onclick","clickPage(1);");
			$('#second_button>a').attr("onclick","clickPage(2);");
			$('#third_button>a').attr("onclick","clickPage(3);");
			$('#forth_button>a').attr("onclick","clickPage(4);");
			$('#fifth_button>a').attr("onclick","clickPage(5);");
		}
		
		
		if($page > 1 && $page < $max_page){
			$('#first_page').removeClass('disabled');
			$('#pre_page').removeClass('disabled');
			$('#next_page').removeClass('disabled');
			$('#last_page').removeClass('disabled');
			$('#first_page>a').attr("onclick","clickPage(1);");
			$('#last_page>a').attr("onclick","clickPage("+($max_page).toString()+");");
			$('#pre_page').attr("onclick","clickPage("+($page-1).toString()+");");
			$('#next_page').attr("onclick","clickPage("+($page+1).toString()+");");
		}
		else if($page == 1){
			$('#first_page').addClass('disabled');
			$('#pre_page').addClass('disabled');
			$('#next_page').removeClass('disabled');
			$('#last_page').removeClass('disabled');
			$('#next_page').attr("onclick","clickPage("+($page+1).toString()+");");
			$('#last_page>a').attr("onclick","clickPage("+($max_page).toString()+");");
			$('#pre_page').attr("onclick","clickPage(1);");
		}
		else{
			$('#first_page').removeClass('disabled');
			$('#pre_page').removeClass('disabled');
			$('#next_page').addClass('disabled');
			$('#last_page').addClass('disabled');
			$('#pre_page').attr("onclick","clickPage("+($page-1).toString()+");");
			$('#first_page>a').attr("onclick","clickPage(1);");
			$('#next_page').attr("onclick","clickPage("+$max_page+");");
		}
		
		if($max_page<=1){
			$('#second_button').css("display","none");
			$('#next_page').addClass('disabled');
			$('#last_page').addClass('disabled');
			$('#next_page').attr("onclick","clickPage(1);");
			$('#last_page>a').attr("onclick","clickPage(1);");
		}

		///////////////////////////////
		getPageData($page,$pageSize);

	}

	function getPageData($page,$pageSize){

		if($('#searchbar').val().trim().length !=0){//search
			$.ajax({
				url: "/getpage",
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				data: {
					page: $page,
					pageSize: $pageSize,
					key: $('#searchbar').val(),
					showsticked: ShowSticked,
					type: searchMode
				},
				error: function(xhr) {
					swal("搜尋請求錯誤","請重新登入再試","warning");
				},
				success: function(response) {
					updateTable(response);
				}
			});
		}
		else{//not search(get all data)
			$.ajax({
				url: "/getpage",
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				data: {
					page: $page,
					pageSize: $pageSize,
					showsticked: ShowSticked,
				},
				error: function(xhr) {
					swal("搜尋請求錯誤","請重新登入再試","warning");
				},
				success: function(response) {
					updateTable(response);
				}
			});
		}
	}

	function updateTable(response){
		$('#tbody').html("");
		for(var i in response['items']){
			var item = response['items'][i];

			var info_forModal = "'"+Object.values(item)+"'";
			var confirm;

			if(item['confirmed'] == 0){ 
				confirm = '<td onclick="PopCheckModal('+info_forModal+');" style="text-align: center;"><i class="fa fa-remove"></i>';
			}
			else{ 
				confirm = '<td style="text-align: center;"><i class="fa fa-heart"></i>';
			}
			
			//中國人模式
			if(ChineseMode == 1 ) {
				item['property_id'] = NumToChinese(item['property_id']);
				item['place'] = NumToChinese(item['place']);
				item['name'] = NumToChinese(item['name']);
			}

			$('#tbody').append('<tr data-index='+i.toString()+'>');
			$('#tbody').append('<td style="text-align: center;">'+item['id'].toString()+'</td>');
			$('#tbody').append('<td style="">'+item['property_id']+'</td>');
			$('#tbody').append('<td style="">'+item['name']+'</td>');
			$('#tbody').append('<td style="">'+item['place']+'</td>');
			$('#tbody').append('<td style="text-align: center;">'+item['Stick_user']+'</td>');
			$('#tbody').append(confirm+'</td>');
			$('#tbody').append('<td style="text-align: center;"  onclick="PopNoteModal('+info_forModal+');"><i class="fa fa-edit"></i></td>');
			$('#tbody').append('</tr>');
			
			
		}
		$("#loading").css("display","none");
	}

	//中國人模式
	function NumToChinese(input) { 
		var result="";
		for (var i = 0; i < input.length; i++) {
			var ch = input[i];
			var tran;
			switch(ch){
				case '1':
					tran = '壹';
					break;
				case '2':
					tran = '貳';
					break;
				case '3':
					tran = '叄';
					break;
				case '4':
					tran = '肆';
					break;
				case '5':
					tran = '伍';
					break;
				case '6':
					tran = '陸';
					break;
				case '7':
					tran = '柒';
					break;
				case '8':
					tran = '捌';
					break;
				case '9':
					tran = '玖';
					break;
				case '0':
					tran = '零';
					break;
				case 'A':
				case 'a':
					tran = '欸';
					break;
				case 'B':
				case 'b':
					tran = '逼';
					break;
				case 'C':
				case 'c':
					tran = '吸';
					break;
				case 'D':
				case 'd':
					tran = '滴';
					break;
				case 'E':
				case 'e':
					tran = '伊';
					break;
				case 'F':
				case 'f':
					tran = '诶府';
					break;
				case 'G':
				case 'g':
					tran = '居';
					break;
				case 'H':
				case 'h':
					tran = '诶曲';
					break;
				case 'I':
				case 'i':
					tran = '挨';
					break;
				case 'J':
				case 'j':
					tran = '接';
					break;
				case 'K':
				case 'k':
					tran = 'ㄎㄟ';
					break;
				case 'L':
				case 'l':
					tran = '诶樓';
					break;
				case 'M':
				case 'm':
					tran = '诶母';
					break;
				case 'N':
				case 'n':
					tran = '恩';
					break;
				case 'O':
				case 'o':
					tran = '歐';
					break;
				case 'P':
				case 'p':
					tran = '批';
					break;
				case 'Q':
				case 'q':
					tran = 'ㄎ一ㄡ';
					break;
				case 'R':
				case 'r':
					tran = 'ㄚˊ';
					break;
				case 'S':
				case 's':
					tran = '欸斯';
					break;
				case 'T':
				case 't':
					tran = '踢';
					break;
				case 'U':
				case 'u':
					tran = '優';
					break;
				case 'V':
				case 'v':
					tran = '府醫';
					break;
				case 'W':
				case 'w':
					tran = '搭波優';
					break;
				case 'X':
				case 'x':
					tran = '诶可斯';
					break;
				case 'Y':
				case 'y':
					tran = '歪';
					break;
				case 'Z':
				case 'z':
					tran = '力';
					break;					
				case '-':
					tran = '之';
					break;
				default:
					tran = input[i];
					break;
			}
		  result = result.concat(tran);
		}
		return result;
	}

</script>	


</html>