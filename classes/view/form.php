<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Displays a Form
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Form extends Kostache {
    
    private $config;
    private $action;
    private $model;
    private $method;
    
    public function __construct($config, $action, $model, $method = 'post')
    {
        parent::__construct();
        $this->config = $config;
        $this->action = $action;
        $this->model = $model;
        $this->method = $method;
    }
    
    public function form()
    {
        return $this->_render_form();
    }
    
    private function _render_form()
    {      
        $form = Form::open($this->action, array(
            'method' => $this->method,
            'id' => 'form_' . Request::current()->action()
        ));
        
        foreach($this->config as $column => $definitions)
        {
            $form .= $this->_create_input($column, $definitions);
        }
        
        $form .= Form::button('submit', 'Speichern', array('type' => 'submit'));        
        $form .= Form::button('search', 'Suchen', array('type' => 'submit'));
        $form .= Form::button('reset', 'Leeren', array(
            'id' => 'reset',
            'onclick' => 'return false'
            ));
        $form .= Form::close();
        
        return $form;
    }
    
    private function _create_input($column, $definitions)
    {
        $attributes = array();
        switch($definitions['type'])
        {
            case 'textarea':
                return $column . ': ' . Form::textarea($column, 
                        $this->model->$column) . "<br />\n";  
            case 'hidden':
                $attributes['type'] = 'hidden';
                if(isset($definitions['maxlength'])) 
                    $attributes['maxlength'] = $definitions['maxlength'];
                return Form::input($column, $this->model->$column, $attributes) . "\n"; 
            case 'date':
                $attributes['id'] = 'datepicker';
            default:
                if(isset($definitions['maxlength'])) 
                    $attributes['maxlength'] = $definitions['maxlength'];
                return $column . ': ' . Form::input($column, $this->model->$column, 
                        $attributes) . "<br />\n";
        }   
    }
    
}