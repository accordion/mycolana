<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Provides a single point to retrieve session information
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class SessionHandler {

    public static function set_search_query($post)
    {
        $session = Session::instance();
        unset($post['search']);
        $session->set('search', $post);
    }
    
    public static function get_search_query()
    {
        $session = Session::instance();
        return $session->get('search');
    }
}
