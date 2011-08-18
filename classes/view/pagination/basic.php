<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Abstract class for paginated kostache views
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
abstract class View_Pagination_Basic extends Kostache {

    protected $pagination;
    
    public function __construct()
    {
    	$this->_partials['pagination'] = 'pagination/basic';
    	$this->pagination = $this->_create_pagination();
    	parent::__construct();
    }
    
    abstract protected function _create_pagination();

    public final function pagination()
    {   
        $items = array();

        // First.
        $first['title'] = 'first';
        $first['name'] = __('first');
        $first['url'] = ($this->pagination->first_page !== FALSE) ? $this->pagination->url($this->pagination->first_page) : FALSE;
        $items[] = $first;

        // Prev.
        $prev['title'] = 'prev';
        $prev['name'] = __('previous');
        $prev['url'] = ($this->pagination->previous_page !== FALSE) ? $this->pagination->url($this->pagination->previous_page) : FALSE;
        $items[] = $prev;

        // Numbers.
        for ($i=1; $i<=$this->pagination->total_pages; $i++)
        {
            $item = array();

            $item['num'] = TRUE;
            $item['name'] = $i;
            $item['url'] = ($i != $this->pagination->current_page) ? $this->pagination->url($i) : FALSE;

            $items[] = $item;
        }

        // Next.
        $next['title'] = 'next';
        $next['name'] = __('next');
        $next['url'] = ($this->pagination->next_page !== FALSE) ? $this->pagination->url($this->pagination->next_page) : FALSE;
        $items[] = $next;

        // Last.
        $last['title'] = 'last';
        $last['name'] = __('last');
        $last['url'] = ($this->pagination->last_page !== FALSE) ? $this->pagination->url($this->pagination->last_page) : FALSE;
        $items[] = $last;

        return $items;
    }

}