<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Object extends View_Pagination_Basic
{
    public $title = 'All objects with obinv > 200 paginated:';
    
    protected function _create_pagination() 
    {
    	$orm_model = ORM::factory('object')->where('obinv', '>', 200);
    	return new ORMPagination(array('orm_model' => $orm_model));    
    }
    
    public function objects()
    {
        $objects = array();
        foreach ($this->pagination->query() as $object)
        {
        	$object_array = $object->as_array();
        	$measures = array();
            foreach ($object->measure->find_all() as $measure)
            {
//            	 $measures[] = $measure->as_array();
                $measures[] = array('value' => $measure->get_values());
            }
            
            $object_array['measure'] = $measures;
            $objects[] = $object_array;
        }
//        echo Kohana_Debug::vars($objects);
        return $objects;
    }
}