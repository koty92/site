<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_page_preview'>

    <div class='container_scroll_preview'>
        <div class='container_page_preview_phone col'>
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
                                    style='width: <?= $g['width'] * 75; ?>px; height: 100%;'
                                    data-grid_pid='<?= $g['campaign'][0]['page_grid_pid']; ?>'
                                    data-grid_col='<?= $g['width']; ?>'
                                    data-grid_index='<?= $g['campaign'][0]['page_grid_index']; ?>'
                                    data-row_pid='<?= $e['page_row_pid']; ?>'
                                    data-row_y='<?= $e['page_row_y']; ?>'
                                >
                                    <div class='container_flex_exist_img'>
                                        <div class='preview_exist_col_img'>
                                            <?php foreach($g['campaign'] as $c): ?>
                                                <?php $grid_y = $c['page_grid_y']; ?>
                                                <?php if($c['campaign_image'] != ''): ?>
                                                    <div style='width:<?= ($c['page_grid_x'] * 74) + (($c['page_grid_x']-1)*$c['page_grid_x']); ?>px; height:<?= ($c['page_grid_y'] * 74) + ($c['page_grid_y']*0) + (($grid_y-1)*0); ?>px;' class='col exist_preview_col_top_container'>
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
        </div>
    </div>

    <div class='container_preview_btn col'>
        <div class='container_box container_box_row'>
            <div class='container_flex container_flex_add_row'>
                <div class='container_btn_add_row'>
                    <div 
                        class='preview_btn_add btn_add_row'
                        data-category_pid='<?= $category_pid; ?>'
                    >
                        Tambah baris
                    </div>
                </div>

                <div class='container_add_option_row'>
                    <div class='container_add_option'>
                        <div class='container_options'>
                            <div class='container_loader'>
                                <img src='<?= base_url(); ?>assets/images/loader1.gif' />
                            </div>

                            <div class='container_option_content container_option_row'>
                                <?php for($i = 1; $i < 7; $i++): ?>
                                    <div class='div_option option_row col'>
                                        <div class='row_img'>
                                            <div style='width: 80px; height: <?= $i*20; ?>px; border: 1px solid #cacaca; display: inline-block;'></div>
                                        </div>

                                        <div class='row_txt'>
                                            4 x <?= $i; ?>
                                        </div>

                                        <div class='row_btn'>
                                            <input 
                                                type='radio' 
                                                class='row_radio_btn'
                                                value='<?= $i; ?>' 
                                            />
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class='container_btn_save'>
                            <div 
                                class='preview_btn_save btn_save_row col'
                                data-category_pid='<?= $category_pid; ?>'
                            >
                                Save
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='container_box container_box_col'>
            <div class='container_flex container_flex_add_col'>
                <div class='container_btn_add_row'>
                    <div 
                        class='preview_btn_add btn_add_col'
                        data-category_pid='<?= $category_pid; ?>'
                    >
                        Tambah kolom
                    </div>
                </div>

                <div class='container_add_option'>
                    <div class='container_options'>
                        <div class='container_loader'>
                            <img src='<?= base_url(); ?>assets/images/loader1.gif' />
                        </div>

                        <div class='container_option_content container_option_col'></div>
                    </div>
                    <div class='container_btn_save'>
                        <div 
                            class='preview_btn_save btn_save_col col'
                            data-category_pid='<?= $category_pid; ?>'
                        >
                            Save
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='container_box container_box_campaign'>
            <div class='container_flex container_flex_add_col'>
                <div class='container_btn_add_row'>
                    <div 
                        class='preview_btn_add btn_add_campaign'
                        data-category_pid='<?= $category_pid; ?>'
                    >
                        Tambah Campaign
                    </div>
                </div>

                <div class='container_add_option'>
                    <div class='container_row_campaign_select'>
                        <div class='container_campaign_select txt-l'>
                            <div class='col'>
                                <?php
                                $this->db->select('campaign_pid as data_value, campaign_title as data_text');
                                $this->db->order_by('campaign_pid DESC');
                                $query = $this->db->get_where('campaign', array('category_pid' => $category_pid));
                                            
                                $data_cat = array(
                                    'result' => $query->result(),
                                    'name' => 'grid_campaign',
                                    'placeholder' => 'Tambah Campaign Baru',
                                    'id' => 'select_page_campaign',
                                    'value' => ''
                                );
                                $this->view('eselect', $data_cat);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class='container_options'>
                        <div class='container_loader'>
                            <img src='<?= base_url(); ?>assets/images/loader1.gif' />
                        </div>

                        <div class='container_option_content container_option_campaign'></div>
                    </div>

                    <div class='container_btn_save'>
                        <div 
                            class='preview_btn_save btn_save_campaign col'
                            data-category_pid='<?= $category_pid; ?>'
                        >
                            Save
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='container_scroll_page_campaign_preview col'>
        <div class='container_page_campaign_preview'>
        </div>
    </div>

</div>