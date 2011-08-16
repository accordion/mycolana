<?php defined('SYSPATH') or die('No direct script access.');
// ------------------------------------------------------------------------

/**
 * myColex detail Controller extends Performer
 *
 * @package		myColex
 * @subpackage	Controller
 * @category	Controller
 * @author		Stefan Buerer
 * @link		http://www.collector.ch
 */

// ------------------------------------------------------------------------

class Controller_Detail extends Controller_Form {

	public function __construct(Request $request, Response $response)
    {
        parent::__construct($request,  $response);
    }   

     public function before()
      {
         parent::before();
  		 
  	  }
	
 
   	 /*
	 Default controller behaviour, show empty form
	 */
	public function action_index()
	{
		
	}
	
	
	
	
	/* The after() method is called after your controller action. parent::after bottom */
    public function after()
      {
		parent::after();
      }

}
?>