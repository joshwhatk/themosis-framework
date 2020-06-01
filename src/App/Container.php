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
            $this['action']->add($hooks, [$instance, 'register'], $instance->priority);
        } else {
            $instance->register();
        }
    }
}
