<?php defined('SYSPATH') or die('No direct script access.');
class Model_Compose extends Kohana_Model {
var $session; //the session object
var $db; // default database
var $metadata; // metadata of the table
var $modulename;
var $action; // name of the action, set from controller	


	public function __construct()
    {
		//parent::__construct();
		/*----------- Initialization ----------------*/
		i18n::lang('en');
		/*----------- Session Management -------------*/
		$this->session = Session::instance('database');
		$this->session->set('user_id', 10);
		$_SESSION =& $this->session->as_array();
		$this->db = Database::instance();
		$this->modulename=static::$config["module"]["name"];
		$this->set_metadata(static::$config["module"]["table"]);
    }
 	/**
	 * set_action
	 * stores action in controller and model class variable
	 * 
	 * @param   action from controller
	 * @return  void
	 */    
	public function set_action($action)
	{
		$this->action=$action;
	}  
    /**
	 * get_config
	 * returns module configuration for classes $obj->get_config()
	 * 
	 * @param   tablename
	 * @return  array
	 */
	public function get_config()
	{
		return static::$config;
	}
    
    /**
	 * set_metadata
	 * fills the array this-metadata with the metadata of this-table
	 * 
	 * @param   tablename
	 * @return  array
	 */
	public function set_metadata($table)
	{
		$this->metadata=$this->db->list_columns($table);
	}
 	/**
	 * get_metadata
	 * returns metadata or fills the array this-metadata with the metadata of this-table
	 * 
	 * @param   tablename optional
	 * @return  this->metadata
	 */
	public function get_metadata($table = null)
	{
		// data from another table is asked for
		if (!is_null($table))
		{
			return $this->metadata=$this->db->list_columns($table);
		}
		else
		{
			return $this->metadata;	
		}
	}
	
	 /**
	 * set_msg
	 * sets messages for the whole module in SESSION: eg from list to detail, system error
	 * 
	 * @param   custom message
	 * @return  void
	 */
	public function set_msg($msg)
	{
		$_SESSION["module"][$this->modulename]["message"]=$msg;
	}
	/**
	 * get_msg
	 * gets messages for the whole module from SESSION
	 * 
	 * @param   custom message, read one time
	 * @return  string msg
	 */
	public function get_msg()
	{
		if (isset($_SESSION["module"][$this->modulename]["message"]))
		{
			$msg=$_SESSION["module"][$this->modulename]["message"];
			unset($_SESSION["module"][$this->modulename]["message"]);
		}else{
			$msg="msg";
		}
		return $msg;
	}
	
	
	/*********************
	 * Action Management *
	 *********************/
	
	
	/**
	 * shows empty detailmask 
	 *
	 * @param   msg lbl overrides standard message if unsucsessfull search
	 * @return  userform
	 */
	public function form_empty($post=null)
	{
		return $this->get_form(Null,"submit",Null);;
	}	
	
	/**
	 * detail data display
	 * 
	 * @param   integer  id
	 * @return  userform
	 */
	public function form_detail($id)
	{
		$dbdetaildata=$this->db_selectid($id);
		return $this->get_form($dbdetaildata,Null,Null);
	}

	/**
	 * produces a form using  
	 *
	 * @param   binddata array with data or false
	 * @param   formaction or null
	 * @param   validate array of validate errors or null
	 * @return  array $outform[form]
	 */
	function get_form($data=Null, $action=Null, $error=null)
	{	
		// ---- id --------
		if (isset($data[static::$config["module"]["key"]]))
		{
			$id=$data[static::$config["module"]["key"]];
			
		}else{
			$id=null;
		}
		$form=array();
		$form["menuitems"]=$this->menu_form($id);
		$form["label"]=	$this->get_detaillabel($data);
		$form["title"]= __("general.module"). " " . $this->modulename; 
		$form["module"]= $this->modulename; 
		$form["form_id"]="form_".$this->modulename;
		$form["action"]=$this->action;
		$form["message"]=	$this->get_msg();
		foreach (static::$config["fields"] as $key => $properties) 
		{
			//----databinding----
			if (is_array($data)){
				//-----checkbox-----
				// if key missing (checkbox) data is null
				if (isset($data[$key]))
				{
					$value=$data[$key];
				}else{
					$value=null;
				}
			}else{
				// no databinding
				$value=null;
			}
			
			$out[$key]["type"]=$properties["type"];
			$out[$key]["value"]=$value;
			$out[$key]["label"]=__($this->modulename.'.'.$key.".label");
			$out[$key]["hint"]=__($this->modulename.'.'.$key.".hint");
			$out[$key]["data_type"]=$this->metadata[$key]["data_type"];
			if (isset($this->metadata[$key]["character_maximum_length"]))
			{
				$out[$key]["len"]=$this->metadata[$key]["character_maximum_length"];
			}
			// get Select Options
			if ($properties["type"]=="select")
			{
				$startoption=array(0 => __('detail.noselection'));
				if (isset($properties["options"]))
				{
					$options=array_merge($startoption,__($this->modulename.'.'.$key.".options"));
					$out[$key]["options"]=$options;
				}
				elseif(isset($properties["sql"]))
				{
					//it must be a sql statement
					$sql=$properties["sql"];
					$options=$this->db_select_options($sql);
					if (is_array($options)){
						$options=array_merge($startoption,$options);
					}
					$out[$key]["options"]=$options;
				}
				else //misconfigured
				{
					$properties["type"]="input";
				}
			}
		}			
		$form["fields"]=$out;
		return $form;
	}
	
