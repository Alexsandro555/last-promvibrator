<?php

namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Product\Entities\Attribute;
use Modules\Product\Entities\AttributeUnit;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\LineProduct;
use Modules\Product\Entities\AttributeGroup;
use Modules\Product\Entities\Tnved;
use Modules\Product\Entities\Producer;
use Modules\Product\Entities\Sku;
use Modules\Product\Entities\AttributeSkuOption;

use Modules\Product\Observers\UrlKeyObserver;
use Modules\Product\Repositories\ProductCategory\ProductCategoryRepository;
use Modules\Product\Repositories\ProductCategory\EloquentProductCategoryRepository;
use Modules\Product\Repositories\TypeProduct\TypeProductRepository;
use Modules\Product\Repositories\TypeProduct\EloquentTypeProductRepository;
use Modules\Product\Repositories\LineProduct\LineProductRepository;
use Modules\Product\Repositories\LineProduct\EloquentLineProductRepository;
use Modules\Product\Repositories\Attribute\AttributeRepository;
use Modules\Product\Repositories\Attribute\EloquentAttributeRepository;

class ProductServiceProvider extends ServiceProvider
{
  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  /**
   * Boot the application events.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerTranslations();
    $this->registerConfig();
    $this->registerViews();
    $this->registerFactories();
    $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->register(RouteServiceProvider::class);
    $this->app->bind('Product', function ($app) {
      return new Product();
    });
    $this->app->bind('Attribute', function ($app) {
      return new Attribute();
    });
    $this->app->bind('ProductCategory', function ($app) {
      return new ProductCategory();
    });
    $this->app->bind('TypeProduct', function ($app) {
      return new TypeProduct();
    });
    $this->app->bind('LineProduct', function ($app) {
      return new LineProduct();
    });
    $this->app->bind('AttributeUnit', function ($app) {
      return new AttributeUnit();
    });
    $this->app->bind('AttributeGroup', function ($app) {
      return new AttributeGroup();
    });
    $this->app->bind('Tnved', function ($app) {
      return new Tnved();
    });
    $this->app->bind('Producer', function ($app) {
      return new Producer();
    });
    $this->app->bind('TradeOffer', function ($app) {
      return new Sku();
    });
    $this->app->bind('Sku', function ($app) {
      return new Sku();
    });
    $this->app->bind('SkuOptions', function ($app) {
      return new AttributeSkuOption();
    });

    ProductCategory::observe(UrlKeyObserver::class);
    TypeProduct::observe(UrlKeyObserver::class);
    LineProduct::observe(UrlKeyObserver::class);
    Product::observe(UrlKeyObserver::class);
    Producer::observe(UrlKeyObserver::class);
    AttributeUnit::observe(UrlKeyObserver::class);
    AttributeGroup::observe(UrlKeyObserver::class);
    Attribute::observe(UrlKeyObserver::class);

    $this->app->singleton(ProductCategoryRepository::class, EloquentProductCategoryRepository::class);
    $this->app->singleton(TypeProductRepository::class, EloquentTypeProductRepository::class);
    $this->app->singleton(LineProductRepository::class, EloquentLineProductRepository::class);
    $this->app->singleton(AttributeRepository::class, EloquentAttributeRepository::class);
  }

  /**
   * Register config.
   *
   * @return void
   */
  protected function registerConfig()
  {
    $this->publishes([
      __DIR__ . '/../Config/config.php' => config_path('product.php'),
    ], 'config');
    $this->mergeConfigFrom(
      __DIR__ . '/../Config/config.php', 'product'
    );
  }

  /**
   * Register views.
   *
   * @return void
   */
  public function registerViews()
  {
    $viewPath = resource_path('views/modules/product');

    $sourcePath = __DIR__ . '/../Resources/views';

    $this->publishes([
      $sourcePath => $viewPath
    ], 'views');

    $this->loadViewsFrom(array_merge(array_map(function ($path) {
      return $path . '/modules/product';
    }, \Config::get('view.paths')), [$sourcePath]), 'product');
  }

  /**
   * Register translations.
   *
   * @return void
   */
  public function registerTranslations()
  {
    $langPath = resource_path('lang/modules/product');

    if (is_dir($langPath)) {
      $this->loadTranslationsFrom($langPath, 'product');
    } else {
      $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'product');
    }
  }

  /**
   * Register an additional directory of factories.
   *
   * @return void
   */
  public function registerFactories()
  {
    if (!app()->environment('production')) {
      app(Factory::class)->load(__DIR__ . '/../Database/factories');
    }
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return [];
  }
}
