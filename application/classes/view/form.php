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
     * The format of the result (html or json)
     * @var string
     */
    private $format;
    
    /**
     * Contains the through URI set foreign key values
     * @var array
     */
    private $preset_foreign_keys = array();
    
    /**
     * Contains the mapping of the foreign keys to their corresponding model 
     * (e.g. object_id => object)
     * @var array
     */
    private $foreign_keys = array();
    
    /**
     * Provides the default values for the options
     * @var array
     */
    private $default_options = array(
            'method' => 'post',
            'type' => 'all',
            'format' => 'html',
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
        $this->format = $options['format'];
        $this->parse_relations();
    }
    
    private function parse_relations()
    {
        $query = Request::current()->query();
        foreach(array_values($this->model->belongs_to()) as $relation)
        {
            // set foreign_keys to foreign_key => model
            $this->foreign_keys[$relation['foreign_key']] = $relation['model'];
            // set the preset foreign keys given by the query parameters
            if(isset($query[$relation['model']]))
            {
                $this->preset_foreign_keys[$relation['foreign_key']] = $query[$relation['model']];
            }
        }
    }
    
    public function form()
    {
        $form = array();
        $action = $this->action;
        if($this->format == 'json' && $this->type == 'search') $action .= '.json?withHeading';
        $form['open'] = Form::open($action, array(
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
                'error' => Form::label($column, $error),
                'div' => '<div class="inline_list" id="field_' . $column . '"></div>',
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
        $value = Arr::get($this->preset_foreign_keys, $column, $this->model->$column);
        if(isset($this->foreign_keys[$column]))
        {
            $options['id'] = $this->foreign_keys[$column];
        }
        switch($definitions['type'])
        {
            case 'textarea':
                return Form::textarea($column, $value, $options);  
            case 'hidden':
                $options['type'] = 'hidden';
                if(isset($definitions['maxlength'])) 
                    $options['maxlength'] = $definitions['maxlength'];
                return Form::input($column, $value, $options); 
            case 'checkbox':
                return Form::checkbox($column, 1, (bool)$value);
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
                return Form::input($column, $value, $options);
        }   
    }
    
    public function model()
    {
        return $this->model->object_name();
    }
    
    public function id()
    {
        return $this->model->id;
    }
    
}