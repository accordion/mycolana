<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Delivers JSON encoded models
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Controller_JSON extends Controller {
    
    public function action_index()
    {
        $this->response->headers('content-type', 'application/json');
        
        $model_name = $this->request->param('model');
        $id = $this->request->param('id');
        $heading = null;
        $data = array();
        
        // generate heading
        if($this->request->query('withHeading') !== null)
        {
            $model = Model_Base::factory($model_name);
            $heading = array();
            foreach(array_keys($model->as_array()) as $column)
            {
                $heading[$column] = __($column);
            }
        }
        
        if($id !== null)
        {
            $model = Model_Base::factory($model_name, $id);
            $data[] = $model->as_array();
        }
        else 
        {
            $models = array();
            foreach(Model_Base::factory($model_name)->find_all() as $model)
            {
                $models[] = $model->as_array();
            }
            $data = $models;
        }
        $json = array();
        if(isset($heading)) $json['heading'] = $heading;
        $json['data'] = $data;
        echo json_encode($json);
    }
    
}
