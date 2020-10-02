/**
 * Dynamic filter tool in real time. The main element é input[name=filters], which is constantly updated and contains the currently applied filters.
 */

 /**
  * Remove field from input[name=filters] JSON
  */
 function removeAppliedFilter(field){
	$filters = getFilterListElement();
	let filters = JSON.parse($filters.val());
	delete filters[field];
	$('.text-filter[data-field='+field+']').val(''); //if there is a .text-filter from this field, empty input.
	$('.checkbox-filter[data-field='+field+']').prop('checked', false); //if there is a .text-checkbox from this field, uncheck it.
	$filters.val(JSON.stringify(filters));
	$filters.trigger('change');
	refreshAppliedFilters();
}

 /**
  * Update input[name=filters] JSON
  */
function updateFiltersJSON(field, newValue, newLabel){
	$filters = getFilterListElement();
	let filters = JSON.parse($filters.val());
	filters[field] = {value: newValue, label: newLabel};
	$filters.val(JSON.stringify(filters));
	$filters.trigger('change');
	refreshAppliedFilters();
}

/**
 * Refresh HTML in div.applied-filters with badges.
 */
function refreshAppliedFilters(){
	$filters = getFilterListElement();
	filters = JSON.parse($filters.val());
	$appliedFiltersArea = $('.applied-filters');
	$appliedFiltersArea.html("");
	for(field in filters){
		$appliedFiltersArea.append(
			'<a href="#" class="badge badge-secondary text-white p-2 mx-1 remove-filter" '+
			' data-field="'+field+'">'
				+filters[field].label+
				'<i class="fa fa-fw fa-times"></i>'+
			'</a>'
		);
	}
}

function getFilterListElement(){
	return $('.dynamic-filter input[name=filters]').first();
}

$(document).ready(function(){
	$('.dynamic-filter').on('value-change', '.filter-item', function(event, field, newValue, newLabel){
		if(typeof newValue === 'string' && newValue.trim() == ''){
			removeAppliedFilter(field);
			return;
		}
		updateFiltersJSON(field, newValue, newLabel);
	});

	$('.dynamic-filter').on('click', '.remove-filter', function(event){
		event.preventDefault();
		$badge = $(this);
		field = $badge.attr('data-field');
		removeAppliedFilter(field);
	});

	var textFilterTO;
	//Listeners for changes in .filter-item. They trigger the 'value-change' event.
	$('.dynamic-filter').on('input', '.text-filter', function(event){
		clearTimeout(textFilterTO);
		textFilterTO = setTimeout(function(){
			$input = $(this);
			let field = $input.attr('data-field');
			let value = $input.val().trim();
			$input.closest('.filter-item').trigger('value-change', [field, value, value]);
		}.bind(this), 500);
	});

	$('.dynamic-filter').on('click', '.dropdown-filter', function(event){
		$button = $(this);
		let field = $button.attr('data-field');
		let value = $button.attr('data-value');
		let label = $button.html().trim();
		$button.closest('.filter-item').trigger('value-change', [field, value, label]);
	});

	$('.dynamic-filter').on('change', '.checkbox-filter', function(event){
		$checkbox = $(this);
		let field = $checkbox.attr('data-field');
		let value = $checkbox.is(':checked') ? true : '';
		let label = $checkbox.attr('data-label');
		$checkbox.closest('.filter-item').trigger('value-change', [field, value, label]);
	});

	refreshAppliedFilters();
});