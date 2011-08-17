<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract base class for all the models
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class Model_Base extends ORM {
    
//    public abstract function _load_config();
    
    public function rules__()
    {
        $rules = array();
//        $config = $this->_load_config();
        $config = Kohana::$config->load('object');
        foreach($config as $field => $values)
        {
            $validators = $values['validation'];
            $fieldrules = $rules[$field] = array();
            foreach($validators as $rule => $value)
            {
                $fieldrules[] = $this->_add_rule($rule, $value);
            }           
        }
        return $rules;
        
    }
    
    private function _add_rule($rule, $value)
    {
        switch($rule)
        {
            case 'not_empty':
                if($value) return array('not_empty');
                break;
            case 'max_length':
                return array('max_length', array(':value', $value));
            case 'min_length':
                return array('min_length', array(':value', $value));

        }
    }
    
    public static function get_config($model_name)
    {
        $db = Database::instance();
        return $db->list_columns($model_name);
    }
}

