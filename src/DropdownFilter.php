<?php
namespace AugustoMoura\DynamicFilter;

use Illuminate\Support\Collection;

class DropdownFilter
{
	public $fieldName;
	public $label;
	public $options;

	function __construct(string $fieldName, string $label, Collection $options)
	{
		$this->fieldName = $fieldName;
		$this->label = $label;
		$this->options = $options;
	}
	
	public function render()
	{
		return view('dynamic-filter::dropdown-filter', [
			'fieldName' => $this->fieldName,
			'label' => $this->label,
			'options' => $this->options,
		]);
	}
}
