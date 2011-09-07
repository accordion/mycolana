<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Main view
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Layout_Main extends Kostache {
    public $header;
    public $content;
    public $context;
    public $footer;    
    public $title;
       
    public function scripts()
    {
        return array(
            array('script' => HTML::script('media/js/jquery-1.6.2.min.js')),
            array('script' => HTML::script('media/js/jquery-ui-1.8.16.custom.min.js')),
            array('script' => HTML::script('media/js/jquery.form.js')),
            array('script' => HTML::script('media/js/mycolex2.js')),
        );
    }
    
    public function styles()
    {
        $screen = array('media' => 'screen, projection');
        $print = array('media' => 'print');
        
        return array(
            // <!-- Blueprint Stylesheets -->
            array('style' => HTML::style('media/css/blueprint/screen.css', $screen)),
            array('style' => HTML::style('media/css/blueprint/print.css', $print)),
            array('style' => '<!--[if IE]-->'),
            array('style' => HTML::style('media/css/blueprint/ie.css', $screen)),
            array('style' => '<![endif]-->'),
            // <!-- Fancy Type Plugin -->
            array('style' => HTML::style('media/css/blueprint/plugins/fancy-type/screen.css', $screen)),
            // <!-- Button plugin -->
            array('style' => HTML::style('media/css/blueprint/plugins/buttons/screen.css', $screen)),
            // <!-- custom style -->
            array('style' => HTML::style('media/css/style.css', $screen)),
            // <!-- jquery-ui smoothness style -->
            array('style' => HTML::style('media/css/jquery-ui.css', $screen))
        );
    }
}
