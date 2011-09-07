<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Base { 
    
    public function action_index()
    {
        $this->redirect('auth/login');
    }
    
    public function action_logout()
    {
    	Auth::instance()->logout(true, true);
    	$this->set_content_view("you logged out");
    }
    
    public function action_login() 
    {
        $message = '';
        if (isset($_POST['login'])) 
        {
            $post = Validation::factory($_POST)
                    ->rule('username', 'not_empty')
                    ->rule('password', 'not_empty');
            if ($post->check()) 
            {
                $username = $post['username'];
                $password = arr::get($post, 'password', '');
                try 
                {
                    if (Auth::instance()->login($username, $password)) 
                    {
                        $message = 'Successful login.';
                    } 
                    else 
                    {
                        $message = 'Login failed.';
                    }
                } 
                catch (adLDAPException $e) 
                {
                    $message = $e->getMessage();
                }
            } 
            else 
            {
                $message = 'You must enter both your username and password.';
            }
            $this->set_content_view('<strong>' . $message . '</strong>');
        }
        else // GET
        {
            if(!Auth::instance()->logged_in())
            {
                $this->set_content_view(new View_Auth_Login());
            }
            else
            {
                $this->set_content_view('you are logged in as ' . Auth::instance()->get_user());
            }
        }
    	

    }
    
}