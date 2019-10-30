<div class="btn-group mr-2 mb-1 item-filtro">
	<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<b>{{$label}}</b>
	</button>
	<div class="dropdown-menu dropdown-menu-right">
		@foreach ($options as $option)
			<button class="dropdown-item filtro-dropdown" type="button"
			data-campo="{{$fieldName}}"
			data-value="{{$option->value}}">
				{{ $option->label }}
			</button>
		@endforeach
	</div>
</div>
