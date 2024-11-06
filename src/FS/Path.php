<?php

declare(strict_types=1);

namespace Leaf\FS;

class Path
{
    public string $pathToParse;

    public function __construct($path)
    {
        $this->pathToParse = $path;
    }

    /**
     * Return the parent directory of the path
     * @return string
     */
    public function dirname()
    {
        return dirname($this->pathToParse);
    }

    /**
     * Return the last part of the path
     * @return string
     */
    public function basename()
    {
        return basename($this->pathToParse);
    }

    /**
     * Return the extension of the path
     * @return string
     */
    public function extension()
    {
        return pathinfo($this->pathToParse, PATHINFO_EXTENSION);
    }

    /**
     * Join multiple path parts using the correct directory separator
     * @param array $paths
     * @return string
     */
    public function join(...$paths)
    {
        return (new Path($this->pathToParse . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $paths)))->normalize();
    }

    /**
     * Fix the path to use the correct directory separator
     * @return string
     */
    public function normalize()
    {
        if (file_exists($this->pathToParse) && realpath($this->pathToParse)) {
            return realpath($this->pathToParse);
        }

        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $this->pathToParse);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');

        $normalized = [];

        foreach ($parts as $part) {
            if ('.' == $part) {
                continue;
            }

            switch ('..') {
                case $part:
                    array_pop($normalized);
                    break;
                default:
                    $normalized[] = $part;
                    break;
            }
        }

        return implode(DIRECTORY_SEPARATOR, $normalized);
    }
}
