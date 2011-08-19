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
        $id = $this->request->param('id');
        $object = Model_Base::factory('object', $id);
        $this->layout->content = new View_Form($object->get_form_config(), 
                $this->request->action(), $object);
        
//        echo Kohana_Debug::vars($object->get_tablecolumns_info());
//        echo '<br /><br />';
//        echo Kohana_Debug::vars($object->get_form_config());
    }
}