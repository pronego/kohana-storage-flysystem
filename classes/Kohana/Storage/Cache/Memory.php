<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Cached\Storage\Memory as MemoryStore;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Cache_Memory extends Storage_Cache_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $this->_store = new MemoryStore();
    }

    
}
