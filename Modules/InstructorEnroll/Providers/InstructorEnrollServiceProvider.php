<?php

namespace Modules\InstructorEnroll\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class InstructorEnrollServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('InstructorEnroll', 'Database/Migrations'));
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
            module_path('InstructorEnroll', 'Config/config.php') => config_path('instructorenroll.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('InstructorEnroll', 'Config/config.php'), 'instructorenroll'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/instructorenroll');

        $sourcePath = module_path('InstructorEnroll', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/instructorenroll';
        }, \Config::get('view.paths')), [$sourcePath]), 'instructorenroll');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/instructorenroll');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'instructorenroll');
        } else {
            $this->loadTranslationsFrom(module_path('InstructorEnroll', 'Resources/lang'), 'instructorenroll');
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
            app(Factory::class)->load(module_path('InstructorEnroll', 'Database/factories'));
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
