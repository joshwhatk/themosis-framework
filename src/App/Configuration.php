<?php

namespace JoshWhatK\ThemosisFramework\App;

use Illuminate\Container\Container as BaseContainer;
use JoshWhatK\ThemosisFramework\Core\Config;

class Configuration
{
    protected $config = null;

    public static function boot()
    {
        return $GLOBALS[static::class] ?? $GLOBALS[static::class] = new static();
    }

    public function config()
    {
        return $this->config;
    }

    protected function __construct()
    {
        $this->config = new Config(get_stylesheet_directory());
    }
}
