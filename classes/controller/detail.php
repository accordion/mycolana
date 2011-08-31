<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Detail controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Detail extends Controller_Base {
    
    public function before()
    {
        parent::before();

        // TODO: check if custom handler for the action exists, else use generic handler
        
        $handler = new Controller_Action_Generic($this);
        
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
                else
                {
                    $handler->handle_post();
                }     
                break;
            default:
                throw new HTTP_Exception_404;          
        }
    }
    
    public function action_index()
    {
//        Works with the following route from bootstrap.php:
//        
//        Route::set('detail', 'detail(/<model>(/<id>))')
//          ->defaults(array(
//              'controller' => 'detail',
//		'action'     => 'index',
//          ));
    }
        
}