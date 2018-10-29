<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$cpid = $this->uri->segment(2);
?>

<div class='txt-l container_content_dashboard'>
	<div class='content_header'>Dashboard</div>
	
	<div>
		<div 
			class='btn_create_campaign btn_square_orange' 
			data-nav='campaign'
			data-cpid='<?= $cpid; ?>'
		>
			Create Campaign
		</div>
	</div>
	
	<div class='container_content_main'>
		
		<div>
			
			<div class='container_dashboard_campaigns txt-c'>
				
				<div class='col container_campaigns_active container_dashboard_tables'>
					<table class='table_campaign_active'>
						<tr>
							<th class='container_campaigns_active_title' colspan='5'>Currently Active Campaign</th>
						</tr>
						
						<?php
						date_default_timezone_set('Asia/Jakarta');
						$today = date('Y-m-d');

						$dcpid = $cpid / 92771499 - 5;
						$this->db->select();
						$this->db->from('campaign');
						$this->db->where('company_pid', $dcpid);
						$this->db->where('campaign_date_to >=', $today);
						$query = $this->db->get();
						$result = $query->result();
						
						if($query->num_rows() > 0) {
							foreach($result as $r){
								echo '<tr class="tr_campaign" data-capid="' . $r -> campaign_pid . '">';
								echo '<td class="td_campaign_date">' . date('d-m-y', strtotime($r -> campaign_created)) . '</td>';
								echo '<td class="txt-l">' . ucfirst($r -> campaign_title) . '</td>';
								echo '<td class="td_campaign_date">' . date('d-m-y', strtotime($r -> campaign_date_from)) . '</td>';
								echo '<td class="td_dash">-</td>';
								echo '<td class="td_campaign_date">' . date('d-m-y', strtotime($r -> campaign_date_to)) . '</td>';
								echo '</tr>';
							}
						} else {
							echo '<tr><td class="no_campaign_active">No Active Campaign</td></tr>';
						}
						?>
						
					</table>
				</div>
				
				<div class='col container_campaigns_expired container_dashboard_tables'>
					<table class='table_campaign_active'>
						<tr>
							<th class='container_campaigns_active_title' colspan='5'>Campaign History</th>
						</tr>
						
						<?php
						$this->db->select();
						$this->db->from('campaign');
						$this->db->where('company_pid', $dcpid);
						$this->db->where('campaign_date_to <', $today);
						$query = $this->db->get();
						$result = $query->result();
						
						if($query->num_rows() > 0) {
							foreach($result as $r){
								echo '<tr>';
								echo '<td class="td_campaign_date">' . date('d-m-y', strtotime($r -> campaign_created)) . '</td>';
								echo '<td class="txt-l">' . ucfirst($r -> campaign_title) . '</td>';
								echo '<td class="td_campaign_date">' . date('d-m-y', strtotime($r -> campaign_date_from)) . '</td>';
								echo '<td class="td_dash">-</td>';
								echo '<td class="td_campaign_date">' . date('d-m-y', strtotime($r -> campaign_date_to)) . '</td>';
								echo '</tr>';
							}
						} else {
							echo '<tr><td class="no_campaign_active">No Campaign History</td></tr>';
						}
						?>
						
					</table>
				</div>
				
				<div class='col container_dashboard_tables'>
					<table class='table_campaign_active'>
						<tr>
							<th class='container_campaigns_active_title' colspan='5'>Unpaid Invoice</th>
						</tr>
						
						<?php $result = $this->campaign_model->get_all_unpaid_invoice(); ?>
						
						<?php if($result): ?>
							<?php foreach($result as $r): ?>
								<tr class='hyperlink tr_unpaid_invoice' data-ipid='<?= $r -> invoice_pid; ?>'>
									<td class="td_campaign_date"><?= date('d-m-y', strtotime($r -> campaign_created)); ?></td>
									<td class="txt-l"><?= ucfirst($r -> campaign_title); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr><td class="no_campaign_active">No Unpaid Invoice</td></tr>
						<?php endif; ?>
					
					</table>
				</div>
				
				<div class='col container_dashboard_tables'>
					<table class='table_campaign_active'>
						
						
					</table>
				</div>
				
			</div>
			
		</div>
		
	</div>
</div>