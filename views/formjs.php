	<script type="text/javascript">
		$(document).ready(function() {
			$.datepicker.setDefaults($.datepicker.regional['de']);
			$('.datepicker').datepicker();
			
			
			var doptions = { 
				        target:"#<?php echo $form["module"]; ?>"  /*,    
	        			beforeSubmit:  showRequest,   
	        			success:       showResponse*/
			}; 
			/*$(".datepicker").datepicker();*/
			$("#<?php echo $form["form_id"]; ?>").ajaxForm(doptions);
			
			$("#<?php echo $form["form_id"]; ?>").change(function () {
	          $("#<?php echo $form["form_id"]; ?> #message").text("!speichern!");
	          $("#<?php echo $form["form_id"]; ?> #message").addClass("hint");
	          $("#<?php echo $form["form_id"]; ?> #submit").css({color:'red'});
	        });
	        $("#<?php echo $form["form_id"]; ?> #submit").click(function(){
	          $("#<?php echo $form["form_id"]; ?> #message").text("gespeichert");
	          $("#<?php echo $form["form_id"]; ?> #message").addClass("hint");
	          $("#<?php echo $form["form_id"]; ?> #submit").css({color:'green'});
	        });
	        
		});  
	</script>

