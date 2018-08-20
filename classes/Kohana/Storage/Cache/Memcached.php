<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Cached\Storage\Memcached as MemcachedStore;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Cache_Memcached extends Storage_Cache_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $memcached = new Memcached;
        $hostname = Arr::get($config, 'hostname', 11211);
        $port = Arr::get($config, 'port', 11211);
        $expire = Arr::get($config, 'expire', 300);
        $prefix = Arr::get($config, 'prefix', 'storageKey');
        $memcached->addServer($hostname, $port);
        $this->_store = new MemcachedStore($memcached, $prefix, $expire);
    }

    
}
