<?php

namespace JoshWhatK\ThemosisFramework\Database;

class Instance
{
    public static function boot()
    {
        return new static();
    }

    protected function __construct()
    {
        defined('DB_PREFIX') or define('DB_PREFIX', 'wp_');

        $capsule = new Capsule;
        $capsule->addConnection([
            "driver" => "mysql",
            "host" => DB_HOST,
            "database" => DB_NAME,
            "username" => DB_USER,
            "password" => DB_PASSWORD,
            "prefix" => DB_PREFIX
        ]);

        //Make this Capsule instance available globally.
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM.
        $capsule->bootEloquent();
    }
}
