<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for the index
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Index extends Kostache {
    
    public function links()
    {
        return array(
            array(
                'label' => __('Buildings'),
                'model' => 'building',
            ),
            array(
                'label' => __('Locations'),
                'model' => 'location',
            ),
            array(
                'label' => __('Measurements'),
                'model' => 'measure',
            ),
            array(
                'label' => __('Objects'),
                'model' => 'object',
            ),
            array(
                'label' => __('People'),
                'model' => 'person',
            ),
        );
    }
    
    public function base_url()
    {
        return URL::site(null, true);
    }
}