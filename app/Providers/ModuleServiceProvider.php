<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (glob(app_path('Modules/*'), GLOB_ONLYDIR) as $modulePath) {
            $module = basename($modulePath);
            $provider = "App\\Modules\\$module\\{$module}ServiceProvider";

            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }
}
