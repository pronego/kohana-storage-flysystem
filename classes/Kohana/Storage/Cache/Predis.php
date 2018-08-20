<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\Cached\Storage\Predis as PredisStore;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Cache_Predis extends Storage_Cache_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $password = Arr::get($config, 'password', null);
        $client = new Predis\Client($config);
        if (!empty($password)) {
            $options = [
                'parameters' => [
                    'password' => $password,
                    'database' => 10,
                ],
            ];
            $this->_store = new PredisStore($client, $options);
        } else {
            $this->_store = new PredisStore($client);
        }
    }

    
}
