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
	public $config;


	/**
	 * Prepend to a file.
	 *
	 * @param string $path
	 * @param string $data
	 * @param string $separator
	 *
	 * @return bool
	 * @throws \League\Flysystem\FilesystemException
	 */
    public function prepend(string $path, string $data, string $separator = PHP_EOL)
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


	/**
	 * @param string      $path
	 * @param             $external_url
	 * @param string|NULL $protocol
	 *
	 * @return false|string
	 */
	public function url(string $path, $external_url = FALSE, string $protocol = NULL)
	{
		if (empty($protocol))
		{
			$protocol = Arr::get($this->config, 'protocol');
		}

		// Allows external (base) url, for example, pointing to video cloud
		if ($external_url)
		{
			$this->config['url'] = $external_url;
		}

		if ( ! $this->config['url'])
		{
			return FALSE;
		}

		return $protocol . '://' . $this->config['url'] . '/'. trim($path, '/');
	}
}