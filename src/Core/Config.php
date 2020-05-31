<?php

namespace JoshWhatK\ThemosisFramework\Core;

class Config
{
    protected $config_directory;
    protected $config_folder = 'config';
    protected $items = [];

    public function __construct($starting_directory = null)
    {
        $starting_directory = is_null($starting_directory)
                                ? get_stylesheet_directory()
                                : $starting_directory;

        $this->config_directory = $starting_directory . '/' . $this->config_folder;

        $this->build($this->getConfigFileNames());
    }

    public function get($item, $parent = null)
    {
        $item_parts = explode('.', $item);
        $part = array_shift($item_parts);
        $items = is_null($parent) ? $this->items : $parent;

        if (!key_exists($part, $items)) {
            /**
             * @todo Log an exception to the debug error log so we'll know that the key doesn't exist.
             */
            return null;
        }

        if (count($item_parts) > 0) {
            return $this->get(join('.', $item_parts), $items[$part]);
        }

        return $items[$part];
    }

    private function getConfigFileNames()
    {
        if (!file_exists($this->config_directory)) {
            return [];
        }

        $files = scandir($this->config_directory);
        $files = array_filter($files, function ($file) {
            return $file !== '.' && $file !== '..' && substr($file, 0, 1) !== '.';
        });
        $files = array_map(function ($file) {
            return str_replace('.php', '', $file);
        }, $files);

        return $files;
    }

    private function build($files)
    {
        foreach ($files as $file) {
            $this->items[$file] = require($this->config_directory . '/' . $file . '.php');
        }
    }
}
