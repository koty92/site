<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_table_report'>
	
	<table class='table_report_analysis'>
		<tr>
			<th>Date</th>
			<th>Impressions</th>
			<th>Interactions</th>
			<th>Correct</th>
		</tr>
		
		<?php if($result): ?>
		
			<?php foreach($result as $e): ?>
			
				<tr>
					<td>
						<?= date('d-m-Y', strtotime($e['date'])); ?>
					</td>
					
					<td class='txt-r'>
						<?= add_dot($e['impression']); ?>
					</td>
					
					<td class='txt-r'>
						<?= add_dot($e['answer']); ?>
					</td>
					
					<td></td>
				</tr>
			
			<?php endforeach; ?>
			
		<?php endif; ?>
	</table>

</div>