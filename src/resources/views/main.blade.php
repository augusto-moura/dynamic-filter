<div class="dynamic-filter">
	<div class="filter-inputs">
		@foreach($filters as $filter)
			{!! $filter->render() !!}
		@endforeach
	</div>
	<div class="applied-filters">
	</div>
	<input type="hidden" name="filters" value='{}' />
</div>