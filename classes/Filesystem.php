<?php
use \League\Flysystem\Filesystem as FlysystemFilesystem;

/**
 * Extension to support prepending and appending strings to files.
 * File is created, if it doesn't exist.
 *
 * @copyright (c) 2022 wissen.online
 * @author    Dr. Manuel Lamotte-Schubert, pronego (https://www.pronego.com)
 * @date      2022-08-31 11:18
 */
class Filesystem extends FlysystemFilesystem
{
    /**
     * Prepend to a file.
     *
     * @param  string  $path
     * @param  string  $data
     * @param  string  $separator
     * @return bool
     */
    public function prepend($path, $data, $separator = PHP_EOL)
    {
        if ($this->fileExists($path))
        {
            return $this->write($path, $data.$separator.$this->read($path));
        }

        return $this->write($path, $data);
    }


    /**
     * Append to a file.
     *
     * @param  string  $path
     * @param  string  $data
     * @param  string  $separator
     *
     * @return bool
     */
    public function append($path, $data, $separator = PHP_EOL)
    {
        if ($this->fileExists($path))
        {
            return $this->write($path, $this->read($path).$separator.$data);
        }

        return $this->write($path, $data);
    }
}