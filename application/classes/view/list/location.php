<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for locations
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Location extends Kostache {
    
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
        parent::__construct();
    }
    
    public function locations()
    {
        $locations = array();
        foreach($this->model->find_all() as $location) 
        {
            $locations[] = $location->as_array();
        }
        return $locations;
    }
    
}