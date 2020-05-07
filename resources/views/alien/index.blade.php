<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>外来务工</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<center><h2>外来务工列表<a href="{{url('/alien/create')}}" style="float:right" class="btn btn-default">添加</a></h2></center><br>

<form action="{{url('/alien/index')}}">
    <input type="text" name="alien_name" value="{{$all['alien_name']??''}}" placeholder="请输入名字关键字">
    <button>搜索</button>
</form>
<hr>
<div class="table-responsive">
	  <table class="table">
		    <thead>
			      <tr>
				        <th>ID</th>
				        <th>名字</th>
                        <th>年龄</th>
                        <th>身份证号</th>
                        <th>头像</th>
                        <th>是否是湖北人</th>
                        <th>添加时间</th>
                        <th>操作</th>
			      </tr>
		    </thead>
		    <tbody>
            @foreach ($alien as $v) 
			<tr>
			    <td>{{$v->alien_id}}</td>
				<td>{{$v->alien_name}}</td>
                <td>{{$v->alien_age}}</td>
                <td>{{$v->alien_card}}</td>
                <td>
                    @if($v->alien_img)<img src="{{env('UPLOADS_URL')}}{{$v->alien_img}}" width="45px" height="45px">
                    @endif
                </td>
                <td>{{$v->is_alien=="1" ? "√" : "×"}}</td>
                <td>{{date("Y-m-d H:i:s",$v->alien_time)}}</td>
                <td>
                    <a href="{{url('/alien/edit/'.$v->alien_id)}}" class="btn btn-primary">编辑</a>
                    <a id="{{$v->alien_id}}" class="btn btn-danger">删除</a>
                </td>
			</tr>
		    @endforeach
            <tr><td colspan="8">{{$alien->appends($all)->links()}}</td></tr>
        </tbody>
    </table>
    
</div>  	
<script>
//页面加载
$(function(){
    //ajax删除
    $(document).on("click",".btn-danger",function(){
        var id=$(this).attr("id");
        if(confirm("是否确认删除？")){
            location.href="{{url('/alien/destroy')}}/"+id;
        }
    });
    //无刷新分页
    $(document).on("click",".pagination a",function(){
        //获取当前点击的超链接
        var url=$(this).attr("href");
        //第一种
        // $.get(url,function(result){
        //      $("tbody").html(result);
        // });
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.post(url,function(result){
             $("tbody").html(result);
        });
        return false;
    });
});    
</script>

</body>
</html>