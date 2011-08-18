<?php defined('SYSPATH') or die('No direct script access.');

/**
 * List controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_List extends Controller_Base { 
    
    public function action_index()
    {
        $this->layout->content = "Hallo";
    }
    
    public function action_object()
    {
        $this->layout->content = new View_List_Object;
    }
    
}
