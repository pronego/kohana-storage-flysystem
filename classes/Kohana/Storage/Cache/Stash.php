<?php defined('SYSPATH') or die('No direct script access.');

use Stash\Pool;
use League\Flysystem\Cached\Storage\Stash as StashStore;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Cache_Stash extends Storage_Cache_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $expire = Arr::get($config, 'expire', 300);
        $prefix = Arr::get($config, 'prefix', 'storageKey');
        $prefix = Arr::get($config, 'prefix', 'storageKey');
        $pool = new Pool();
        // you can optionally pass a driver (recommended, default: in-memory driver)
        $this->_store = new StashStore($pool, $prefix, $expire);
    }

    
}
