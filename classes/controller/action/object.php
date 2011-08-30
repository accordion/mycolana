<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Action handler for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Action_Object extends Controller_Action_Handler {
    
    public function handle_get() 
    {
        $this->default_handle_get(__('Object not found'));
    }

    public function handle_post() 
    {
        try
        {
            $this->model->values($_POST);
            $id = $this->model->save();
            $this->controller->request->redirect(URL::site(NULL, TRUE) . 'detail/object/' . $id);
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->layout->content = new View_Form($this->request->uri(), 
                    $this->model, $e);
        } 
    }

    public function handle_search() 
    {
         SessionHandler::set_search_query($_POST);
         $this->controller->request->redirect('list/object?search');
    }

}
