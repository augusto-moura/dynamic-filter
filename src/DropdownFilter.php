<?php
namespace AugustoMoura\DynamicFilter;

use Illuminate\Support\Collection;

class DropdownFilter
{
	public $fieldName;
	public $label;
	public $options;

	function __construct(string $fieldName, string $label, Collection $options, string $direction = 'down')
	{
		$this->fieldName = $fieldName;
		$this->label = $label;
		$this->options = $options;
		$this->direction = $direction;
	}

	public function getBtnGroupClass()
	{
		switch($this->direction){
			case 'up': return 'dropup';
			case 'left': return 'dropleft';
			case 'right': return 'dropright';
			case 'down': 
			default: 
				return '';
		}
	}
	
	public function render()
	{
		return view('dynamic-filter::dropdown-filter', [
			'fieldName' => $this->fieldName,
			'label' => $this->label,
			'options' => $this->options,
			'btnGroupClass' => $this->getBtnGroupClass(),
		]);
	}
}
