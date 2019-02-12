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
							<div class="fixed-table-toolbar">
								<div class="bars pull-left">
									<div class="toolbar">
										<button class="btn btn-default" id="Logout" onclick="logout();">Logout</button>
									</div>
								</div>
								<div class="columns columns-right pull-right">
									<button class="btn btn-default" name="refresh" title="Refresh" type="button">
										hi, {{ Session::get('user')}}
									</button> 
									<button class="btn btn-default" name="toggle" title="Toggle" type="button">
										<i class="glyphicon fa fa-th-list"></i>
									</button>
									<div class="keep-open btn-group" title="搜尋選項" id="searchBar">
										<div class="dropdown">
											<button class="btn btn-secondary dropdown-toggle" type="button" id="searchBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												找編號
											</button>
											<ul class="dropdown-menu">
												  <li><a href="#">找編號</a></li>
												  <li><a href="#">找位置</a></li>
												  <li><a href="#">找飯店</a></li>
												  <li><a href="#">抓戰犯</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="pull-right search">
									<input id="searchbar" class="form-control" placeholder="Search" type="text" oninput="searching();">
								</div>
							</div>
							<p style="text-align: center;color: #FFF;" id="searchInfo">Searched for {{$DataSize}} pieces of information</p>
							<div class="fixed-table-container" style="padding-bottom: 0px;">
								<div class="fixed-table-header" style="display: none;">
									<table></table>
								</div>
								<div class="fixed-table-body">
									<div class="fixed-table-loading" style="top: 45px;">
										Loading, please wait...
									</div>
									<table class="table table-hover table-striped" id="fresh-table" style="margin-top: 0px;">
										<thead style="display: table-header-group;">
											<tr>
												<th data-field="id" style="">
													<div class="th-inner">
														ID
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="property_id" style="">
													<div class="th-inner">
														property_id
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="name" style="">
													<div class="th-inner">
														Name
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="place" style="">
													<div class="th-inner">
														Place
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="Stick_user" style="">
													<div class="th-inner">
														Stick_user
													</div>
													<div class="fht-cell"></div>
												</th>
												<th data-field="Confirmed" style="">
													<div class="th-inner">
														Confirmed
													</div>
													<div class="fht-cell"></div>
												</th>
											</tr>
										</thead>
										<tbody id="tbody">
											
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

</body>


<!--<script id="blockOfStuff" type="text/html">
		<td style="">1</td>
		<td style="">$36,738</td>
		<td style="">Niger</td>
		<td style="">Oud-Turnhout</td>
		<td style="">Oud-Turnhout</td>
		<td style="">Oud-Turnhout</td>
	</tr>
</script>-->
    
<script type="text/javascript">

	$( document ).ready(function() {
	    /*
	    var ul = document.createElement('ul');
		ul.setAttribute('class', 'pagination');
		ul.innerHTML = document.getElementById('blockOfStuff').innerHTML;
		document.getElementById('targetElement').appendChild(ul);
		*/
		searchMode = 1;
		dataSize = Number("{{$DataSize}}");
		clickPage(1);
    });
	
	//search option
	  $(".dropdown-menu li a").click(function(){
		var selText = $(this).text();
		$(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
		if(selText == "找編號"){searchMode=1;}
		else if(selText == "找位置"){searchMode=2;}
		searching();
		$("#searchBar").removeClass('open');
		$("#searchBar").removeClass('show');
	  });	
	
	var searchBarOpened=0
	$("#searchBtn").click(function() {
		if($("#searchBar").hasClass( "open" )){
			$("#searchBar").removeClass('open');
			$("#searchBar").removeClass('show');
		}
		else{$("#searchBar").addClass('open');}
	});


	//search option
	
	var delayTimer;
	function searching() {
        if($('#searchbar').val().trim().length !=0){
			    clearTimeout(delayTimer);
				delayTimer = setTimeout(function() {
					$.ajax({
						url: '{{URL::asset('/getSearchSize')}}',
						type: 'POST',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
						},
						data: {
							type: searchMode,
							key: $('#searchbar').val()
						},
						error: function(xhr) {
							alert('搜尋請求錯誤，請重新登入再試');
						},
						success: function(response) {
							dataSize = response['size'];
							clickPage(1);
							//console.log(response['size']);
							$('#searchInfo').text("Searched for "+response['size']+" pieces of information");
						}
					});
				}, 500);
		}
		else{
			clearTimeout(delayTimer);
			delayTimer = setTimeout(function() {
				dataSize = Number("{{$DataSize}}");
				clickPage(1);
				$('#searchInfo').text("Searched for {{$DataSize}} pieces of information");
				//console.log('null search');
			}, 500);
		}
    }
	
	
	function logout() {//logout
        document.location.href="{{URL::asset('/logout')}}";
    }

	//<a href="javascript:void(0)" onclick="clickPage(1)">1</a>
	function clickPage($page){//$page is current page
		var $pageSize = 30;
		$max_page=Math.ceil(dataSize/$pageSize);


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
				url: '{{URL::asset('/getpage')}}',
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				data: {
					page: $page,
					pageSize: $pageSize,
					key: $('#searchbar').val(),
					type: searchMode
				},
				error: function(xhr) {
					alert('頁面請求錯誤，請重新登入再試');
				},
				success: function(response) {
					updateTable(response);
				}
			});
		}
		else{//not search(get all data)
			$.ajax({
				url: '{{URL::asset('/getpage')}}',
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				data: {
					page: $page,
					pageSize: $pageSize
				},
				error: function(xhr) {
					alert('頁面請求錯誤，請重新登入再試');
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
			item = response['items'][i];
			var confirm;
			if(item['confirmed'] == 0){ confirm = "no"; }
			else{ confirm = "yes";}

			$('#tbody').append('<tr data-index='+i.toString()+'>');
			$('#tbody').append('<td style="">'+item['id'].toString()+'</td>');
			$('#tbody').append('<td style="">'+item['property_id']+'</td>');
			$('#tbody').append('<td style="">'+item['name']+'</td>');
			$('#tbody').append('<td style="">'+item['place']+'</td>');
			$('#tbody').append('<td style="">'+item['Stick_user']+'</td>');
			$('#tbody').append('<td style="">'+confirm+'</td>');
			$('#tbody').append('</tr>');
		}
	}

</script>


</html>