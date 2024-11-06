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
    public function extname()
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
        return realpath($this->pathToParse . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $paths));
    }

    /**
     * Fix the path to use the correct directory separator
     * @return string
     */
    public function normalize()
    {
        $this->pathToParse = realpath($this->pathToParse);

        return $this->pathToParse;
    }
}
