<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Detail controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Detail extends Controller_Base {
       
    public function action_index()
    {
        $model_name = $this->request->param('model');
        if($model_name != null)
        {
            $handler = null;
            $class = 'Controller_Action_' . ucfirst($model_name);
            if(class_exists($class)) {
                $handler = new $class($this);
            }
            else 
            {
                $handler = new Controller_Action_Generic($this);  
            }

            switch($this->request->method())
            {
                case HTTP_Request::GET:
                    $handler->handle_get();
                    break;
                case HTTP_Request::POST:
                    if($this->is_search())
                    {
                        $handler->handle_search();
                    } 
                    elseif($this->is_delete())
                    {
                        $handler->handle_delete();
                    }
                    else
                    {
                        $handler->handle_save();
                    }
                    break;
                default:
                    throw new HTTP_Exception_404;          
            }
        }
        else // index action
        {
           $this->set_content_view(new View_Detail_Index);
        }
    }
        
}