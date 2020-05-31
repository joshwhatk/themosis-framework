<?php

namespace JoshWhatK\ThemosisFramework\App;

use Illuminate\Container\Container as BaseContainer;
use Illuminate\Contracts\Foundation\Application;
use JoshWhatK\ThemosisFramework\Contracts\IsAnApplication;

class Container implements Application
{
    use IsAnApplication;

    protected $container = null;

    public static function startUp()
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
    }
}
