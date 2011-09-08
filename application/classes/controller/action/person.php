<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Custom person handler class
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Action_Person extends Controller_Action_Generic {
        
    public function handle_save()
    {
        try
        {
            $person = Model_Base::factory('person');
            $person->values($_POST);
            $person->save();
        
            // save the relation between person and object
            if(($object_id = $_POST['object_id']) != null)
            {
                $object = Model_Base::factory('object', $object_id);
                $person->add('objects', $object);
            }
            
            $this->controller->set_content_view(__(ucfirst($this->model_name) . ' added'));
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->set_content_view(new View_Form(
                $this->controller->request->uri(), $this->model, $e));
        }
    }

}