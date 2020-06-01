<?php

namespace JoshWhatK\ThemosisFramework;

use Themosis\Core\HooksRepository;
use Illuminate\Contracts\Foundation\Application;
use JoshWhatK\ThemosisFramework\App\Configuration;
use JoshWhatK\ThemosisFramework\Database\Instance as Database;

class Plugin
{
    public static function boot()
    {
        return new static();
    }

    protected function __construct()
    {
        Database::boot();
        // _app()->instance('Config', Configuration::boot()->config());
        // _app()->alias('action', \Themosis\Hook\ActionBuilder::class);
        // _app()->bind('action', new \Themosis\Hook\ActionBuilder(_app()));
        // _app()->alias('filter', \Themosis\Hook\FilterBuilder::class);
        // _app()->bind('filter', new \Themosis\Hook\FilterBuilder(_app()));
        // $this->registerCoreContainerAliases();
        // $this->registerConfiguredHooks();
    }

    public function registerConfiguredHooks(string $config = '')
    {
        if (empty($config)) {
            $config = 'app.hooks';
        }

        $hooks = _config($config);

        (new HooksRepository(_app()))->load($hooks->all());
    }

    protected function registerCoreContainerAliases()
    {
        $list = [
            'action' => [
                \Themosis\Hook\ActionBuilder::class
            ],
            'ajax' => [
                \Themosis\Ajax\Ajax::class
            ],
            'app' => [
                Application::class,
                \Illuminate\Contracts\Container\Container::class,
                \Illuminate\Contracts\Foundation\Application::class,
                \Psr\Container\ContainerInterface::class
            ],
            'asset' => [
                \Themosis\Asset\Factory::class,
            ],
            'auth' => [
                \Illuminate\Auth\AuthManager::class,
                \Illuminate\Contracts\Auth\Factory::class
            ],
            'auth.driver' => [
                \Illuminate\Contracts\Auth\Guard::class
            ],
            'auth.password' => [
                \Illuminate\Auth\Passwords\PasswordBrokerManager::class,
                \Illuminate\Contracts\Auth\PasswordBrokerFactory::class
            ],
            'auth.password.broker' => [
                \Illuminate\Auth\Passwords\PasswordBroker::class,
                \Illuminate\Contracts\Auth\PasswordBroker::class
            ],
            'blade.compiler' => [
                \Illuminate\View\Compilers\BladeCompiler::class
            ],
            'cache' => [
                \Illuminate\Cache\CacheManager::class,
                \Illuminate\Contracts\Cache\Factory::class
            ],
            'cache.store' => [
                \Illuminate\Cache\Repository::class,
                \Illuminate\Contracts\Cache\Repository::class
            ],
            'config' => [
                \Illuminate\Config\Repository::class,
                \Illuminate\Contracts\Config\Repository::class
            ],
            'cookie' => [
                \Illuminate\Cookie\CookieJar::class,
                \Illuminate\Contracts\Cookie\Factory::class,
                \Illuminate\Contracts\Cookie\QueueingFactory::class
            ],
            'db' => [
                \Illuminate\Database\DatabaseManager::class
            ],
            'db.connection' => [
                \Illuminate\Database\Connection::class,
                \Illuminate\Database\ConnectionInterface::class
            ],
            'encrypter' => [
                \Illuminate\Encryption\Encrypter::class,
                \Illuminate\Contracts\Encryption\Encrypter::class
            ],
            'events' => [
                \Illuminate\Events\Dispatcher::class,
                \Illuminate\Contracts\Events\Dispatcher::class
            ],
            'files' => [
                \Illuminate\Filesystem\Filesystem::class
            ],
            'filesystem' => [
                \Illuminate\Filesystem\FilesystemManager::class,
                \Illuminate\Contracts\Filesystem\Factory::class
            ],
            'filesystem.disk' => [
                \Illuminate\Contracts\Filesystem\Filesystem::class
            ],
            'filesystem.cloud' => [
                \Illuminate\Contracts\Filesystem\Cloud::class
            ],
            'filter' => [
                \Themosis\Hook\FilterBuilder::class
            ],
            'form' => [
                \Themosis\Forms\FormFactory::class
            ],
            'hash' => [
                \Illuminate\Hashing\HashManager::class
            ],
            'hash.driver' => [
                \Illuminate\Contracts\Hashing\Hasher::class
            ],
            'html' => [
                \Themosis\Html\HtmlBuilder::class
            ],
            'log' => [
                \Illuminate\Log\LogManager::class,
                \Psr\Log\LoggerInterface::class
            ],
            'mailer' => [
                \Illuminate\Mail\Mailer::class,
                \Illuminate\Contracts\Mail\Mailer::class,
                \Illuminate\Contracts\Mail\MailQueue::class
            ],
            'metabox' => [
                \Themosis\Metabox\Factory::class
            ],
            'posttype' => [
                \Themosis\PostType\Factory::class
            ],
            'redirect' => [
                \Illuminate\Routing\Redirector::class
            ],
            'redis' => [
                \Illuminate\Redis\RedisManager::class,
                \Illuminate\Contracts\Redis\Factory::class
            ],
            'request' => [
                \Illuminate\Http\Request::class,
                \Symfony\Component\HttpFoundation\Request::class
            ],
            'router' => [
                \Themosis\Route\Router::class,
                \Illuminate\Routing\Router::class,
                \Illuminate\Contracts\Routing\Registrar::class,
                \Illuminate\Contracts\Routing\BindingRegistrar::class
            ],
            'session' => [
                \Illuminate\Session\SessionManager::class
            ],
            'session.store' => [
                \Illuminate\Session\Store::class,
                \Illuminate\Contracts\Session\Session::class
            ],
            'taxonomy' => [
                \Themosis\Taxonomy\Factory::class
            ],
            'taxonomy.field' => [
                \Themosis\Taxonomy\TaxonomyFieldFactory::class
            ],
            'translator' => [
                \Illuminate\Translation\Translator::class,
                \Illuminate\Contracts\Translation\Translator::class
            ],
            'twig' => [
                \Twig_Environment::class
            ],
            'url' => [
                \Illuminate\Routing\UrlGenerator::class,
                \Illuminate\Contracts\Routing\UrlGenerator::class
            ],
            'validator' => [
                \Illuminate\Validation\Factory::class,
                \Illuminate\Contracts\Validation\Factory::class
            ],
            'view' => [
                \Illuminate\View\Factory::class,
                \Illuminate\Contracts\View\Factory::class
            ],
        ];

        foreach ($list as $key => $aliases) {
            foreach ($aliases as $alias) {
                _app()->alias($key, $alias);
            }
        }
    }
}
