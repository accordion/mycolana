<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generic class to handle actions
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Action_Generic implements Controller_Action_Handler {
        
    protected $model;
    protected $model_name;
    protected $id;
    protected $controller;
    
    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->id = $controller->request->param('id');
        $this->model_name = $controller->request->param('model');
        $this->model = Model_Base::factory($this->model_name, $this->id);
    }
    
    public function handle_get()
    {
        $normal_view = new View_Form($this->controller->request->uri(), $this->model);
        $error_view = __(ucfirst($this->model_name)) . ' not found';
        if(!$this->model->loaded() AND $this->id != null) 
        {
            $this->controller->set_view($error_view);
        }
        else
        {
            $this->controller->set_view($normal_view);
        }
    }
    
    public function handle_post() 
    {
        try
        {
            $this->model->values($_POST);
            $id = $this->model->save();
            $this->controller->set_view(__(ucfirst($this->model_name) . ' added'));
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->set_view(new View_Form($this->controller->request->uri(), $this->model, $e));
        } 
    }

    public function handle_search() 
    {
         SessionHandler::set_search_query($_POST);
         $this->controller->request->redirect(URL::site(null, true) . 'list/' 
                 . $this->model_name . '?search');
    }

}
