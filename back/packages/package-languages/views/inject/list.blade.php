<div align="left">
{{ _('This lang version') }}: <b>{{ $this_lang }}</b>
</div>
<div align="right" style="margin-top: -20px;margin-bottom: 20px;">
	{{ _('Translation') }}:
	<div class="btn-group" >
	@foreach($languages as $lang)
	<a class="btn btn-default btn-sm @if($this_lang == $lang->code ) active  @endif " href="?lang={{ $lang->code }}" > {{ $lang->title }} </a>
	@endforeach
	</div>
</div>
