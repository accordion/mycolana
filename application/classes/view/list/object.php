<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for objects
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_List_Object extends View_Pagination_Basic
{
    public $title = 'Objects:';
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
        parent::__construct();
    }
    
    protected function _create_pagination() 
    {
    	return new ORMPagination(array('orm_model' => $this->model));    
    }
    
    public function objects()
    {
        $objects = array();
        foreach ($this->pagination->query() as $object)
        {
            $o = $object->as_array();
            $o['uri'] = URL::site(NULL, TRUE) . 'detail/object/' . $object->id;
            $o['form_open'] = Form::open(URL::site(null, true) . 'detail/object/' . $object->id);
            $o['delete'] = Form::input('delete', 'delete',  array('type' => 'submit'));
            $o['form_close'] = Form::close();
            
            $measures = array();
            foreach ($object->measures->find_all() as $measure)
            {
                $m = $measure->as_array();
                $m['form_open'] = Form::open(URL::site(null, true) . 'detail/measure/' . $measure->id);
                $m['delete'] = Form::input('delete', 'delete',  array('type' => 'submit'));
                $m['form_close'] = Form::close();
                $measures[] = $m;
            }            
            $o['measures'] = $measures;
            
            $persons = array();
            foreach ($object->persons->find_all() as $person)
            {
                $m = $person->as_array();
                $m['form_open'] = Form::open(URL::site(null, true) . 'detail/person/' . $person->id);
                $m['delete'] = Form::input('delete', 'delete',  array('type' => 'submit'));
                $m['form_close'] = Form::close();
                $persons[] = $m;
            }            
            $o['persons'] = $persons;
            
            
            $objects[] = $o;
        }
        return $objects;
    }

    
}