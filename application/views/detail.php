<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		
		
		<?php echo $header; ?>
		
	</head>  
	<body>
			<div class="navigation">
				<?php echo $navigation; ?>
			</div>
			</br><? echo time(); ?>	  </br>
			<div id="<?php echo $controller; ?>" class="content">
				<?php echo $detail; ?>
			</div>
			<div class="context">
				<?php if (isset($context)) echo $context; ?>
			</div>
			<?php if (isset($display)) echo $display; ?>
			<div class="footer">
				<?php echo $footer; ?>
			</div>
<pre> <?php //print_r($kohana_view_data); ?></pre>
<pre> <?php //print_r($_global_data); ?></pre>
	</body>
</html>
