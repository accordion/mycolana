<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Displays a Form
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Form extends Kostache {
    
    private $config;
    private $action;
    private $model;
    private $method;
    
    public function __construct($config, $action, $model, $method = 'post')
    {
        parent::__construct();
        $this->config = $config;
        $this->action = $action;
        $this->model = $model;
        $this->method = $method;
    }
    
    public function form()
    {
        return $this->_render_form();
    }
    
    private function _render_form()
    {
        $form = '';
        $form .= '<form action="' . $this->action . '" method="' . $this->method . '">';
        
        foreach($this->config as $column => $definitions)
        {
            $form .= $this->_create_input($column, $definitions);
        }
        
        $form .= '<input type="submit" value="Absenden" />';
        $form .= '<input type="reset" value="Formular löschen" />';
        $form .= '</form>';
        
        return $form;
    }
    
    private function _create_input($column, $definitions)
    {
        $input = '';
        switch($definitions['type'])
        {
            case 'hidden':
                $input .= '<input type="hidden" ';
                break;
            case 'textarea':
                $input .= $column . ': ';
                $input .= '<textarea ';
                break;
            default:
                $input .= $column . ': ';
                $input .= '<input type="text" ';
                break;
        }  
        
        $input .= 'name="' . $column . '" ';
        $input .= 'value="' . $this->model->$column . '" ';
        if(isset($definitions['maxlength'])) $input .= 'maxlength="' . $definitions['maxlength'] . '" ';
    
        switch($definitions['type'])
        {
            case 'textarea':
                $input .= '></textarea><br />';
                break;
            case 'hidden':
                $input .= '/>';
                break;
            default:
                $input .= '/><br />';
                break;
        }
        
        return $input . "\n";
    }
    
}