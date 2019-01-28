@extends('head')

@section('title')

	<title>找不到內容</title>

@endsection

@section('body')
<body>	
	<div style="height: 150px;"></div>
	<div class="container">
	    <div class="jumbotron">
	        <div class="text-center"><i class="fa fa-5x fa-frown-o" style="color:#d9534f;"></i></div>
	        <h1 class="text-center">404 找不到<p> </p><p><small class="text-center"> Oh 找不到任何東西</small></p></h1>
	        <p class="text-center">試試看按上一頁或者底下的回家按鈕</p>
	        <p class="text-center"><a class="btn btn-primary" href="/"><i class="fa fa-home"></i> 帶我回家</a></p>
	    </div>
	</div>
</body>
@endsection