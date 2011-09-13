<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Base controller
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class Controller_Base extends Controller { 
    
    /**
     * Layout of the site
     * 
     * @var View_Layout_Main 
     */
    public $layout;
    
    public function before()
    {
        parent::before();
       
        $this->layout = new View_Layout_Main;
        $this->layout->header = Kostache::factory('layout/header');
        $this->layout->footer = Kostache::factory('layout/footer');
    }
    
    public function after()
    {
        echo $this->layout;
        parent::after();
    }
    
    protected function is_search()
    {
        return isset($_POST['search']);
    }
    
    protected function is_delete()
    {
        return isset($_POST['delete']);
    }
    
    /**
     * Sets the content view depending on whether the request came from an AJAX reqeust.
     * @param  $view 
     */
    public function set_content_view($view)
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
    
    /**
     * Sets the context view depending on whether the request came from an AJAX reqeust.
     * @param  $view 
     */
    public function set_context_view($view) 
    {
        // only set context if it's not an AJAX request
        if(!$this->request->is_ajax())
        {
            $this->layout->context = $view;
        }
    }
    
    protected function redirect($relative_path)
    {
        $this->request->redirect(URL::site(null, true) . $relative_path);
    }
}
