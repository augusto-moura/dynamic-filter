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
		ob_start();
		?>

		<div class="area-filter">
			<div class="area-filter-items">
				<?php foreach($this->filters as $filter): ?>
					<?= $filter->render() ?>
				<?php endforeach;?>	
			</div>
			<div class="area-applied-filter">
			</div>
			<input type="hidden" name="filters" value='{}' />
		</div>
		
		<?php
		return ob_get_clean();
	}

	/**
	 * Retorna string contendo um elemento <script> contendo script JS dos filtros dinâmicos.
	 */
	public static function js() : string
	{
		ob_start();
		?>
		<script>
			<?php require public_path('js/filtro-dinamico.js')?>
		</script>
		<?php
		return ob_get_clean();
	}
}
