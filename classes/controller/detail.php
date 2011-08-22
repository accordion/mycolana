<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Detail controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Detail extends Controller_Base { 
    
    public function action_index()
    {
        $this->layout->content = "<h2>Index action</h2>";
    }
    
    public function action_object()
    {
        switch($this->request->method())
        {
            case HTTP_Request::GET:
                $this->object_get();
                break;
            case HTTP_Request::POST:
                $this->object_post();
                break;
            default:
                throw new HTTP_Exception_404('Method not allowed');          
        }
    }
    
    private function object_get()
    {
        $id = $this->request->param('id');
        $object = Model_Base::factory('object', $id);
        
        if(!$object->loaded() AND $id != null) 
        {
            $this->layout->content = 'object not found';
        }
        else
        {
            $this->layout->content = new View_Form($object->get_config(), 
                $this->request->uri(), $object);
        }
    }
    
    private function object_post()
    {
        try
        {
            $id = $this->request->param('id');
            $object = Model_Base::factory('object', $id);
            $object->values($_POST);
            $id = $object->save();
            $this->request->redirect('detail/object/' . $id);
        }
        catch(ORM_Validation_Exception $e)
        {
            echo 'Errors encountered: <br />';
            print_r($e->errors());
        }  
    }
    
    public function action_measure()
    {
        $id = $this->request->param('id');
        $measurement = Model_Base::factory('measure', $id);
        
        if(!$measurement->loaded() AND $id != null) 
        {
            $this->layout->content = 'measurement not found';
        }
        else
        {
//            $this->layout->content = new View_Form($measurement->get_form_config(), 
//                $this->request->action(), $measurement);
            
            // bare layout
            $this->layout = new View_Form($measurement->get_config(), 
                $this->request->uri(), $measurement);
        }
        
        
    }
        
}