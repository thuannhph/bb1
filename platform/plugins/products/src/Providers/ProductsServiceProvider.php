<?php

namespace Botble\Products\Providers;

use Botble\Products\Models\Products;
use Illuminate\Support\ServiceProvider;
use Botble\Products\Repositories\Caches\ProductsCacheDecorator;
use Botble\Products\Repositories\Eloquent\ProductsRepository;
use Botble\Products\Repositories\Interfaces\ProductsInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class ProductsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(ProductsInterface::class, function () {
            return new ProductsCacheDecorator(new ProductsRepository(new Products));
        });

        $this->setNamespace('plugins/products')->loadHelpers();
    }

    public function boot()
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                // Use language v2
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Products::class, [
                    'name',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Products::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-products',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/products::products.name',
                'icon'        => 'fa fa-list',
                'url'         => route('products.index'),
                'permissions' => ['products.index'],
            ]);
        });
    }
}
