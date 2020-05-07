<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新闻</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<center><h2>新闻详情<a href="{{url('/xinwen/index')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>

<div class="table-responsive">
	  <table class="table">
		    <thead>
			      <tr>
				        <th>新闻ID</th>
                        <th>新闻标题</th>
                        <th>新闻作者</th>
                        <th>新闻描述</th>
						<th>添加时间</th>
			      </tr>
		    </thead> 
			<tbody>
			<tr>
			    <td>{{$info->xinwen_id}}</td>
				<td>{{$info->xinwen_name}}</td>
                <td>{{$info->xinwen_man}}</td>
                <td>{{$info->xinwen_desc}}</td>
                <td>{{date("Y-m-d H:i:s",$info->xinwen_time)}}</td>
			</tr>
        </tbody> 
    </table>
    
</div>  	


</body>
</html>