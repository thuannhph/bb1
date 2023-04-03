<?php

namespace Botble\Money\Providers;

use Botble\Money\Models\Money;
use Illuminate\Support\ServiceProvider;
use Botble\Money\Repositories\Caches\MoneyCacheDecorator;
use Botble\Money\Repositories\Eloquent\MoneyRepository;
use Botble\Money\Repositories\Interfaces\MoneyInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class MoneyServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(MoneyInterface::class, function () {
            return new MoneyCacheDecorator(new MoneyRepository(new Money));
        });

        $this->setNamespace('plugins/money')->loadHelpers();
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
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Money::class, [
                    'name',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Money::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-money',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/money::money.name',
                'icon'        => 'fa fa-list',
                'url'         => route('money.index'),
                'permissions' => ['money.index'],
            ]);
        });
    }
}
