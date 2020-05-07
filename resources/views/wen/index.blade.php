<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<center><h2>文章列表<a href="{{url('/wen/create')}}" style="float:right" class="btn btn-default">添加</a></h2></center><br>

<form action="{{url('/wen/index')}}">
    <input type="text" name="wen_name" value="{{$all['wen_name']??''}}" placeholder="请输入文章标题关键字">
    <select name="wenf_name">
        <option value="0">请选择</option>
        @foreach ($wenf as $v)
            <option value="{{$v->wenf_name}}" {{($all['wenf_name']??'')==$v->wenf_name ? "selected" : ""}}>{{$v->wenf_name}}</option>
        @endforeach
    </select>
    <button>搜索</button>
</form>
<hr>
<div class="table-responsive">
	  <table class="table">
		    <thead>
			      <tr>
				        <th>ID</th>
				        <th>文章标题</th>
                        <th>文章类型</th>
                        <th>文章重要性</th>
                        <th>是否显示</th>
                        <th>文章作者</th>
                        <th>作者email</th>
                        <th>文章LOGO</th>
                        <th>操作</th>
			      </tr>
		    </thead>
		    <tbody>
            @foreach ($wen as $v) 
			<tr>
			    <td>{{$v->wen_id}}</td>
				<td>{{$v->wen_name}}</td>
                <td>{{$v->wenf_name}}</td>
                <td>{{$v->wen_an=="1" ? "普通" : "置顶"}}</td>
                <td>{{$v->wen_show=="1" ? "√" : "×"}}</td>
                <td>{{$v->wen_man}}</td>
                <td>{{$v->wen_email}}</td>
                <td>@if($v->wen_logo)<img src="{{env('UPLOADS_URL')}}{{$v->wen_logo}}" width="45px" height="45px">
                    @endif
                </td>
                <td>
                    <a href="{{url('/wen/edit/'.$v->wen_id)}}" class="btn btn-primary">编辑</a>
                    <a id="{{$v->wen_id}}" class="btn btn-danger">删除</a>
                </td>
			</tr>
		    @endforeach
            <tr><td colspan="9">{{$wen->appends($all)->links()}}</td></tr>
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
            $.get('/wen/destroy/'+id,function(result){
                if(result.code=='00000'){
                    location.reload();
                }
            },'json');
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