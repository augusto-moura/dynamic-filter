@php
/**
 * @var Illuminate\Support\Collection $filters
 * @var Illuminate\Support\Collection $initialValues
 **/	
@endphp

<div class="dynamic-filter">
	<div class="filter-inputs">
		@foreach($filters as $filter)
			{!! $filter->render() !!}
		@endforeach
	</div>
	<div class="applied-filters">
	</div>
	<input type="hidden" name="filters" value='{{ 
		$initialValues->isEmpty() ? 
		'{}' :
		$initialValues->toJson()
	}}' />
</div>