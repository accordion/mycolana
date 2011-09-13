<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Object extends Model_Base {
	
    protected $_belongs_to = array('building' => array());
    protected $_has_many = array(
        'measures' => array(),
        'locations' => array(),
        'personroles' => array(),
        'persons' => array(
            'model'   => 'person',
            'through' => 'personroles',
        ),
    );
    
    
    public function fields()
    {
        $buildings = array('' => 'none');
        foreach(Model_Base::factory('building')->find_all() as $building)
        {
            $buildings[$building->id] = $building->bubuilding;
        }

        return  array(
            'obobject' => array(
                'options' => array(
                    'cols' => 20,
                    'rows' => 2,
                )
            ),
            'building_id' => array(
                'type' => 'select', 
                'options' => $buildings,
                'selected' => $this->building->id
                ),
            'obshort' => array(
                'type'=>'select', 
                'options' => array(
                    '' => 'none',
                    1 => 'one',
                    2 => 'two'
                    ),
                'selected' => $this->obshort
                ),
            'obcheck' => array(
                'type' => 'checkbox'
                ),
            );
    }
        
}
