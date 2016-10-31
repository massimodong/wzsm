@if (env('APP_DEBUG') == false)
<script>
if (location.protocol != 'https:')
{
	 location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}
</script>
@endif
