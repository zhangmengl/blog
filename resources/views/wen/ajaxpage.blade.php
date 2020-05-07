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
                    <a href="{{url('/wen/destroy/'.$v->wen_id)}}" class="btn btn-danger">删除</a>
                </td>
			</tr>
		    @endforeach
            <tr><td colspan="9">{{$wen->appends($all)->links()}}</td></tr>