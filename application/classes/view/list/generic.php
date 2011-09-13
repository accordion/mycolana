<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generic Kostache view class
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Generic extends View_Base {
    
    private $model;
    
    public function __construct($model) 
    {
        $this->model = $model;
        parent::__construct();
    }
    
    public function elements()
    {
        $elements = array();
        $through = null;
        foreach(array_values($this->model->has_many()) as $relation)
        {
            if(isset($relation['through']))
            {
                $through = $relation; 
                $through['through'] = Inflector::singular($through['through']);
                unset($through['model']);
            }
        }
        foreach($this->model->find_all() as $element) 
        {
            $html = '';
            $id = 0;
            foreach($element->as_array() as $column => $value) 
            {
                if($column == 'id') $id = $value;
                $html .= '<b>' . $column . ': </b>' . $value . ' ';
            }
            $element = array(
                'id' => $id,
                'element' => $html,
            );
            if(isset($through)) $element['through'] = $through;
            $elements[] = $element;
        }
        return $elements;
    }
    
    public function uri()
    {
        return $this->base_url() . 'detail/' . $this->model();
    }
    
    public function model()
    {
//        return Request::current()->param('model');
        return $this->model->object_name();
    }
    
}