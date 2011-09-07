<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for locations
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Model_Location extends Model_Base {
	
    protected $_belongs_to = array(
        'object' => array(),
        'building' => array()
    );
    
    public function fields()
    {
        $buildings = array('' => 'none');
        foreach(Model_Base::factory('building')->find_all() as $building)
        {
            $buildings[$building->id] = $building->bubuilding;
        }

        return  array(
            'building_id' => array(
                'type' => 'select', 
                'options' => $buildings,
                'selected' => $this->building->id
            ),
        );
    }
}