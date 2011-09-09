<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Conetxt view for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Context_Object extends View_Base {
    
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
    
    public function tabs()
    {
        return array(
            array(
                'model' => 'measure',
                'label' => __('Measurements'),
                'button_label_add' => __('Add measurement'),
                'button_label_search' => __('Search measurements'),
                'text' => 'Measure everything!',
            ),
            array(
                'model' => 'location',
                'label' => __('Locations'),
                'button_label_add' => __('Add location'),
                'button_label_search' => __('Search locations'),
                'text' => 'Locate everything!',
            ),
            array(
                'model' => 'person',
                'label' => __('People'),
                'button_label_add' => __('Add person'),
                'button_label_search' => __('Search people'),
                'text' => '',
            ),
        );
    }
    
}