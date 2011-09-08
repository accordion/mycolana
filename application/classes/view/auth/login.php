<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Login
 *
 * @author Stefan Florian Röthlisberger <sfroeth@gmail.com>
 */
class View_Auth_Login extends View_Base {
    
    public function title()
    {
        return __('Please login to access this site');
    }
        
    public function form() 
    {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $form = array(
            'form_open' => Form::open(URL::site(null, true) . 'auth/login'),
            'username_label' => __('Username: '),
            'password_label' => __('Password: '),
            'username_input' => Form::input('username', $username),
            'password_input' => Form::input('password', $password,  array('type' => 'password')),
            'login' => Form::button('login', __('Login'), array('type' => 'submit')),
            'form_close' => Form::close(),
        );
        return $form;
    }
}