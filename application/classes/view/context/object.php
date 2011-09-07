<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Conetxt view for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Context_Object extends Kostache {
    
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
    
    public function base_url()
    {
        return URL::site(null, true);
    }
    
    public function tabs()
    {
        return array(
//            array(
//                'id' => 'building',
//                'label' => __('Building'),
//                'text' => 'Buildings are great!',
//            ),
            array(
                'id' => 'measure',
                'label' => __('Measurements'),
                'text' => 'Measure everything!',
            ),
            array(
                'id' => 'location',
                'label' => __('Locations'),
                'text' => 'Locate everything!',
            ),
        );
    }
    
}