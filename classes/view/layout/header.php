<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Header
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Layout_Header extends Kostache {
    public function path()
    {
        $delimiter = ' >> ';
        $path = '<a href="' . URL::site() . '">mycolana</a>';
        $path .= $delimiter;
        $path .= '<a href="' . URL::site() . Request::current()->controller() 
                . '">' . __(Request::current()->controller()) . '</a>';
        $path .= $delimiter;
        $path .= '<a href="' . URL::site() . Request::current()->controller() 
                . '/' . Request::current()->action() . '">'
                . __(Request::current()->action()) . '</a>';
        
        return $path;
    }
}