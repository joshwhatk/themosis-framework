<?php

use JoshWhatK\ThemosisFramework\App\Configuration;
use JoshWhatK\ThemosisFramework\App\Container;

if (!function_exists('app')) {
    function app()
    {
        return Container::boot()->container();
    }
}

if (!function_exists('config')) {
    function config()
    {
        return Configuration::boot()->config();
    }
}
