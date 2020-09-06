<?php

namespace Ringierimu\Experiments;

use Illuminate\Support\ServiceProvider;

class ExperimentsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishConfig();
    }

    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'experiments');
        $this->commands(
            [
                Console\InstallCommand::class,
            ]
        );
    }

    /**
     * Return config file.
     *
     * @return string
     */
    protected function configPath()
    {
        return __DIR__ . '/../config/recommend.php';
    }

    /**
     * Publish config file.
     */
    protected function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    $this->configPath() => config_path('recommend.php'),
                ],
                'recommend-config'
            );
        }
    }
}