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
		$this->loadViewsFrom(__DIR__.'/views', 'dynamic-filter');
		
		$this->publishes([
			__DIR__.'/views' => resource_path('views/vendor/dynamic-filter'),
		]);
    }
}