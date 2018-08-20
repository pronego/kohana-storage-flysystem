<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Adapter\NullAdapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Null extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $this->_adapter = new NullAdapter();
    }

    
}
