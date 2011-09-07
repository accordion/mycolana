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
        $this->generic_action('measure');
    }
    
    public function action_location()
    {
        $this->generic_action('location');
    }
    
    public function action_person()
    {
        $this->generic_action('person');
    }
    
    public function action_building()
    {
        $this->generic_action('building');
    }
    
    private function generic_action($model_name)
    {
        $elements = Model_Base::factory($model_name);

        if($this->request->query('search') !== null)
        {
            $query = SessionHandler::get_search_query();
            foreach(array_keys($elements->list_columns()) as $column)
            {
                $value = Arr::get($query, $column, '');
                if($value != '')
                   $elements->and_where($column, '=', $value);
            }
        }
        if(($object_id = $this->request->query('object')) != null)
        {
            $elements->and_where('object_id', '=' ,$object_id);
        }
        $this->set_content_view(new View_List_Generic($elements));
    }
    
}
