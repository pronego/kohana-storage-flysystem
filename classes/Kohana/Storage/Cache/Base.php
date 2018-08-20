<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kohana Storage
 *
 * @package    Kohana/Storage
 */
abstract class Kohana_Storage_Cache_Base
{
    
    /**
     * Store object
     * @var unknown
     */
    public $_store;
    
    /**
     * Return the adapter
     * @return unknown
     */
    public function store()
    {
        return $this->_store;
    }
    
    
}
