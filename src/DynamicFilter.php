<?php
namespace AugustoMoura\DynamicFilter;

use Illuminate\Support\Collection;

class DynamicFilter
{
	public $filters; //Illuminate\Support\Collection
	public $initialValues; //Illuminate\Support\Collection
	const TEXT = 'text';
	const DROPDOWN = 'dropdown';
	const CHECKBOX = 'checkbox';

	function __construct()
	{
		$this->filters = new Collection();
		$this->initialValues = collect([]);
	}

	public static function new()
	{
		return new self();
	}

	/**
	 * Set the initial values for the dynamic filter. The filter will be rendered with these values already applied.
	 * @param Iterable $initialValues The values with which the filter will be rendered initially. Can be an array or Illuminate\Support\Collection. Ex.: ['user' => ['value' => 1, 'label' => 'User: John']]
	 * @return self Self-returning.
	 */
	public function withInitialValues(Iterable $initialValues)
	{
		$this->initialValues = Collection::wrap($initialValues);
		return $this;
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
	public function withDropdownFilter(string $fieldName, string $label, Collection $options, string $direction = 'down')
	{
		$this->filters->push(new DropdownFilter($fieldName, $label, $options, $direction));
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
		return view('dynamic-filter::main', [
			'filters' => $this->filters, 
			'initialValues' => $this->initialValues,
		]);
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
