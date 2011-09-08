<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Provides a single point to retrieve session information
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class SessionHandler {

    public static function set_search_query($model_name, $post)
    {
        $session = Session::instance();
        unset($post['search']);
        $queries = $session->get('search');
        $queries[$model_name] = $post;
        $session->set('search', $queries);
    }
    
    public static function get_search_query($model_name)
    {
        $session = Session::instance();
        $queries = $session->get('search');
        return isset($queries[$model_name]) ? $queries[$model_name] : array();
    }
}
