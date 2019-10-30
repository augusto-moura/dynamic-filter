<div class="btn-group mr-2 mb-1 filter-item d-inline-block">
	<button class="btn btn-outline-secondary btn-sm p-0">
		<input id="dynamic_filter_{{$fieldName}}" 
		type="checkbox" 
		name="{{$fieldName}}" 
		class="checkbox-filter sr-only" 
		value="1"
		data-field="{{$fieldName}}"
		data-label="{{$label}}"
		/>
		
		<label class="font-weight-bold mb-0 py-1 px-2" for="dynamic_filter_{{$fieldName}}">
			{{$label}}
		</label>
	</button>
</div>
