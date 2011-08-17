<?php defined('SYSPATH') or die('No direct script access.');

/**
 * List controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_List extends Controller { 
    
    public function action_index()
    {
        echo 'Hallo :)';
    }
    
    public function action_object()
    {
        echo new View_List_Object();
    }
    
}
