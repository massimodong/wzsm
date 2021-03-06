<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->publishes([
			    'vendor/tinymce/tinymce' => public_path('vendor/tinymce'),
			    'vendor/twbs/bootstrap'  => public_path('vendor/bootstrap'),
	    ], 'public');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
