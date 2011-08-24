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
    
    public function scripts()
    {
        $scripts = HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js');
        $scripts .= HTML::script('https://raw.github.com/malsup/form/master/jquery.form.js');
        $scripts .= HTML::script('scripts/mycolex2.js');
        return $scripts;
    }
}