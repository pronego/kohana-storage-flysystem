<?php defined('SYSPATH') or die('No direct script access.');

use Sabre\DAV\Client;
use League\Flysystem\WebDAV\WebDAVAdapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Webdav extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $client = new Client($config);
        $prefix = Arr::get($config, 'prefix', null);
        $this->_adapter = new WebDAVAdapter($client, $prefix);
    }

    
}
