<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kostache view class for the index
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Detail_Index extends View_List_Index {
    
    public function title()
    {
        return __('Search for:');
    }
}