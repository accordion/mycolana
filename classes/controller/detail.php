<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Detail controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Detail extends Controller { 
    
    public function action_index()
    {

    }
    
    public function action_object()
    {
        echo Kohana_Debug::vars(Model_Base::get_config('objects'));
    }
}