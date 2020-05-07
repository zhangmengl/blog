<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>新闻</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center><h2>新闻添加<a href="{{url('/xinwen/index')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>

<form action="{{url('xinwen/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="xinwen_name" id="firstname" 
				   placeholder="请输入新闻标题">
		    <b style="color:red">{{$errors->first('xinwen_name')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="xinwen_man" id="firstname" 
				   placeholder="请输入新闻作者">
		    <b style="color:red">{{$errors->first('xinwen_man')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">新闻描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" name="xinwen_desc" id="lastname" 
				   placeholder="请输入新闻描述"></textarea>
			<b style="color:red">{{$errors->first('xinwen_desc')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>