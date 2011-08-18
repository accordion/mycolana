<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Header
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Layout_Header extends Kostache {
    public function path()
    {
        return 'mycolana >> ' . Request::current()->controller() . ' >> ' 
                . Request::current()->action();
    }
}