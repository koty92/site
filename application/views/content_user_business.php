<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_business txt-l'>

    <div class='container_user_business_btn'>
        <div class='user_business_btn_add btn_square_orange col'>
            Tambah Bisnis
        </div>
    </div>

    <?php foreach($result as $e): ?>
        <div class='container_user_company_name'>
            <a 
                class='hyperlink' 
                href='<?= base_url(); ?>company/<?= ($e -> company_pid + 5) * 92771499; ?>/dashboard'
            >
                <?= $e -> company_name; ?>
            </a>
        </div>
    <?php endforeach; ?>

</div>