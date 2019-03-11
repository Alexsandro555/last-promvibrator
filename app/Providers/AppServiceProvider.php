<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\Entities\TypeProduct;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('layouts.master', function($view) {
        $typeProducts = TypeProduct::take(8)->get();
        $view->with('typeProducts', $typeProducts);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(FakerGenerator::class, function () {
        return FakerFactory::create('ru_RU');
      });
    }
}
