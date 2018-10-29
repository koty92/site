<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l container_content_dashboard'>

	<div class=''>
		<div class='col'>
		
			<div class='col container_table_invoice'>
				<table class='table_invoice'>
					<tr>
						<td>Campaign Title</td>
						<td><?= ucfirst($result[0] -> campaign_title); ?></td>
					</tr>
					
					<tr>
						<td>Time Period</td>
						<td>
							<?php
							$pid = $this->session->userdata('pid');
							$date_to = $result[0] -> campaign_date_to;
							$date_from = $result[0] -> campaign_date_from;
							?>
							
							<?= date('d-m-Y', strtotime($date_from)) . ' - ' . date('d-m-Y', strtotime($date_to)); ?>
						</td>
					</tr>
					
					<tr>
						<td>Details</td>
						<td class='txt-r'>
							<?php
							// Count diff date
							$date1 = new DateTime($date_to);
							$date2 = new DateTime($date_from);
							$diff = $date2->diff($date1)->format("%a");
							$diff++;
							?>
							<?= $diff . ' Days x Rp. 10.000'; ?>
						</td>
					</tr>
					
					<tr>
						<td>Total</td>
						<td class='td_total txt-r'><?= 'Rp. ' . add_dot($diff * 10000); ?></td>
					</tr>
				</table>
			</div>
			
			<div class='col'>
				<img src='<?= base_url(); ?>assets/images/campaigns/<?= $pid; ?>/<?= $result[0] -> campaign_pid; ?>/<?= $result[0] -> campaign_image; ?>' class='invoice_campaign_img' />
			</div>
		
		</div>
		
		<div class='col txt-c container_transfer_notice'>
			<div>
				
				Silahkan melakukan pembayaran ke 
				
				<div>
					<img src='<?= base_url(); ?>assets/images/logo_bca.png' class='logo_bca' />
				</div>
				
				123456789
				<br>
				A/n PT. Adgo
				
				<div>
					<div class='btn_confirm_payment col'>Confirm Payment</div>
				</div>
				
			</div>
		</div>
	</div>

</div>