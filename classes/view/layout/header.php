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
                . '">' . Request::current()->controller() . '</a>';
        $path .= $delimiter;
        $path .= '<a href="' . URL::site() . Request::current()->controller() 
                . '/' . Request::current()->action() . '">'
                . Request::current()->action() . '</a>';
        
//        $id = Request::current()->param('id');
//        if(isset($id))
//        {
//            $path .= $delimiter;
//            $path .= '<a href="' . URL::site() . Request::current()->controller() 
//                    . '/' . Request::current()->action() . '/' . $id . '">'
//                    . $id . '</a>';
//        }
        
        return $path;
    }
}