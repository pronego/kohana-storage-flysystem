<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Memory\MemoryAdapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Memory extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $this->_adapter = new MemoryAdapter();
    }

    
}
