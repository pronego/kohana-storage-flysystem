<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kohana Storage
 *
 * @package    Kohana/Storage
 */
abstract class Kohana_Storage_Base
{
    
    /**
     * Adapter object
     * @var unknown
     */
    public $_adapter;
    
    /**
     * Return the adapter
     * @return unknown
     */
    public function adapter()
    {
        // See if we need to load up a cached adapter
        
        
        return $this->_adapter;
    }
    
    /**
     * Try to load up a cached adapter
     */
    
    
    
    
}
