    <title><?php echo $title; ?></title>
		<?php  echo Html::style('assets/css/superfish.css',array('media'=>'screen, projection'), FALSE);
			//echo Html::style('assets/css/smoothness/ui.all.css',array('media'=>'screen, projection'), FALSE);
			echo Html::style('assets/css/base/jquery.ui.all.css',array('media'=>'screen, projection'), FALSE);		
		    //echo Html::script('assets/js/jquery-1.2.6.min.js');
		    echo Html::script('assets/js/jquery-1.4.2.js');
			echo Html::script('assets/js/hoverIntent.js');
			echo Html::script('assets/js/superfish.js');
			echo Html::script('assets/js/jquery.form.js');
			echo Html::script('assets/js/jquery-ui-1.8.2.custom.min.js');
			echo Html::script('assets/js/i18n/jquery.ui.datepicker-de.js');
			//echo Html::script('assets/js/i18n/ui.datepicker-de.js');
		?>
		<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			$('ul.sf-menu').superfish();
			
		});
		//strange side effects with {showOn: 'button', buttonImage: 'images/calendar.gif', buttonImageOnly: true}
		function showRequest(formData, jqForm, options) { 
		    var queryString = $.param(formData); 
		 
		    alert('About to submit: \n\n' + queryString); 
		    return true; 
		} 
		function showResponse(responseText, statusText, xhr, $form)  { 
		    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
		        '\n\nThe output div should have already been updated with the responseText.'); 
		} 
		</script>
<style type="text/css">
  	body {
		font:100% verdana,arial,sans-serif;
  	}
	
  	.navigation{
	  	position:relative;  z-index:0;
	  	
  		font-size: 1em;
	    background-color: #eed;
	    border: 2px ridge silver;
		margin: 0 0 0.7em; padding: 0.3em;
		

  	}
  	.content{
	  	position:relative; 
	  	left:10px; 
	  	z-index:1;
	  	float: left; 
	  	width: 45%;
	  	max-width: 45em;
	    background-color: #ded;
	    border: 1px dashed silver;
		margin: 0 0 0.7em; 
		padding: 0.3em;
		
  	}
	.context {
	  	position:relative; 
	  	left:10px; 
	  	z-index:1;
	  	font-size: 0.9em;
	  	background-color: #eee;
	    float: right; 
	    margin: 0 1em 0.7em 1em; 
	    padding: 0.3em;
	    width: 45%;
	  	max-width: 45em;
	    background-color: #eee; 
	    border: 1px dashed silver;

	}
	.footer {
		clear: both;
	    font-size: 0.9em;
	    
	    background-color: #fed; 
	    border: 1px solid silver;

	 }
	.header{
	 position:relative;
	font-size: 1.9em;
	}
	.mainmenu{
	position:relative;z-index:0;
	
	}
	.msg{
 		color: green;
 	} 
	.menu{
	}
  	.hint{
	color:red;
	background-color:yellow;
	}
	.detailform{
	}
	.contextsegment{
	clear: both;
	
	}
	.contexttitle{
	float: left;	
	width: 10em;

	}
	
	.contextnew{

		float: right;
	}
	.contextlink{
		width: 5em;
	}
 	.contextdetail{
 	}
 	
 	.display{
 		position:relative; left:10px; z-index:1;
	  	font-size: 0.9em;
	  	background-color: #eee;
	    float: right; width: 32em;
	    margin: 0 1em 0.7em 1em; padding: 0.3em;width: 40%;
		width: 45%;
	  	max-width: 45em;
	    background-color: #fee; border: 1px dashed silver;
 	}
 	
 	.formerror{
 		color: red;
 	} 

 	.formmenubar{
 		width: 450;
 		height: 70;
 	} 
 	form { /* set width in form, not fieldset (still takes up more room w/ fieldset width */
		position:relative; top:20px; z-index:10;
	 	
		margin: 0;
		padding: 0;
		min-width: 200px;
		max-width: 650px;
		width: 400px; }/**/
	form fieldset {
		/ * clear: both; note that this clear causes inputs to break to left in ie5.x mac, commented out */
		border-color: #FFFF00;
		border-width: 3px;
		border-style: solid;
		padding: 10px; /* padding in fieldset support spotty in IE */
		margin: 0;
		}
	form label { display: block; /* block float the labels to left column, set a width */
		float: left; width: 50px; padding: 0; margin: 5px 0 0; /* set top margin same as form input - textarea etc. elements */
		text-align: right; }
	
	form fieldset legend {
		font-size:1.1em; /* bump up legend font size, not too large or it'll overwrite border on left */
		/* be careful with padding, it'll shift the nice offset on top of border */
		}
	form input, form textarea, form select, form datepicker {
		/* display: inline; inline display must not be set or will hide submit buttons in IE 5x mac */
		width:auto; /* set width of form elements to auto-size, otherwise watch for wrap on resize */
		margin:5px 0 0 10px; /* set margin on left of form elements rather than right of
		label aligns textarea better in IE */
		}
	form input#submit { color:green;}
	form input#reset {
		margin-left:0px; /* set margin-left back to zero on reset button (set above) */
		}
	textarea { overflow: auto; }
	form small {
		display: block;
		margin: 0 0 5px 160px; /* instructions/comments left margin set to align w/ right column inputs */
		padding: 1px 3px;
		font-size: 88%;
	}
	form .required{font-weight:bold;} /* uses class instead of div, more efficient */
	form br {
		clear:left; /* setting clear on inputs didn't work consistently, so brs added for degrade */
	}

 	
 	
</style>
