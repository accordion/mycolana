<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for measurements
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Measure extends Kostache {
    
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
        parent::__construct();
    }
    
    public function measures()
    {
        $measures = array();
        foreach($this->model->find_all() as $measure) 
        {
            $measures[] = $measure->as_array();
        }
        return $measures;
    }
    
}