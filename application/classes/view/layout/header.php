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
    
    public function username() 
    {
        if(Auth::instance()->logged_in())
        {
            $logout = ' <a href="' . URL::site(null, true) . 'auth/logout">' . __('Logout') . '</a>';
            return __('Logged in as: ') . Auth::instance()->get_user() . $logout;
        }
        return '';
    }
    
    public function header_links()
    {
        return array(
            array(
                'link' => URL::site(null, true) . 'detail/object',
                'label' => __('Search/create new object')
            ),
            array(
                'link' => URL::site(null, true) . 'list/object',
                'label' => __('Object list')
            ),
            array(
                'link' => URL::site(null, true) . 'auth/login',
                'label' => __('Login')
            ),
        );
    }
}