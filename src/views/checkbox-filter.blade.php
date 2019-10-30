<div class="btn-group mr-2 mb-1 item-filtro">
	<button type="button" class="btn btn-outline-secondary btn-sm">
		<div class="custom-control custom-checkbox">
			<input id="dynamic_filter_{{$fieldName}}" 
			type="checkbox" 
			name="{{$fieldName}}" 
			class="custom-control-input filtro-checkbox" 
			value="1"
			data-campo="{{$fieldName}}"
			data-label="{{$label}}"
			/>
			<label class="custom-control-label" for="dynamic_filter_{{$fieldName}}">
				<strong>{{$label}}</strong>
			</label>
		</div>
	</button>	
</div>
