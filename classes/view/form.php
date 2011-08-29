<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Displays a Form
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Form extends Kostache {
    
    private $action;
    private $model;
    private $errors;
    private $method;
    
    /**
     *
     * @param string $action
     * @param Base_Model $model
     * @param ORM_Validation_Exception $exception 
     * @param string $method post or get
     */
    public function __construct($action, $model, $exception = null, $method = 'post')
    {
        parent::__construct();
        $this->action = $action;
        $this->model = $model;
        if($exception != null)
        {
            $this->errors = $exception->errors('models');   
        }
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
        
        $form .= "\n";
        
        foreach($this->model->get_config() as $column => $definitions)
        {
            $form .= $this->_create_input($column, $definitions);
            $form .= "\n";
            $error = isset($this->errors[$column]) ? $this->errors[$column] : '';
            $form .= Form::label($column, $error);
            $form .= "<br />\n";
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
                        $this->model->$column);  
            case 'hidden':
                $attributes['type'] = 'hidden';
                if(isset($definitions['maxlength'])) 
                    $attributes['maxlength'] = $definitions['maxlength'];
                return Form::input($column, $this->model->$column, $attributes); 
            case 'date':
                $attributes['id'] = 'datepicker';
            default:
                if(isset($definitions['maxlength'])) 
                    $attributes['maxlength'] = $definitions['maxlength'];
                return $column . ': ' . Form::input($column, $this->model->$column, 
                        $attributes);
        }   
    }
    
}