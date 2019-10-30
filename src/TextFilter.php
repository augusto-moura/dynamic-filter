<?php
namespace AugustoMoura\DynamicFilter;

class TextFilter
{
	public $fieldName;
	public $placeholder;

	function __construct(string $fieldName, string $placeholder)
	{
		$this->fieldName = $fieldName;
		$this->placeholder = $placeholder;
	}
	
	public function render()
	{
		return view('dynamic-filter::text-filter', [
			'fieldName' => $this->fieldName,
			'placeholder' => $this->placeholder,
		]);
	}
}
