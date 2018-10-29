<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='txt-l container_content_dashboard'>
	<div class='content_header'>Company Profile</div>
	
	<div class='container_content_profile'>
		
		<table class='table_profile'>
			<tr>
				<td rowspan='6'>
					<div class='container_company_logo'>
						<img src='<?= base_url(); ?>assets/images/company_logo/<?= $company[0] -> company_pid; ?>/<?= $company[0] -> company_logo; ?>' class='company_logo' />
					</div>
				</td>
			</tr>
			<tr>
				<td>Company Name</td>
				<td><?= ucfirst($company[0] -> company_name); ?></td>
			</tr>
			<tr>
				<td>E-mail Address</td>
				<td><?= ucfirst($company[0] -> company_email); ?></td>
			</tr>
			<tr>
				<td>Telephone</td>
				<td><?= ucfirst($company[0] -> company_telephone); ?></td>
			</tr>
			<tr>
				<td>City</td>
				<td><?= ucfirst($company[0] -> city_name); ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?= ucfirst($company[0] -> company_address); ?></td>
			</tr>
		</table>
		
	</div>
</div>