	/**
	 * Formmanipulation Menu: Insert, Update, Delete. Search, Print, etc		
	 * has to be inside form tags
	 * @param   void
	 * @return  array with menuitems and labels
	 */
	function menu_form($id=null)
	{
		//Menu-logic comes here
		/*
		if ($this->config["module"]["class"]=="parent")
		{		}else{ //class is child		}
		*/
		$menu=array();
		//$menu[0]=$this->action;
		//----------Menue Detailform-----------
		/*$menu["all"]="all";
		$menu["list"]="list"();
		$menu["empty"]="empty";
		$menu["search"]="search";
		$menu["insert"]="insert";
		$menu["update"]="update";
		$menu["delete"]=$this->menu_delete();
		$menu["coninsert"]="coninsert";
		$menu["conupdate"]="conupdate";
		$menu["condelete"]=$this->menu_condelete();
		$menu[2]="toggle";
		*/
		
		//if already called post the data
		switch ($this->action) {
			case "empty":
			case "context":
			case "delete":
				$menu[2]="search";
			case "insert":
			case "submit":		
				$menu[1]="empty";
				$menu[3]="insert";
				$menu[4]="list";
				$menu[5]="all";
				break;
			case "search":
				//nothing found
				$menu[1]="empty";
				$menu[2]="search";
				$menu[4]="list";
				$menu[5]="all";
				break;
			case "insert":
			case "detail":
			case "show":
			case "update":	
				$menu[1]="empty";
				$menu[2]="update";
				$menu[3]="delete";
				$menu[4]="list";		
				$menu[5]="all";
				break;
			case "assign":
				$menu[3]="insert";
				break;
			case "connew":
			case "coninsert":
				$menu[1]="coninsert";
				$menu[2]="toggle";
				break;
			case "condelete":
			case "condetail":
			case "conupdate":	
				$menu[1]="conupdate";
				$menu[2]="condelete";
				$menu[3]="toggle";
				break;		
		}
		// List link
		
		ksort($menu);
		
		return ($menu);
	}

	/*----------- DB functions -------------*/
	
	/**
	 * Get detail data of a row, given  id
	 * @param integer id
	 * @return the result array
	 */
    public function db_selectid($id)
	{
		
		try 
		{
			$result =DB::select('*')->from(static::$config["module"]["table"])
			->where('id', "=", $id)
			->execute()
			->as_array();
			$count = count($result);
			$result["count"]=$count;
			$dbdata=$this->specialdata_from_db($result[0]);
			return $dbdata;
		}
		catch ( Database_Exception $e )
		{
		  	echo $e->getMessage();
		}
		
	}
	/**
	 * Get select options from sql statement
	 * @param integer the user_id
	 * @return the result array
	 */
	public function db_select_options($sql)
	{
		try
		{
			$result=DB::query(Database::SELECT, $sql)->execute()->as_array();
			$options = array(); 
			foreach ($result as $key=>$optarr) 
			{ 
				foreach ($optarr as $k=>$v) 
				{
					$option="";
					if ($k=="id"){
						$id=$v;
					}else{
						$option.=$v;
					}
				}
				$options[$id]=$option;
			} 
			return $options; 
		}
		catch ( Database_Exception $e )
		{
		      echo $e->getMessage();
		}
	}
	
	
	
	/*----------- helper functions -------------*/
	
	/**
	 * treat special fieldtypes checkbox, date
	 * @param array posted data.
	 * @return reformatted Postdata
	 */
	public function specialdata_from_db($dbdata)
	{
	//format date from  mysql
	foreach ($this->metadata as $field => $meta)
	{
		if (isset($meta["format"]))
			{
				if ($meta["format"]=="0000-00-00")
				{
					if (!empty($dbdata[$field]))
					{
						$dbdata[$field]=$this->date_from_db($dbdata[$field]);
					}
				}
			}
	}
	return $dbdata;
	}
	
	/**
	 * Detail Label	for Form
	 * 
	 * @param   void
	 * @return  string label
	 */
	function get_detaillabel($data)
	{
		$lbl="";
		if(is_array($data))
		{
			$lbl= $this->detailformat($data);
		}else{
			$lbl="";
		}
		return $lbl;

	}
	
}
?>