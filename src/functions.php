<?php

declare(strict_types=1);

if (!function_exists('path')) {
    /**
     * Return the Leaf instance
     *
     */
    function path(string $path): Leaf\FS\Path
    {
        if (!(\Leaf\Config::getStatic('path'))) {
            \Leaf\Config::singleton('path', function () use ($path) {
                return new \Leaf\FS\Path($path);
            });
        }

        return \Leaf\Config::get('path');
    }
}

if (!function_exists('storage')) {
    /**
     * Return the Leaf instance
     *
     */
    function storage(): Leaf\FS\Storage
    {
        if (!(\Leaf\Config::getStatic('storage'))) {
            \Leaf\Config::singleton('storage', function () {
                return new \Leaf\FS\Storage();
            });
        }

        return \Leaf\Config::get('storage');
    }
}
