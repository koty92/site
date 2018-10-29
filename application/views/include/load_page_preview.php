<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if($result): ?>
    <?php foreach($result as $e): ?>
        <div 
            style="height: <?= $e['page_row_y'] * 75; ?>px; width: 300px;" 
            class="preview_row_exist preview_row_<?= $e['page_row_index'] ?>" 
            data-row_pid='<?= $e['page_row_pid']; ?>'
            data-page_y='<?= $e['page_row_y']; ?>'
            data-page_row_index='<?= $e['page_row_index'] ?>'
        >
            <?php if(array_key_exists('grid', $e)): ?>
                <?php foreach($e['grid'] as $g): ?>
                    <div 
                        class='preview_exist_col col'
                        style='width: <?= $g['width'] * 25; ?>%; height: 100%;'
                        data-grid_pid='<?= $g['campaign'][0]['page_grid_pid']; ?>'
                        data-grid_col='<?= $g['width']; ?>'
                        data-grid_index='<?= $g['campaign'][0]['page_grid_index']; ?>'
                        data-row_pid='<?= $e['page_row_pid']; ?>'
                        data-row_y='<?= $e['page_row_y']; ?>'
                    >
                        <div class='container_flex_exist_img'>
                            <div class='preview_exist_col_img'>
                                <?php foreach($g['campaign'] as $c): ?>
                                    <?php 
                                        $grid_y = $c['page_grid_y']; 
                                        $grid_x = $c['page_grid_x'];
                                    ?>
                                    
                                    <?php if($c['campaign_image'] != ''): ?>
                                        <div style='
                                        width:<?= ($grid_x/$g['width'] * 100); ?>%; 
                                        height:<?= ($grid_y/$e['page_row_y'] * 100); ?>%;' 
                                        class='col exist_preview_col_top_container'>
                                            <div class='exist_preview_col_flex'>
                                                <img 
                                                    src='<?= base_url(); ?>assets/images/campaigns/<?= $c['company_pid']; ?>/<?= $c['campaign_pid']; ?>/<?= $c['campaign_image']; ?>' 
                                                    class='exist_preview_col_img'
                                                />
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>