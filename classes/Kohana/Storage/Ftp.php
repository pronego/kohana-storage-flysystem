<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Adapter\Ftp as FtpAdapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Ftp extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $this->_adapter = new FtpAdapter($config);
    }

    
}
