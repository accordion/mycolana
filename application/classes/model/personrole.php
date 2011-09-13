<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for personroles
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Personrole extends Model_Base {
    
    protected $_belongs_to = array(
        'person' => array(),
        'object' => array(),
    );
    
}