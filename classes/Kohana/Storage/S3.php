<?php defined('SYSPATH') or die('No direct script access.');

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

/**
 * Kohana Storage
 *
 * @package Kohana/Storage
 */
class Kohana_Storage_S3 extends Storage_Base
{

    /**
     * Construct
     * @param unknown $config
     */
    public function __construct($config)
    {
        $client = S3Client::factory([
            'credentials' => [
                'key' => Arr::get($config, 'key', null),
                'secret' => Arr::get($config, 'secret', null),
            ],
            'region' => Arr::get($config, 'region', 'us-east-1'),
            'version' => Arr::get($config, 'version', 'latest'),
        ]);
        $bucket = Arr::get($config, 'bucket', null);
        $prefix = Arr::get($config, 'prefix', null);
        $this->_adapter = new AwsS3Adapter($client, $bucket, $prefix);
    }

    
}
