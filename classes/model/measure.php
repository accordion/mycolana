<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for measurements
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Measure extends Model_Base {
	
    protected $_belongs_to = array('object' => array());	
        
    public function get_values()
    {
        return $this->medim . ' is from method, values is: ' . $this->mevalue;
    }
    
    public function fields()
    {
        return array(
            'object_id' => array(
                'type' => 'input',
                'options' => array(
                    'disabled' => 'true'
                )
            )
        );
    }       
        
}