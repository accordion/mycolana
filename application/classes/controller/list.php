<?php defined('SYSPATH') or die('No direct script access.');

/**
 * List controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_List extends Controller_Base { 
    
    public function action_index()
    {
        $model_name = $this->request->param('model');
        if($model_name != null)
        {
            $elements = Model_Base::factory($model_name);

            if($this->request->query('search') !== null)
            {
                $query = SessionHandler::get_search_query($model_name);
                foreach(array_keys($elements->list_columns()) as $column)
                {
                    $value = Arr::get($query, $column, '');
                    if($value != '')
                       $elements->and_where($column, '=', $value);
                }
            }
            else if(($object_id = $this->request->query('object')) != null)
            {
                $object = Model_Base::factory('object', $object_id);
                $model = $model_name . 's';
                $elements = $object->$model;
            }
            $this->set_content_view(new View_List_Generic($elements));
        }
        else // Index action
        {
            $this->set_content_view(new View_List_Index); 
        }
    }
    
//    public function action_object()
//    {
//        $objects = Model_Base::factory('object');
//
//        if($this->request->query('search') !== null)
//        {
//            $query = SessionHandler::get_search_query('object');
//            foreach(array_keys($objects->list_columns()) as $column)
//            {
//                $value = Arr::get($query, $column, '');
//                if($value != '')
//                   $objects->and_where($column, '=', $value);
//            }
//        }
//        $this->set_content_view(new View_List_Object($objects));
//    }
    
}
