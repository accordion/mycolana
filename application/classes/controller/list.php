<?php defined('SYSPATH') or die('No direct script access.');

/**
 * List controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_List extends Controller_Base { 
    
    public function action_index()
    {
        $this->layout->content = "Hallo";
    }
    
    public function action_object()
    {
        $objects = Model_Base::factory('object');

        if($this->request->query('search') !== null)
        {
            $query = SessionHandler::get_search_query();
            foreach(array_keys($objects->list_columns()) as $column)
            {
                $value = Arr::get($query, $column, '');
                if($value != '')
                   $objects->and_where($column, '=', $value);
            }
        }
        $this->set_content_view(new View_List_Object($objects));
    }
    
    public function action_measure()
    {
        $measures = Model_Base::factory('measure');

        if($this->request->query('search') !== null)
        {
            $query = SessionHandler::get_search_query();
            foreach(array_keys($measures->list_columns()) as $column)
            {
                $value = Arr::get($query, $column, '');
                if($value != '')
                   $measures->and_where($column, '=', $value);
            }
        }
        if(($object_id = $this->request->query('object')) != null)
        {
            $measures->and_where('object_id', '=' ,$object_id);
        }
        $this->set_content_view(new View_List_Measure($measures));
    }
    
    public function action_location()
    {
        $locations = Model_Base::factory('location');

        if($this->request->query('search') !== null)
        {
            $query = SessionHandler::get_search_query();
            foreach(array_keys($locations->list_columns()) as $column)
            {
                $value = Arr::get($query, $column, '');
                if($value != '')
                   $locations->and_where($column, '=', $value);
            }
        }
        if(($object_id = $this->request->query('object')) != null)
        {
            $locations->and_where('object_id', '=' ,$object_id);
        }
        $this->set_content_view(new View_List_Location($locations));
    }
    
}
