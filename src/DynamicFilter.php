<?php
namespace AugustoMoura\DynamicFilter;

use Illuminate\Support\Collection;

class DynamicFilter
{
	public $filters; //Illuminate\Support\Collection
	const TEXT = 'text';
	const DROPDOWN = 'dropdown';
	const CHECKBOX = 'checkbox';

	function __construct()
	{
		$this->filters = new Collection();
	}

	public static function new()
	{
		return new self();
	}

	public function withTextFilter(string $fieldName, string $placeholder)
	{
		$this->filters->push(new TextFilter($fieldName, $placeholder));
		return $this;
	}

	/**
	 * Add dropdown filter to the Filters.
	 * @param string $fieldName The field's name.
	 * @param string $label The field's label, which will be used as the text for the dropdown button.
	 * @param Illuminate\Support\Collection $options The collection with the dropdown options. Each element must have the 'value' and 'label' keys.
	 * @return self Self-returning.
	 */
	public function withDropdownFilter(string $fieldName, string $label, Collection $options)
	{
		$this->filters->push(new DropdownFilter($fieldName, $label, $options));
		return $this;
	}

	/**
	 * Add checkbox filter to the Filters.
	 * @param string $fieldName The field's name.
	 * @param string $label The field's label
	 * @return self Self-returning.
	 */
	public function withCheckboxFilter(string $fieldName, string $label)
	{
		$this->filters->push(new CheckboxFilter($fieldName, $label));
		return $this;
	}

	/**
	 * Add a simple <br /> line break, for better manipulation of filter elements in .area-filter
	 * @return self Self-returning.
	 */
	public function withLineBreak()
	{
		$this->filters->push(new LineBreak());
		return $this;
	}

	public function render()
	{
		return view('dynamic-filter::main', ['filters' => $this->filters]);
	}

	/**
	 * Return string containg a <script> element that contains the necessary javascript for the dynamic filter. This needs to be added AFTER JQuery.
	 */
	public static function js() : string
	{
		ob_start();
		?>
		<script>
			<?php require (DYNAMIC_FILTER_SRC . '/resources/js/dynamic-filter.js') ?>
		</script>
		<?php
		return ob_get_clean();
	}
}
