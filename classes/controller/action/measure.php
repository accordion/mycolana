<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Action handler for measurements
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Action_Measure extends Controller_Action_Handler {
    
    public function handle_get() 
    {
        $this->default_handle_get(__('Measure not found'));
    }

    public function handle_post() 
    {
        try
        {
            $this->model->values($_POST);
            $id = $this->model->save();
            $msg = __('Measurement added');
            $this->controller->set_view($msg);
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->set_view(new View_Form($this->controller->request->uri(), $this->model, $e));
        } 
    }

    public function handle_search() 
    {
        $this->handle_get();    // no search
    }

}