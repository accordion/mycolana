<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generates a form based on the database and the custom field options
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Form extends View_Base {
    
    /**
     * Determines the action of the form
     * @var string 
     */
    private $action;
    
    /**
     * The model associated with this form
     * @var Model_Base 
     */
    private $model;
    
    /**
     * Potential exception caught in the controller and given to this form 
     * (like ORM_Validation_Exception)
     * @var Exception 
     */
    private $errors;
    
    /**
     * Determines the method of the form
     * @var string
     */
    private $method;
    
    /**
     * The type of the form, either search (only search button) or save (only save button)
     * @var type 
     */
    private $type;
    
    /**
     * Provides the default values for the options
     * @var array
     */
    private $default_options = array(
            'method' => 'post',
            'type' => 'all'
        );
    
    /**
     *
     * @param string $action action of the form
     * @param Base_Model $model model accosiated with this form
     * @param ORM_Validation_Exception $exception  exception caught by the controller
     * @param array $options array with 'method'=> 'post' or 'get', 'type' => 'all', 'save' or 'create'
     */
    public function __construct($action, $model, $exception = null, $options = array())
    {
        parent::__construct();
        $this->action = $action;
        $this->model = $model;
        if($exception != null)
        {
            $this->errors = $exception->errors('models');   
        }
        $options = array_replace($this->default_options, $options);
        $this->method = $options['method'];
        $this->type = $options['type'];
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
         $closing = array();
        if($this->type == 'all' OR $this->type == 'save')
        {
            $closing[] = array('element' => Form::button('submit', __('Save'), 
                    array('type' => 'submit')));
        }
        if($this->type == 'all' OR $this->type == 'search')
        {
            $closing[] = array('element' => Form::button('search', __('Search'), 
                    array('type' => 'submit')));
        }
        $closing[] = array('element' => Form::close());
        $form['close'] = $closing;
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
                if($column === 'id' AND ($this->type == 'save' OR $this->type == 'all')) 
                    $options['readonly'] = 'true';
                return Form::input($column, $this->model->$column, $options);
        }   
    }
    
}