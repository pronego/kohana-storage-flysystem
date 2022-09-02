<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\PhpseclibV3\SftpAdapter;
use League\Flysystem\PhpseclibV3\SftpConnectionProvider;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Sftp extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $connection_provider = new SftpConnectionProvider(
            Arr::get($config, 'host'),
            Arr::get($config, 'username'),

            // from here optional
            Arr::get($config, 'password') // password (optional, default: null) set to null if privateKey is used
            //Arr::get($config, 'private_key'),
            //Arr::get($config, 'pass_phrase'),
            //Arr::get($config, 'port', 22),
            //Arr::get($config, 'use_agent'),
            //Arr::get($config, 'timeout'),
            //Arr::get($config, 'max_tries'),
            //Arr::get($config, 'finterprint_string'),
            //Arr::get($config, 'connectivity_checker')
        );
        $this->_adapter = new SftpAdapter($connection_provider, Arr::get($config, 'root_path', '.'));
    }

    
}
