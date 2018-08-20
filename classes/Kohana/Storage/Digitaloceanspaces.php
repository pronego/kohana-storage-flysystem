<?php defined('SYSPATH') or die('No direct script access.');

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_Digitaloceanspaces extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $region = Arr::get($config, 'region', 'nyc3');
        $bucket = Arr::get($config, 'bucket', null);
        $prefix = Arr::get($config, 'prefix', null);
        $client = new S3Client([
            'credentials' => [
                'key' => Arr::get($config, 'key', null),
                'secret' => Arr::get($config, 'secret', null),
            ],
            'region' => $region,
            'version' => Arr::get($config, 'version', 'latest'),
            'endpoint' => 'https://'.$region.'.digitaloceanspaces.com',
        ]);
        $this->_adapter = new AwsS3Adapter($client, $bucket);
    }

    
}
