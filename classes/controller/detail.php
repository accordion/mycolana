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
                if($this->is_search())
                {
                    $this->object_search();
                }
                else
                {
                    $this->object_post();
                }     
                break;
            default:
                throw new HTTP_Exception_404();          
        }
    }
    
    private function object_get()
    {
        $id = $this->request->param('id');
        $object = Model_Base::factory('object', $id);
        
        if(!$object->loaded() AND $id != null) 
        {
            $this->layout->content = __('Object not found');
        }
        else
        {
            $this->layout->content = new View_Form($this->request->uri(), $object);
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
            $this->layout->content = new View_Form($this->request->uri(), 
                    $object, $e);
        }  
    }
    
    private function object_search()
    {
         $this->layout->content = Kohana_Debug::vars($_POST);
         SessionHandler::set_search_query($_POST);
         $this->request->redirect('list/object?search');
    }
    
    public function action_measure()
    {
        switch($this->request->method())
        {
            case HTTP_Request::GET:
                $this->measure_get();
                break;
            case HTTP_Request::POST:
                $this->measure_post();
                break;
            default:
                throw new HTTP_Exception_404();          
        }       
    }
    
    private function measure_get()
    {
        $id = $this->request->param('id');
        $measure = Model_Base::factory('measure', $id);
        
        if(!$measure->loaded() AND $id != null) 
        {
            $error_msg = __('Measure not found');
            $this->set_view($error_msg);      
        }
        else
        {
            $this->set_view(new View_Form($this->request->uri(), $measure));
        }
    }
    
    /**
     * Sets the view depending on whether the request came from an AJAX reqeust.
     * @param  $view 
     */
    private function set_view($view)
    {
        if($this->request->is_ajax()) 
        {
            $this->layout = $view;
        }
        else 
        {
            $this->layout->content = $view;
        }
    }
    
    private function measure_post()
    {
        try
        {
            $id = $this->request->param('id');
            $measure = Model_Base::factory('measure', $id);
            $measure->values($_POST);
            $id = $measure->save();
            $msg = __('Measurement added');
            $this->set_view($msg);
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->set_view(new View_Form($this->request->uri(), $measure, $e));
        } 
    }
        
}