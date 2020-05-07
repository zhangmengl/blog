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

<center><h2>新闻列表<a href="{{url('/xinwen/create')}}" style="float:right" class="btn btn-default">添加</a></h2></center><br>

<div class="table-responsive">
	  <table class="table">
        @foreach($xinwen as $v)
		    <thead>
			      <tr>
				        <th>
                            <a href="{{url('/xinwen/xwindex/'.$v->xinwen_id)}}" >{{$v->xinwen_name}}</a>
                        </th>
                        <th>
                            @if($v->isclick)
                            <a  id="add_{{$v->xinwen_id}}" href="javascript:lessverb({{$v->xinwen_id}})"  class="btn btn-primary">取消点赞</a>
                            @else
                            <a  id="add_{{$v->xinwen_id}}" href="javascript:addverb({{$v->xinwen_id}})"  class="btn btn-primary">点赞</a> 
                            @endif
                            <span id ="verb_{{$v->xinwen_id}}">{{$v->count}}</span>
                        </th>
                        
			      </tr>
		    </thead>
		@endforeach   
    </table>
    
</div>  	
<script>
    //点赞
    function addverb(xinwen_id){
        if(!xinwen_id){
            return;
        }
        $.get("/xinwen/addverb",{xinwen_id:xinwen_id},function(res){
            if(res.code=='00000'){
                $("#add_"+xinwen_id).text("取消点赞");
                $("#add_"+xinwen_id).attr("href","javascript:lessverb("+xinwen_id+")");
                $("#verb_"+xinwen_id).text(res.count);
            }
        },'json')
    }
    //取消点赞
    function lessverb(xinwen_id){
        if(!xinwen_id){
            return;
        }
        $.get("/xinwen/lessverb",{xinwen_id:xinwen_id},function(res){
            if(res.code=='00000'){
                $("#add_"+xinwen_id).text("点赞");
                $("#add_"+xinwen_id).attr("href","javascript:addverb("+xinwen_id+")");
                $("#verb_"+xinwen_id).text(res.count);
            }
        },'json')
    }
</script>

</body>
</html>