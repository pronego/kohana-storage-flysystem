<?php defined('SYSPATH') or die('No direct script access.');

use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Dropbox extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $auth_token = Arr::get($config, 'auth_token');
        $client = new Client($auth_token);
        $this->_adapter = new DropboxAdapter($client);
    }

    
}
