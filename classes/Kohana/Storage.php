<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

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
     * @param unknown $disk
     * @throws Storage_Exception
     * @return Kohana_Storage
     */
    public static function instance($disk = null)
    {
        // If there is no disk supplied, use the default disk
        if (empty($disk)) {
            $disk = Kohana::$config->load('storage.default');
        }
        // If initiated already, just return that disk
        if (!empty(Storage::$instances[$disk])) {
            return Storage::$instances[$disk];
        }
        // Load config
        $config = Kohana::$config->load('storage');
        // If config does not exist for the disk specific, throw exception
        if ( ! $config->offsetExists($disk)) {
            throw new Storage_Exception('Failed to load Kohana Storage disk: :disk', [
                ':disk' => $disk,
            ]);
        }
        // Load config for disk
        $config = $config->get($disk);
        // Create a new adapter
        $storage_class_name = 'Storage_'.ucfirst(Arr::get($config, 'driver'));
        $storage_class = new $storage_class_name($config);
        // If there is a cache, create the cached adapter
        $cache = Arr::get($config, 'cache', null);
        if (!empty($cache)) {
            $config = Kohana::$config->load('storage.'.$disk.'.cache');
            $cache_class_name = 'Storage_Cache_'.ucfirst(Arr::get($config, 'store'));
            $cache_class = new $cache_class_name($config);
            $adapter = new \League\Flysystem\Cached\CachedAdapter(
                $storage_class->adapter(),
                $cache_class->store()
            );
        } else {
            $adapter = $storage_class->adapter();
        }
        // Create the filesystem object
        Storage::$instances[$disk] = new Filesystem($storage_class->adapter());
        // Return the instance
        return Storage::$instances[$disk];
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