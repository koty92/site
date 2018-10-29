<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class='container_page_preview'>

    <div class='container_scroll_preview overflow_8px'>
        <div class='container_page_preview_phone col'>
            <?php $this->view('include/load_page_preview'); ?>
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

                    <div class='col container_radio_row_position'>
                        <input type='radio' name='row_position' value='top' class='radio_row_position' id='position_top'>
                        <label for='position_top' class='radio_row_position_txt col'>
                            Atas
                        </label>

                        <input type='radio' name='row_position' value='bot' class='radio_row_position' id='position_bot'>
                        <label for='position_bot' class='radio_row_position_txt col'>
                            Bawah
                        </label>
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

    <div class='container_scroll_page_campaign_preview col overflow_8px'>
        <div class='container_page_campaign_preview'>
        </div>
    </div>

</div>