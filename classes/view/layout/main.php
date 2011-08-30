<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Main view
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Layout_Main extends Kostache {
    public $header;
    public $content;
    public $footer;
    
    public function title()
    {
        return __('Main menu');
    }

}