<?php

namespace JoshWhatK\ThemosisFramework;

use Themosis\Core\HooksRepository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;
use JoshWhatK\ThemosisFramework\App\Configuration;
use JoshWhatK\ThemosisFramework\Contracts\IsAnApplication;
use JoshWhatK\ThemosisFramework\Database\Instance as Database;

class Plugin extends Container implements Application
{
    use IsAnApplication;

    public static function startUp()
    {
        return new static();
    }

    protected function __construct()
    {
        Database::boot();
        _app()->instance('Config', Configuration::boot()->config());
        _app()->alias('action', \Themosis\Hook\ActionBuilder::class);
        _app()->bind('action', new \Themosis\Hook\ActionBuilder(_app()));
        _app()->alias('filter', \Themosis\Hook\FilterBuilder::class);
        _app()->bind('filter', new \Themosis\Hook\FilterBuilder(_app()));
        $this->registerConfiguredHooks();
    }

    public function registerConfiguredHooks(string $config = '')
    {
        if (empty($config)) {
            $config = 'app.hooks';
        }

        $hooks = _config($config);

        (new HooksRepository($this))->load($hooks->all());
    }

    /**
     * Create and register a hook instance.
     *
     * @param string $hook
     */
    public function registerHook(string $hook)
    {
        // Build a "Hookable" instance.
        // Hookable instances must extend the "Hookable" class.
        $instance = new $hook($this);
        $hooks = (array) $instance->hook;

        if (! method_exists($instance, 'register')) {
            return;
        }

        if (! empty($hooks)) {
            _app('action')->add($hooks, [$instance, 'register'], $instance->priority);
        } else {
            $instance->register();
        }
    }
}
