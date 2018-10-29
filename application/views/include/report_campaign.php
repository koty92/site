<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_report_container'>
	
	<?php if($result): ?>
	
		<?php foreach($result as $e): ?>
		
			<div class='container_campaign_title' data-cpid='<?= $e -> campaign_pid; ?>'>
				<?= $e -> campaign_title; ?>
			</div>
		
		<?php endforeach; ?>
		
	<?php endif; ?>

</div>