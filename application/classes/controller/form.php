<?php  defined('SYSPATH') or die('No direct script access.');

class Controller_Form extends Controller {

	
	public function __construct(Request $request, Response $response)
    {
        // construct model 
		
    	parent::__construct($request,  $response); 
    }	
    
    
    /* The before() method is called before your controller action. */
    public function before()
      {
        parent::before();
  	  }

  	  
  	/* The after() method is called after your controller action. */
    public function after()
      {
      	parent::after();
      }
      
     /**
	 * show empty form for searching or new data
	 *
	 * @param   
	 * @return  
	 */
	public function action_empty()
	{
		
	}
		
	/**
	 * shows detaildata 
	 *
	 * @param  module,  id
	 * @return  void
	 */
	public function action_show()
	{
		$module = $this->request->param('module');
		$id = $this->request->param('id');
		
	}
	
	/**
	 * submit from empty detailmask
	 * either searching or inserting
	 * @param   
	 * @return  void
	 */
	public function action_submit()
	{
		//------submit button------------
		if (isset($_POST["insert"]))
		{
			// show inserted data and context
		}elseif(isset($_POST["search"])){
			
			$found=$this->model->form_search($this->post);
			switch ($found){
				case 0: //nothing found, search again
					//redirect('/empty');
					break;
				case 1: // one found, show detail
					//redirect('/detail/');
					break;
				default : //>1 several found, construct the list
					//redirect('/page/1');
			}		
		}
	}
    
	/**
	 * insert detaildata and shows inserted data
	 *
	 * @param  module,  id
	 * @return  void
	 */
	public function action_insert()
	{
		
		
	}
	
	/**
	 * update detaildata and shows updated data
	 *
	 * @param  module,  id
	 * @return  void
	 */
	public function action_update()
	{
		
		
	}

	/**
	 * delete detaildata and shows empty form data
	 *
	 * @param  module,  id
	 * @return  void
	 */
	public function action_delete()
	{
		
		
	}
	
    /**
	 * constructs model from modulename
	 * 
	 * @param   modulename
	 * @return  formatted label
	 */
	function model_factory($modulename)
	{
		$modelname="Model_".ucfirst($modulename);
		$model=new $modelname();
		return $model;
	}

	/**
	 * MainMenu Construction: Modules etc
	 *
	 * @param   void
	 * @return  array with menuitems and labels
	 */
	function menu_main()
	{
		$menu[0]=html::anchor('/object', "object");
		$menu[1]=html::anchor('/person', "person");
		ksort($menu);
		return $menu;
	}
	
	
	
	/*********************
	 * Form Management   *
	 *********************/
	
	
	/**
	 * processes data and outputs html of a form   
	 *
	 * @param   $form data 
	 * @return  array $form[] with html
	 */
	function form_factory($formdata)
	{
		//check credentials rw r here
		
		// Form textual information
		$form["module"]=$formdata["module"];
		$form["label"]=	$formdata["label"];
		$form["title"]= $formdata["title"]; 
		$form["form_id"]=$formdata["form_id"];
		$form["message"]=$formdata["message"];
		
		// ---- Form Open --------
		$outform["open"]=form::open($formdata["action"],array("id"=>$formdata["form_id"]));
		
		// ---- Form Menu: Insert, Update, Delete --------
		$form["menuitems"]=$formdata["menuitems"];
		foreach ($formdata["menuitems"] as $key=>$mitem)
		{
			$func="menu_".$mitem;
			$form["menuitems"][$key]= $this->$func();
		}
		
		
		//$outform["menuitems"]=$this->menu_form($id);
		$form["open"]=form::open($formdata["action"],array("id"=>$formdata["form_id"]));
		
		foreach ($formdata["fields"] as $key => $arr) 
		{
			//----databinding----
			//set options maxlength
			$options=array();
			if(isset($arr['len']))
			{
				$options=array('maxlength='=>$arr['len']);
			}
			// select the form control type
			switch ($arr["type"]) {
				case 'input':
					$form["fields"][$key]["type"]=form::input($key, $arr["value"], $options);
					break;
				case 'datepicker':
					$options=array('class'=>'datepicker'); 
					$form["fields"][$key]["type"]=form::input($key, $arr["value"], $options);
					break;
				case 'checkbox':
					if ($arr["value"]==1)
					{
						$checked=true;
					}else{
						$checked=false;
					}
					$form["fields"][$key]["type"]=form::checkbox($key, 1,$checked, $options);
					break;
				case 'select':
					
					$form["fields"][$key]["type"]=form::select($key, $arr["options"], $arr["value"]);
					break;
				default:
					$outform["fields"][$key]["type"]=form::input($key, $arr["value"], $options);
					break;
			}
			// label and hint
			$attributes=array('title'=>__($this->modulename.'.'.$key.".hint"));
			$label=__($this->modulename.'.'.$key.".label");
			$form["fields"][$key]["label"] =form::label($key, $label,$attributes);
			$form["fields"][$key]["error"] ="";
		} // foreach fields
		$form["close"] =form::close();
		return $form;	
	}	
	
		
 	
}
?>