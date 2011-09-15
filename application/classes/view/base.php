<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract base class for all Kostache base views
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class View_Base extends Kostache {
    
    public final function base_url()
    {
        return URL::site(null, true);
    }
    
    public final function reset()
    {
        return __('Reset');
    }
    
    public final function cancel()
    {
        return __('Cancel');
    }
    
    public final function delete()
    {
        return __('Delete');
    }
    
    public final function assign()
    {
        return __('Assign');
    }
    
    public final function create()
    {
        return __('Create');
    }
}
