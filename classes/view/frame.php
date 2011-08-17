<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract base class for all kostache views
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class View_Frame extends Kostache {
	
	protected $_partials = array(
	    'header' => 'header',       // Loads templates/header.mustache
	    'footer' => 'footer', 	// Loads templates/footer.mustache
	);
	
	public $header_title = "hello world";
	public $footer_text = "This is defined in View_Frame";
        
}