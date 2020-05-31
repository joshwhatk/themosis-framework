<?php

namespace JoshWhatK\ThemosisFramework;

use JoshWhatK\ThemosisFramework\Database\Instance;

class Plugin
{
    public static function boot()
    {
        return new static();
    }

    protected function __construct()
    {
        Instance::boot();
    }
}
