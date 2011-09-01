<?php defined('SYSPATH') or die('No direct script access.');

/**
 *Interface for the action handlers
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
interface Controller_Action_Handler {
    
    public function handle_get();
    public function handle_save();
    public function handle_delete();
    public function handle_search();

}
