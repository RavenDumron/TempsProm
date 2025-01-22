<?php

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');	

$p = $_GET['id'];	

?>

<html>
	<?php switch($p) : 
		
		case "1": 

			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-1-1',
				'date_end' => '2024-1-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>

			<div><strong>Temps pour janvier</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
						<tr>
							<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
							<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
						</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>			  
		
		<?php case "2": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-2-1',
				'date_end' => '2024-2-29',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>
			<div><strong>Temps pour février</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
						<tr>
							<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
							<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
						</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	
		
		<?php case "3": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-3-1',
				'date_end' => '2024-3-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>
			<div><strong>Temps pour mars</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
						<tr>
							<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
							<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
						</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	
		
		<?php case "4": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-4-01',
				'date_end' => '2024-4-30',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour avril</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "5": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-5-1',
				'date_end' => '2024-5-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour mai</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "6": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-6-1',
				'date_end' => '2024-6-30',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour juin</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "7": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-7-1',
				'date_end' => '2024-7-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour juillet</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "8": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-8-01',
				'date_end' => '2024-8-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour août</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "9": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-9-1',
				'date_end' => '2024-9-30',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour septembre</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "10": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-10-1',
				'date_end' => '2024-10-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour octobre</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "11": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-11-1',
				'date_end' => '2024-11-30',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour novembre</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

		<?php case "12": 
			$selectedTimesSQL = $mysqlClient->prepare(
				"SELECT i.total_time, c.name, i.intervention_start
				FROM interventions i 
				INNER JOIN clients c 
				ON i.client_id = c.client_id 
				WHERE DATE (i.intervention_start) BETWEEN :date_start AND :date_end
				ORDER BY c.name ASC"
				);
			$selectedTimesSQL ->execute([
				'date_start' => '2024-12-1',
				'date_end' => '2024-12-31',
			]);
			
			$selected_times = $selectedTimesSQL->fetchAll();
			
			//cumule les temps de chaque client pour afficher un seul résultat
			
			$time_sum  = array();
			foreach($selected_times as $sum){
				if(array_key_exists($sum['name'],$time_sum)){
					$time_sum[$sum['name']]['total_time'] += $sum['total_time'];
					$time_sum[$sum['name']]['name'] = $sum['name'];
				}
				else{
					$time_sum[$sum['name']]  = $sum;
				}
			}
			//Calcul du total de l'ensemble des temps
			
			$totalSum = array_sum(array_column($time_sum,'total_time'));	
			?>			

			<div><strong>Temps pour décembre</strong></div>
                <table style="border-collapse: collapse; border: 1px solid black; width: 50%;">
                    <tr>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Société</th>
                        <th style="border: 1px solid black; padding: 4px; text-align: left;">Temps total</th>
                    </tr>
                    <?php foreach ($time_sum as $client_times): ?>
							<tr>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo $client_times['name'];?></td>
								<td style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $client_times['total_time']);?></td>
							</tr>
                    <?php endforeach; ?>
                        <tr>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;">Total</td>
                            <th style="border: 1px solid black; padding: 4px; text-align: left;"><?php echo gmdate("H:i:s", $totalSum);?></td>
                        </tr>
                </table> 
		<?php break; ?>	

	<?php endswitch; ?>

