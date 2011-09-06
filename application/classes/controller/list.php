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
        $this->layout->content = new View_List_Object($objects);
    }
    
}
