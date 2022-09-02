<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Adapter\Local;
use League\Flysystem\Cached\CachedAdapter;

/**
 * Kohana Storage class
 *
 * This is just a thin wrapper that handles the configuration
 * for the Flysystem package that abstract filesystems.
 *
 * The structure of this closely follows the Kohana Cache module
 * where you have to called instance() to create a singleton of the
 * flysystem adapter
 *
 *
 * @author Chris Go <chris@velocimedia.com>
 * @author Dr. Manuel Lamotte-Schubert <mls@pronego.com>
 */

class Kohana_Storage
{
    
    /**
     * Instances
     * @var array
     */
    public static $instances = [];
    
    /**
     * Creates a singleton of a Kohana Storage
     *
     * $default_disk = Storage::instance();
     *
     * // Create an instance of a disk
     * $local_disk = Storage::instance('local');
     * $cloud_disk = Storage::instance('cloud');
     *
     * // Access an instantiated disk directly
     * $local_disk = Storage::$instances['local'];
     *
     * @param string|array $storage Disk string or Array containing a valid config block.
     *
     * @return Kohana_Storage
     *@throws Storage_Exception
     */
    public static function instance($storage = NULL)
    {
        // Disk string or config array provided?
        if (is_string($storage))
        {
            // If there is no disk supplied, use the default disk
            if (empty($storage))
            {
                $storage = Kohana::$config->load('storage.default');
            }
            // If initiated already, just return that disk
            if ( ! empty(self::$instances[$storage]))
            {
                return self::$instances[$storage];
            }

            // Load disks config
            $config = Kohana::$config->load('storage');

            // If config does not exist for the disk specific, throw exception
            if ( ! $config->offsetExists($storage))
            {
                throw new Storage_Exception('Failed to load Kohana Storage disk: :disk', [
                    ':disk' => $storage,
                ]);
            }

            // Load config for disk
            $config = $config->get($storage);
        }
        else
        {
            $config = (array) $storage;
            // Look for a key 'name' in config array, otherwise generate a unique temporary name
            $storage = Arr::get($config, 'name', uniqid('dynamic_'));
        }

        // Create a new adapter
        $storage_class_name = 'Storage_'.ucfirst(Arr::get($config, 'driver'));
        $storage_class = new $storage_class_name($config);
        // If there is a cache, create the cached adapter
        $cache = Arr::get($config, 'cache');
        if ( ! empty($cache))
        {
            $config = Kohana::$config->load('storage.'.$storage.'.cache');
            $cache_class_name = 'Storage_Cache_'.ucfirst(Arr::get($config, 'store'));
            $cache_class = new $cache_class_name($config);
            $adapter = new CachedAdapter($storage_class->adapter(), $cache_class->store());
        }
        else
        {
            $adapter = $storage_class->adapter();
        }

        // Create the filesystem object
        self::$instances[$storage] = new Filesystem($adapter);

        // Return the instance
        return self::$instances[$storage];
    }
    
    /**
     * Convenience function for local storage
     * @return Kohana_Storage
     */
    public static function local()
    {
        return self::instance('local');
    }
}