<div>
<form action='/admin/options' method='POST'>
{{csrf_field()}}
{{method_field('PUT')}}

@for ($i=0;$i<count($options);$i++)
<a>{{$options[$i][1]}}:</a>
<input type='text' name="{{$options[$i][0]}}" value="{{App\Option::option($options[$i][0])->value}}"><br>
@endfor

<button type='submit'>submit</button>
</form>
</div>
