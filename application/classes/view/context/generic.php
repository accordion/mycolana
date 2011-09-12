<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generic conetxt view
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Context_Generic extends View_Base {
    
    private $model;
    
    public function __construct($model)
    {
        $this->model = $model;
        parent::__construct();
    }
    
    public function overview_label()
    {
        return __('Overview');
    }
    
    /**
     * 
     * @return string the model on which this view is based on 
     */
    public function parent_model()
    {
        return $this->model->object_name();
    }
    
    public function tabs()
    {
        $tabs = array();
        foreach($this->model->has_many() as $name => $definition)
        {
            $model = $definition['model'];
            $tabs[] = array(
                'model' => $model,
                'label' => __(ucfirst(Inflector::plural($model))),
                'button_label_add' => __('Add ' . $model),
                'button_label_search' => __('Search ' . Inflector::plural($model)),
            );
        }
        return $tabs;
    }
    
}