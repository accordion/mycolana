<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Handles the storage of messages
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class Messages {
    
    /**
     * Save a message
     * @param string $level info, notice, alert, error, success
     * @param string $message the message to be saved
     */
    public static function put($level, $message) {
        $session = Session::instance();
        $message = array('level' => $level, 'message' => $message);
        $messages = $session->get('messages');
        $messages[] = $message;
        $session->set('messages', $messages);
    }

    /**
     * Returns and removes all saved messages
     * @return array format: array of array('level' => $level, 'message' => $message)
     */
    public static function popAll() {
        $session = Session::instance();
        $messages = $session->get('messages');
        $session->delete('messages');
        return $messages;
    }
    
}


