<?php

use JoshWhatK\ThemosisFramework\App\Configuration;
use JoshWhatK\ThemosisFramework\App\Container;

if (!function_exists('_app')) {
    function _app($key = null)
    {
        $container = Container::startUp()->container();
        if (!is_null($key)) {
            return $container->get($key);
        }

        return $container;
    }
}

if (!function_exists('_config')) {
    function _config($key = null)
    {
        $config = Configuration::boot()->config();
        if (!is_null($key)) {
            return $config->get($key);
        }

        return $config;
    }
}
