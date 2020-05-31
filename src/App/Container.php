<?php

namespace JoshWhatK\ThemosisFramework\App;

use Illuminate\Container\Container as BaseContainer;

class Container
{
    protected $container = null;

    public static function boot()
    {
        return $GLOBALS[static::class] ?? $GLOBALS[static::class] = new static();
    }

    public function container()
    {
        return $this->container;
    }

    protected function __construct()
    {
        $this->container = BaseContainer::getInstance();
        $this->container->instance('Config', Configuration::boot()->config());
    }
}
