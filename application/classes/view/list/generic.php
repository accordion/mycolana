<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generic Kostache view class
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Generic extends Kostache {
    
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
            foreach($element->as_array() as $column => $value) 
            {
                $html .= '<b>' . $column . ': </b>' . $value . ' ';
            }
            $elements[] = array('element' => $html);
        }
        return $elements;
    }
    
}