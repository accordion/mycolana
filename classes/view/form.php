<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Displayes a Form
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Form extends View_Frame {
    
        public function generate_form($config)
        {
            $form = '';
            foreach($config as $element) 
            {              
                $cfg = $element['form'];
                $form .= $cfg['title'] . ': <' . $cfg['html_type'] . ' ';
                $form .= $this->_add_form_parameter($cfg, 'type');
                $form .= $this->_add_form_parameter($cfg, 'size');
                $form .= '></' . $cfg['html_type'] . "><br />\n";             
            }
            return $form;
        }
        
        private function _add_form_parameter($cfg, $parameter)
        {
            return isset($cfg[$parameter]) ? $parameter . '="' . $cfg[$parameter] . '" ' : '';
        }
}