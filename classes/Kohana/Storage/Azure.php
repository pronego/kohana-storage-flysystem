<?php defined('SYSPATH') or die('No direct script access.');

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Azure extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $name = Arr::get($config, 'name', null);
        $key = Arr::get($config, 'key', null);
        $container = Arr::get($config, 'container', null);
        $service = 'DefaultEndpointsProtocol=https;AccountName={'.$name.'};AccountKey={'.$key.'};';
        $client = BlobRestProxy::createBlobService($service);
        $this->_adapter = new AzureBlobStorageAdapter($client, $container);
    }

    
}
