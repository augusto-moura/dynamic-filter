<?php
namespace AugustoMoura\DynamicFilter;

class CheckboxFilter
{
	public $fieldName;
	public $label;

	function __construct(string $fieldName, string $label)
	{
		$this->fieldName = $fieldName;
		$this->label = $label;
	}
	
	public function render()
	{
		return view('dynamic-filter::checkbox-filter', [
			'fieldName' => $this->fieldName,
			'label' => $this->label,
		]);
	}
}
