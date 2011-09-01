<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Custom object handler class
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Action_Object extends Controller_Action_Generic {
    
    public function handle_get() {
        echo "hello from custom object handler";
        parent::handle_get();
    }

}
