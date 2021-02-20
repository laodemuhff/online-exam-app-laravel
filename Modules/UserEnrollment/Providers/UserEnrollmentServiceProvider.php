<?php

namespace Modules\UserEnrollment\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class UserEnrollmentServiceProvider extends ServiceProvider
{
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
        $this->loadMigrationsFrom(module_path('UserEnrollment', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('UserEnrollment', 'Config/config.php') => config_path('userenrollment.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('UserEnrollment', 'Config/config.php'), 'userenrollment'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/userenrollment');

        $sourcePath = module_path('UserEnrollment', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/userenrollment';
        }, \Config::get('view.paths')), [$sourcePath]), 'userenrollment');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/userenrollment');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'userenrollment');
        } else {
            $this->loadTranslationsFrom(module_path('UserEnrollment', 'Resources/lang'), 'userenrollment');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('UserEnrollment', 'Database/factories'));
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
