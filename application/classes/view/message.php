<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view for messages
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Message extends Kostache {
    
    public function messages()
    {
        return Messages::popAll();
    }
    
}