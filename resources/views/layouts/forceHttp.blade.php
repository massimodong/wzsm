@if(env('APP_DEBUG') ==false)
<script>
if (location.protocol != 'http:')
{
	 location.href = 'http:' + window.location.href.substring(window.location.protocol.length);
}
</script>
@endif
