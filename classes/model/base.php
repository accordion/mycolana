<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract base class for all the models
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class Model_Base extends ORM {
    
    public function get_tablecolumns_info()
    {
        $db = Database::instance();
        return $db->list_columns($this->_table_name);
    }
    
    public function get_config()
    {
        $columns = $this->get_tablecolumns_info();
        $config = array();
        foreach($columns as $column => $definitions)
        {
            $column_cfg = array();
            foreach($definitions as $definition => $value)
            {
                switch($definition)
                {
                    case 'column_name':
                    case 'is_nullable':
                        $column_cfg[$definition] = $value;
                        break;
                    case 'display':
                    case 'character_maximum_length':
                        $column_cfg['maxlength'] = $value;
                        break;
                    
                    // Form input type
                    case 'data_type':
                        if($value == 'date') 
                        {
                            $column_cfg['type'] = 'date';
                        }
                        elseif($value == 'tinyint') {
                            $column_cfg['type'] = 'checkbox';
                        }
                        elseif($value == 'int' AND 
                                strstr($columns[$column]['column_name'], '_id')) 
                        {
                            $column_cfg['type'] = 'hidden';
                        }
                        break;
                    case 'type':
                        if($value == 'string' AND 
                                !($columns[$column]['data_type'] == 'date') AND
                                (int)$columns[$column]['character_maximum_length'] > 100)
                        {
                            $column_cfg['type'] = 'textarea';
                        }
                        elseif($value == 'int' OR $value == 'string')
                        {
                            $column_cfg['type'] = 'text';
                        }
                        break;
                }
                $config[$column] = $column_cfg;
            }
        }
        return $config;
    }
    
    public function rules()
    {
        $config = $this->get_config();
        $rules = array();
        foreach($config as $field => $definitions)
        {
            if($field != 'id')
            {
                $rule = array();
                foreach($definitions as $key => $value)
                {
                    switch($key)
                    {
                        case 'is_nullable':
                            if(!$value) $rule[] = array('not_empty');
                            break;
                        case 'maxlength':
                            $rule[] = array('max_length', array(':value', $value));
                            break;
                    }
                }
                $rules[$field] = $rule;
            }
        }
        return $rules;              
    }
    
    /**
     * Defines custom field definitions for the form
     * @return array with field definition to overwrite the generated ones
     */
    public function fields()
    {
        return array();
    }
    
}

