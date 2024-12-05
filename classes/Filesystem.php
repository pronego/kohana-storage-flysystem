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
	 * @var array
	 */
	public $config = [];


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
	 * @param mixed       $external_url string|false|null
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
		$url = ($external_url ?: $this->config['url']);

		if ( ! $url)
		{
			return FALSE;
		}

		// Append directory if not exists
		if ( ! strpos('/' . $path, $this->config['directory']))
		{
			$path = $this->config['directory'] . trim($path, '/');
		}

		return $protocol . '://' . $url . '/'. trim($path, '/');
	}


	/**
	 * @param string $storage_path
	 * @param string $local_path
	 *
	 * @return void
	 * @throws \League\Flysystem\FilesystemException
	 */
	public function get(string $storage_path, string $local_path)
	{
		$storage_stream = $this->readStream($storage_path);
		$local_file = fopen($local_path, 'w');

		stream_copy_to_stream($storage_stream, $local_file);

		fclose($local_file);
		fclose($storage_stream);
	}


	/**
	 * @param string $source
	 * @param string $destination
	 * @param array  $config
	 * @param bool   $overwrite
	 *
	 * @return void
	 * @throws \League\Flysystem\FilesystemException
	 */
	public function move(string $source, string $destination, array $config = [], bool $overwrite = TRUE): void
	{
		if ($overwrite AND $this->fileExists($destination)) {
			$this->delete($destination);
		}

		parent::move($source, $destination, $config);
	}
}