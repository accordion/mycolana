<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Object extends Model_Base {
	
	protected $_belongs_to = array('building' => array());
	protected $_has_many = array('measure' => array());
	
}
