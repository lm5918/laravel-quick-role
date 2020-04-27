<?php

namespace Sunxyw\LaravelQuickRole;

use Illuminate\Support\ServiceProvider as SupportServiceProvider;

/**
 * 服务提供者
 *
 * @package Sunxyw\LaravelQuickRole
 * @author sunxyw <xy2496419818@gmail>
 */
class ServiceProvider extends SupportServiceProvider
{
    /**
     * 在注册后启动服务
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/quick-role.php' => config_path('quick-role.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/migrations/' => database_path('migrations'),
        ], 'migrations');
        $this->loadMigrationsFrom(__DIR__ . '/src/migrations');
    }

    /**
     * 在容器中注册绑定
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/quick-role.php',
            'quick-role'
        );
        // TODO: 尝试监听用户注册事件
        $this->app->register(EventServiceProvider::class);
    }
}
