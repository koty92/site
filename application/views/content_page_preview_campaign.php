<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_load_campaign'>

    <?php if($result): ?>
        <div class='container_load_campaign_title'>
            <?= $result[0] -> campaign_title; ?>
        </div>

        <div class='container_load_campaign_img'>
            <img 
                src='<?= base_url() . 'assets/images/campaigns/' . $result[0] -> company_pid . '/' . $result[0] -> campaign_pid . '/' . $result[0] -> campaign_image; ?>' 
                class='img_load_campaign'
            />
        </div>

        <div class='container_load_campaign_desc'>
            <?= nl2br($result[0] -> campaign_desc); ?>
        </div>
    <?php endif; ?>

</div>