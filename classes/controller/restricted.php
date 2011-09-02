<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract controller for pages which need login
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class Controller_Restricted extends Controller_Base { 
    
    public function before()
    {
        parent::before();
        
        if(!Auth::instance()->logged_in())
        {
            $this->redirect('auth/login');
        }
    }
}
