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
        $model = null;
        
        switch($this->request->method())
        {
            case HTTP_Request::GET:
                $model = Model_Base::factory($model_name, $id);            
                break;
            case HTTP_Request::POST:
                if($this->is_search())
                {
                    $model = $this->handle_search($model_name);
                }
                break;
            default:
                throw new HTTP_Exception_400;
        }      
        
        $this->return_json($model);
    }
    
    private function is_search() 
    {
        return isset($_POST['search']);
    }
    
    private function handle_search($model_name)
    {
        Kohana_Log::instance()->add(Kohana_Log::WARNING, 'is search');
        
        $model = Model_Base::factory($model_name);
        foreach(array_keys($model->list_columns()) as $column)
        {
            $value = Arr::get($_POST, $column, '');
            if($value != '')
               $model->and_where($column, '=', $value);
        }
        return $model;
    }
    
    private function return_json($model) {
        $heading = null;
        $data = array();
        
        // generate heading
        if($this->request->query('withHeading') !== null)
        {           
            $heading = array();
            foreach(array_keys($model->as_array()) as $column)
            {
                $heading[$column] = __($column);
            }
        }
        
        if($model->loaded())
        {
            $data[] = $model->as_array();
        }
        else 
        {
            $models = array();
            foreach($model->find_all() as $model)
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
