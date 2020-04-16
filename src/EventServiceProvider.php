<?php

namespace Sunxyw\LaravelQuickRole;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ProvidersEventServiceProvider;

class EventServiceProvider extends ProvidersEventServiceProvider
{
    protected $listen = [];

    /**
     * 注册事件
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
