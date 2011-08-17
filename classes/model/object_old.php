<?php defined('SYSPATH') or die('No direct script access.');
class Model_OldObject extends Model_Compose {
	public static $config = array(
		"module"=>array(
    		"class"=>0,
    		//classification of modules: 0: Main/parent 1: Dependent/ 1 foreign key 2: Dependent/2 foreign keys
    		"name"=>"object",
    		"prefix"=>"ob",
    		"table" =>"objects",
    		"key" => "id"
    	),
    	"fields"=>array(
    		"id"	=>	array("type"=>"input"),
    		"obinv"	=>	array("type"=>"input"),
    		"obobject"=>array("type"=>"input"),
    		"obremark"=>array("type"=>"input"),	
    		"building_id"	=>	array("type"=>"select", "sql"=>"SELECT id, bubuilding FROM buildings"),
    		"obshort"=>array("type"=>"select", "options"=>array(1=>"one",2=>"two")),
    		"obcheck"=>array("type"=>"checkbox"),
    		"obdate"=>array("type"=>"datepicker")
    	),
    	
    	"detail"=>array(
    		"function"	=>	array(
    			"displyfunc" => "testfunc",
    			"displaykohana"=> "displaykohana",
    			)
    	),
    	"context"=>array(
    		"measure"	=>	array(
    			// get the context data
    			"function"=>"get_measures",
    		),
    		"personrole"	=>	array(
    			"function"=>"get_people",
    		),
    		"location"	=>	array(
    			"function"=>"get_locations",
    			//"refreshfunction"=>"get_location_object",
    		) 
    	),
    	"list"=>array(
    		"col"	=>	array(
    			"obinv",
    			"obobject",
    			//"obremark"
    			),
    		"func"	=>	array(
    			"testfunc"
    			)
    	),
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
		$out.="-@@".$arr['obinv']."@@-";
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