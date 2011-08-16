<div class="list">
<legend><?php echo $title; ?></legend>
<?php echo $message; ?>	
<div class="listlabel"><?php echo $label; ?></div> 
	<?php echo $pagination->render(); ?>
	<table>
		<thead>
	  		<th>#</th>
	        <? foreach ($header as $heading): ?>
	            <th><?= $heading ?></th>
	        <? endforeach; ?>
	        
	    </thead>
	    <tbody>
	     	<?php echo $listitems; ?>   
	   	</tbody>
	</table>
	

</div> 	