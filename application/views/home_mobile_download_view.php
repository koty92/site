<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<?php $this->view('common/header'); ?>
	
	<link rel='stylesheet' type='text/css' href='<?= base_url(); ?>assets/css/home_mobile.css?v=0.06' />
	
	<script src='<?= base_url(); ?>assets/js/home.js?v=0.03'></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">

</head>
<body>

    <div class='container'>
        <?php $this->view('common/top_bar_mobile'); ?>

        <div class='container_mid_download'>
			<div class='container_background'>
                <div class='background_home_download'></div>
            </div>

            <div class='container_mobile_download_content'>

                <div class='container_download_btn col'>
                    <a target='_blank' class='uri_mobile_download' href='https://play.google.com/store/apps/details?id=com.apa.sipromo'>
                        <img 
                            src='<?= base_url(); ?>assets/images/download_on_google.png'
                            class='img_download_btn'
                        />
                    </a>

                    <a target='_blank' class='uri_mobile_download' href='https://itunes.apple.com/id/app/sipromo/id1438326964?mt=8'>
                        <img 
                            src='<?= base_url(); ?>assets/images/download_on_apple.png'
                            class='img_download_btn'
                        />
                    </a>
                </div>
            </div>

            <div class='container_main_bot'>
                <?php $this->view('common/footer'); ?>
            </div>
        </div>
    </div>

    <?php $this->view('common/mobile_side_bar'); ?>

</body>
</html>