<h2>控制器</h2><hr>
<form action='{{url("/add_do")}}' method='post'>
{{csrf_field()}}
<input type='text' name='name'>
<button>提交</button>
</form>