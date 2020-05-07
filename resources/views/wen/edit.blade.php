<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center><h2>文章编辑<a href="{{url('/wen/index')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>

<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif -->

<form action="{{url('wen/update',$res->wen_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="wen_name" value="{{$res->wen_name}}" id="firstname" 
				   placeholder="请输入文章标题">
		    <b style="color:red">{{$errors->first('wen_name')}}</b>		   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章类型</label>
		<div class="col-sm-8">
			<select name="wenf_id">
                <option value="0">请选择</option>
                @foreach ($wenf as $v)
                    <option value="{{$v->wenf_id}}" {{$v->wenf_id==$res->wenf_id ? "selected" : ""}}>{{$v->wenf_name}}</option>
                @endforeach
            </select>	   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-8">
			<input type="radio" name="wen_an" value="1" {{$res->wen_an=="1" ? "checked" : ""}}>普通	
            <input type="radio" name="wen_an" value="2" {{$res->wen_an=="2" ? "checked" : ""}}>置顶	   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
            <input type="radio" name="wen_show" value="1" {{$res->wen_show=="1" ? "checked" : ""}}>是	
            <input type="radio" name="wen_show" value="2" {{$res->wen_show=="2" ? "checked" : ""}}>否	   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="wen_man" value="{{$res->wen_man}}" id="firstname" 
				   placeholder="请输入文章作者">
		    <b style="color:red">{{$errors->first('wen_man')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="wen_email" value="{{$res->wen_man}}" id="firstname" 
				   placeholder="请输入作者email">
		    <b style="color:red">{{$errors->first('wen_email')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="wen_guan" value="{{$res->wen_guan}}" id="firstname" 
				   placeholder="请输入关键字">
		    <b style="color:red">{{$errors->first('wen_guan')}}</b>		   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" name="wen_desc" id="lastname" 
				   placeholder="请输入文章描述">{{$res->wen_desc}}</textarea>
			<b style="color:red">{{$errors->first('wen_desc')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章LOGO</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" name="wen_logo" id="lastname">
		</div>
        @if($res->wen_logo)
        <img src="{{env('UPLOADS_URL')}}{{$res->wen_logo}}" width="45px" height="45px">
        @endif
    </div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
            <button type="button" class="btn btn-default">重置</button>
		</div>
	</div>
</form>

</body>
</html>