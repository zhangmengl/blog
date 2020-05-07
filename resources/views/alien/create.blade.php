<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>外来务工</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center><h2>外来务工添加<a href="{{url('/alien/index')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>

<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif -->

<form action="{{url('alien/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="alien_name" placeholder="请输入名字">
		    <b style="color:red">{{$errors->first('alien_name')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="alien_age" placeholder="请输入年龄">
		    <b style="color:red">{{$errors->first('alien_age')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">身份证</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="alien_card" placeholder="请输入身份证">
		    <b style="color:red">{{$errors->first('alien_card')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="alien_img">
		</div>
    </div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否是湖北人</label>
		<div class="col-sm-8">
			<input type="radio" name="is_alien" value="1">是	
            <input type="radio" name="is_alien" value="2" checked>否	   
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