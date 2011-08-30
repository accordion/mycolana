<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract base class for the action handlers
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class Controller_Action_Handler {
    
    protected $model;
    protected $id;
    protected $controller;
    
    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->id = $controller->request->param('id');
        $this->model = Model_Base::factory($controller->request->action(), $this->id);
    }
    
    public abstract function handle_get();
    public abstract function handle_post();
    public abstract function handle_search();
    
    protected function default_handle_get($error_view, $normal_view = null)
    {
        if($normal_view === null) 
        {
            $normal_view = new View_Form($this->controller->request->uri(), $this->model);
        }
        
        if(!$this->model->loaded() AND $this->id != null) 
        {
            $this->controller->set_view($error_view);
        }
        else
        {
            $this->controller->set_view($normal_view);
        }
    }
    
}
