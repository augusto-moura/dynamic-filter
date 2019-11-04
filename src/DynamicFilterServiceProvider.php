<?php
namespace AugustoMoura\DynamicFilter;

use Illuminate\Support\ServiceProvider;

class DynamicFilterServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		if(!defined('DYNAMIC_FILTER_SRC'))
			define('DYNAMIC_FILTER_SRC', __DIR__);

		$this->loadViewsFrom(DYNAMIC_FILTER_SRC . '/resources/views', 'dynamic-filter');
		
		$this->publishes([
			DYNAMIC_FILTER_SRC . '/resources/views' => resource_path('views/vendor/dynamic-filter'),
		]);
    }
}