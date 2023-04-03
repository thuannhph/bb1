<?php

namespace Botble\Vip\Providers;

use Botble\Vip\Models\Vip;
use Illuminate\Support\ServiceProvider;
use Botble\Vip\Repositories\Caches\VipCacheDecorator;
use Botble\Vip\Repositories\Eloquent\VipRepository;
use Botble\Vip\Repositories\Interfaces\VipInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class VipServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(VipInterface::class, function () {
            return new VipCacheDecorator(new VipRepository(new Vip));
        });

        $this->setNamespace('plugins/vip')->loadHelpers();
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
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Vip::class, [
                    'name',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Vip::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-vip',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/vip::vip.name',
                'icon'        => 'fa fa-list',
                'url'         => route('vip.index'),
                'permissions' => ['vip.index'],
            ]);
        });
    }
}
