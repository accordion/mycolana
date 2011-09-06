<?php defined('SYSPATH') or die('No direct script access.');
class Model_Person extends Model_Composer {
	public $config = array(
			
    );
	protected $_rules = array
	(
		
	);
	protected $_callbacks = array
	(
	);
	public function __construct()
    {
    	// load database library into $this->db (can be omitted if not required)
           parent::__construct();
          
    }

	/** ********************************
	 * detailformat
	 *
	 * @param   array
	 * @return  formatted output string
	 */
	public function detailformat($arr)
	{
		$out="";
		$out.="@".$arr['name']."#";
		return $out;
	}
 	
	/*
	-------------CONTEXT------------------
    Functions for building cotext from controller
    */
    

	

/**
 * 
 */

	
}
?>