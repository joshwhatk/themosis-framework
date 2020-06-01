<?php

namespace JoshWhatK\ThemosisFramework\App;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Container\Container as BaseContainer;
use JoshWhatK\ThemosisFramework\Contracts\IsAnApplication;

class Container extends BaseContainer implements Application
{
    use IsAnApplication;

    public static function startUp()
    {
        return $GLOBALS[static::class] ?? $GLOBALS[static::class] = static::getInstance();
    }
}
