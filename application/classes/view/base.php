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
}
