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