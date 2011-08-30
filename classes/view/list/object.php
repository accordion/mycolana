<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Object extends View_Pagination_Basic
{
    public $title = 'Objects:';
    private $orm_model;
    
    public function __construct($orm_model) {
        $this->orm_model = $orm_model;
        parent::__construct();
    }
    
    protected function _create_pagination() 
    {
    	return new ORMPagination(array('orm_model' => $this->orm_model));    
    }
    
    public function objects()
    {
        $route = Route::get('default');
        $objects = array();
        foreach ($this->pagination->query() as $object)
        {
        	$object_array = $object->as_array();
                $object_array['uri'] = URL::site(NULL, TRUE) . 'detail/object/' . $object->id;
        	$measures = array();
            foreach ($object->measure->find_all() as $measure)
            {
//            	 $measures[] = $measure->as_array();
                $measures[] = array('value' => $measure->get_values());
            }
            
            $object_array['measure'] = $measures;
            $objects[] = $object_array;
        }
        return $objects;
    }
}