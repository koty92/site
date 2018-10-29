<?php
switch($uri) {
	case 'privacy-policy':
		$selected = 'Privacy Policy';
		$arr_nav = array('Terms and Conditions', 'Frequently Asked Questions', 'Contact Us');
		$arr_uri = array('terms-and-conditions', 'faq', 'contact-us');
		break;
	case 'terms-and-conditions':
		$selected = 'Terms and Conditions';
		$arr_nav = array('Privacy Policy', 'Frequently Asked Questions', 'Contact Us');
		$arr_uri = array('privacy-policy', 'faq', 'contact-us');
		break;
	case 'faq':
		$selected = 'Frequently Asked Questions';
		$arr_nav = array('Terms and Conditions', 'Privacy Policy', 'Contact Us');
		$arr_uri = array('terms-and-conditions', 'privacy-policy', 'contact-us');
		break;
}
?>

<div class='container_home2_nav'>
	<div class='container_selected'>
		<?= $selected; ?>
	</div>
	
	<div class='container_home2_nav'>
		<?php
		for($i = 0; $i < 3; $i++) {
			echo '<div class="home2_nav" data-uri="' . $arr_uri[$i] . '">';
			echo $arr_nav[$i];
			echo '</div>';
		}
		?>
	</div>
</div>