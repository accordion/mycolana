<?php defined('SYSPATH') or die('No direct script access.');

/**
 *Interface for the action handlers
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
interface Controller_Action_Handler {
    
    public function handle_get();
    public function handle_post();
    public function handle_search();

}
