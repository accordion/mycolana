<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for buildings
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Building extends ORM {
    
	protected $_has_many = array('objects' => array());
}