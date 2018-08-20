<?php defined('SYSPATH') or die('No direct script access.');

// Configuration for storage systems

return [

    // Default
    'default' => 'local',  // 's3'

    // Filesystem Disks
    // Here you may configure as many filesystem "disks" as you wish, and you
    // may even configure multiple disks of the same driver. Defaults have
    // been setup for each driver as an example of the required options.
    //
    // Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    
    'local' => [
        'driver' => 'local',
        'root' => sys_get_temp_dir(),
    ],

    's3' => [
        'driver' => 's3',
        'key' => null,
        'secret' => null,
        'region' => 'us-east-1',        // or app.aws.s3.region
        'bucket' => null,
        'url' => null,
        'version' => 'latest',
        'prefix' => null,
        // for performance, use cache: memory, predis or memcached
        //'cache' => [
        //    'store' => 'memory',
        //],
        //'cache' => [
        //    'store' => 'predis',
        //    'client' => 'tcp://localhost:6379',  // default
        //    'password' => null,
        //    'expire' => 600,
        //    'prefix' => 'prc.storage.cache',
        //],
        //'cache' => [
        //    'store' => 'memcached',
        //    'hostname' => 'localhost',
        //    'port' => 11111,
        //    'expire' => 600,
        //    'prefix' => 'cache-prefix',
        //],
    ],

    'ftp' => [
        'driver'   => 'ftp',
        'host'     => 'ftp.example.com',
        'username' => 'your-username',
        'password' => 'your-password',
        // Optional FTP Settings...
        // 'port'     => 21,
        // 'root'     => '',
        // 'passive'  => true,
        // 'ssl'      => true,
        // 'timeout'  => 30,
    ],

    'sftp' => [
        'driver' => 'sftp',
        'host' => 'example.com',
        'username' => 'your-username',
        'password' => 'your-password',

        // Settings for SSH key based authentication...
        // 'privateKey' => '/path/to/privateKey',
        // 'password' => 'encryption-password',

        // Optional SFTP Settings...
        // 'port' => 22,
        // 'root' => '',
        // 'timeout' => 30,
    ],

];
