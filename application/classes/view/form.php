<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generates a form based on the database and the custom field options
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Form extends View_Base {
    
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
        $form = array();
        $form['open'] = Form::open($this->action, array(
            'method' => $this->method,
            'id' => 'form_' . Request::current()->param('model')
        ));
        
        // Elements
        $elements = array();
        $spec = array_replace_recursive($this->model->get_config(), $this->model->fields());
        foreach($spec as $column => $definitions)
        {
            $error = isset($this->errors[$column]) ? $this->errors[$column] : '';
            $elements[] = array(
                'label' =>  Form::label($column, __($column) . ': '),
                'input' => $this->_create_input($column, $definitions),
                'error' => Form::label($column, $error)
            );
        }
        $form['elements'] = $elements;
        
        // Closing
        $form['close'] = array(
            array('element' => Form::button('submit', __('Save'), array('type' => 'submit'))),
            array('element' => Form::button('search', __('Search'), array('type' => 'submit'))),
            array('element' => Form::close())
        );       
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
                if($column === 'id') 
                    $options['readonly'] = 'true';
                return Form::input($column, $this->model->$column, $options);
        }   
    }
    
}