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
            $this->controller->set_content_view($error_view);
        }
        else
        {
            $this->controller->set_content_view($normal_view);
        }
    }
    
    public function handle_save() 
    {
        try
        {
            $this->model->values($_POST);
            $id = $this->model->save();
            $action = '';
            if($_POST['id'] == null)
                $action = __('added');
            else
                $action = __('updated');
            $this->controller->set_content_view(__(ucfirst($this->model_name) 
                    . ' ' . $action));
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->set_content_view(new View_Form(
                    $this->controller->request->uri(), $this->model, $e));
        } 
    }
    
    public function handle_delete()
    {
        try
        {
            $this->model->delete();
            $this->controller->set_content_view(__(ucfirst($this->model_name) . ' deleted'));
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->set_content_view(new View_Form(
                    $this->controller->request->uri(), $this->model, $e));
        }
    }

    public function handle_search() 
    {
         SessionHandler::set_search_query($this->model_name, $_POST);
         $this->controller->request->redirect(URL::site(null, true) . 'list/' 
                 . $this->model_name . '?search');
    }

}
