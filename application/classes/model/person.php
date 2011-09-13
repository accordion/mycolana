<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for person
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Person extends Model_Base {
    
    protected $_table_name = 'people'; 
    protected $_has_many = array(
        'personroles' => array(),
        'objects' => array(
            'model'   => 'object',
            'through' => 'personroles',
        ),
    );
}