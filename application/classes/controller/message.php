<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Message controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Message extends Controller {
    
    
    public function action_index()
    {
//        Messages::put('error', "xxx testnachricht");
        echo new View_Message;
    }
    
}