<?php defined('SYSPATH') or die('No direct script access.');

use OpenCloud\OpenStack;
use OpenCloud\Rackspace;
use League\Flysystem\Rackspace\RackspaceAdapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Rackspace extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $prefix = Arr::get($config, 'prefix', null);
        $region = Arr::get($config, 'region', 'LON');
        $client = new OpenStack(Rackspace::UK_IDENTITY_ENDPOINT, [
            'username' => Arr::get($config, 'username'),
            'password' => Arr::get($config, 'password'),
        ]);
        $store = $client->objectStoreService('cloudFiles', $region);
        $container = $store->getContainer('flysystem');
        $this->_adapter = new RackspaceAdapter($container, $prefix);
    }

    
}
