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
    public $title = 'Hauptmenü';
    
    public function scripts()
    {
        $scripts = HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js') . "\n";
        $scripts .= HTML::script('https://raw.github.com/malsup/form/master/jquery.form.js') . "\n";
        $scripts .= HTML::script('media/js/mycolex2.js') . "\n";
        return $scripts;
    }

}