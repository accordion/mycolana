<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Template { 
    public $template = 'html';
    
    public function action_index()
    {
    	$view = $this->template;
    	if (isset($_POST['login']))
		{
			$post = Validation::factory($_POST)
				->rule('username', 'not_empty')
				->rule('password', 'not_empty');
			if($post->check())
			{
				$username = $post['username'];
				$password = arr::get($post, 'password', '');
				try
				{
					if (Auth::instance()->login($username, $password))
					{
						$view->title = 'Successful login.';
					} else
					{
						$view->title = 'Login failed.';
					}
				} catch (adLDAPException $e)
				{
					$view->title = $e->getMessage();
				}
			} else
			{
				$view->title = 'You must enter both your username and password.';
			}
			$this->request->redirect('auth');
		}
    	
    	if(!Auth::instance()->logged_in())
    	{
    		$this->template->title = "please login to access this site";
    		$this->template->content = View::factory('auth/login');
    	}
    	else
    	{
    		$this->template->title = "you are logged in as "
    			. Auth::instance()->get_user()
    			. '		logout: <a href="http://localhost/auth/logout">logout</a>';
    		$this->template->content = '';
    	}
    	
    }
    
    public function action_logout()
    {
    	Auth::instance()->logout(true, true);
    	$this->template->title = "you logged out";
    	$this->template->content = '';
    }
    
}