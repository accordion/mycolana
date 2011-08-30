<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generates a form based on the database and the custom field options
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
        
        $spec = array_replace_recursive($this->model->get_config(), $this->model->fields());
        foreach($spec as $column => $definitions)
        {
            $form .= Form::label($column, __($column) . ': ');
            $form .= $this->_create_input($column, $definitions);
            $form .= "\n";
            $error = isset($this->errors[$column]) ? $this->errors[$column] : '';
            $form .= Form::label($column, $error);
            $form .= "<br />\n";
        }
        
        $form .= Form::button('submit', __('Save'), array('type' => 'submit'));        
        $form .= Form::button('search', __('Search'), array('type' => 'submit'));
        $form .= Form::button('reset', __('Reset'), array(
            'id' => 'reset',
            'onclick' => 'return false'
        ));
        
        $form .= Form::close();
        
        return $form;
    }
    
    private function _create_input($column, $definitions)
    {
        $options = Arr::get($definitions, 'options', null);
        switch($definitions['type'])
        {
            case 'textarea':
                return Form::textarea($column, $this->model->$column, $options);  
            case 'hidden':
                $options['type'] = 'hidden';
                if(isset($definitions['maxlength'])) 
                    $options['maxlength'] = $definitions['maxlength'];
                return Form::input($column, $this->model->$column, $options); 
            case 'checkbox':
                return Form::checkbox($column, 1, (bool)$this->model->$column);
            case 'select':
                $selected = Arr::get($definitions,'selected', null);
                return Form::select($column, $options, $selected);
            case 'date':
                $options['id'] = 'datepicker';
            default:
                if(isset($definitions['maxlength'])) 
                    $options['maxlength'] = $definitions['maxlength'];
                return Form::input($column, $this->model->$column, $options);
        }   
    }
    
}