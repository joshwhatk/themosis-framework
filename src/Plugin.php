<?php

namespace JoshWhatK\ThemosisFramework;

use JoshWhatK\ThemosisFramework\App\Container;
use JoshWhatK\ThemosisFramework\Database\Instance as Database;

class Plugin
{
    public static function boot()
    {
        return new static();
    }

    protected function __construct()
    {
        Container::boot();
        Database::boot();
    }
}
