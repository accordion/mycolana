<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generic Kostache view class
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Generic extends View_Base {
    
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
        parent::__construct();
    }
    
    public function elements()
    {
        $elements = array();
        foreach($this->model->find_all() as $element) 
        {
            $html = '';
            $id = 0;
            foreach($element->as_array() as $column => $value) 
            {
                if($column == 'id') $id = $value;
                $html .= '<b>' . $column . ': </b>' . $value . ' ';
            }
            $elements[] = array(
                'id' => $id,
                'element' => $html,
            );
        }
        return $elements;
    }
    
    public function uri()
    {
        return $this->base_url() . 'detail/' . $this->model();
    }
    
    public function model()
    {
        return Request::current()->action();
    }
    
}