<?php echo $formjs; ?>
<?php echo $csegment; ?>

<div id="detail_<?php echo $form["module"]; ?>" class="detailform">
	<?php echo $form["open"]; ?>
	<div>
		title <span id="title" class="formsg"><?php echo $form["title"]; ?></span>	<br>
		label <span id="label" class="msg"><?php echo $form["label"]; ?></span> <br>
		message <span id="message" class="msg"><?php echo $form["message"]; ?></span>	<br>
		
	</div>
	<div class="formmenubar">
	  <ul  class="sf-menu">
			<? foreach ($form["menuitems"] as $key=>$item): ?>
				<li> <?php echo $item ?></li>            
			<? endforeach; ?>
	  </ul> 
	</div>

		<fieldset>
		    <? foreach ($form["fields"] as $field): ?>
		    	<?php echo $field["label"]; ?>
	            <?php echo $field["type"]; ?>
	            <div class="formerror"><?php echo $field["error"] ?></div>
        	<? endforeach; ?>
		</fieldset>
	<?php echo $form["close"]; ?>
		
</div>	
	
	
</br><? echo time(); ?>	  
	
	

