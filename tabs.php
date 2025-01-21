<?php
	$p = $_GET['id'];	
	
	switch($p) {
		
		case "1":
		echo '<h2>Google</h2>Content goes here !<br style="clear:both;" />';
		break;			  
		
		case "2":
		echo 'Yahoo content ?<br style="clear:both;" />';
		break;
		
		case "3": 
		echo 'My hotmail content goes here...<br style="clear:both;" />';
		break;
		
		case "4": default:
		echo 'Twitter status update <br style="clear:both;" />';
		break;
	}

?>

<html>
	<table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
	<tr>
		<th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
		<th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
	</tr>
	</table>
</html>