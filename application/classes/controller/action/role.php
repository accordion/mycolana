<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Custom role handler class
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_Action_Role extends Controller_Action_Generic {
    
    public function handle_save()
    {
        try
        {
            $role = Model_Base::factory('role');
            $values = $_POST;
            // save the relation between role and object
            if(($object_id = $this->controller->request->query('object')) != null)
            {
                $values['object_id'] = $object_id;
            }
            // save the relation between role and person
            if(($person_id = $this->controller->request->query('person')) != null)
            {
                $values['person_id'] = $person_id;
            }
            
            $role->values($values);
            $role->save();
            
            $this->controller->set_content_view(__(ucfirst($this->model_name) . ' saved'));
        }
        catch(ORM_Validation_Exception $e)
        {
            $this->controller->set_content_view(new View_Form(
                $this->controller->request->uri(), $this->model, $e));
        }
    }
    
}