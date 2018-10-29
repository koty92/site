<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$cpid = $this->uri->segment(2);
$cpid = $cpid / 92771499 - 5;
?>

<div class='txt-l container_content_dashboard'>

    <div class='container_page_filter'>
        <div class='col' style='padding: 15px 0 0 0;'>
            <?php
            $this->db->select('category_pid as data_value, category_name as data_text');
            $this->db->order_by('category_name');
            $query = $this->db->get_where('promo_category', array('company_pid' => $cpid));
                        
            $data_cat = array(
                'result' => $query->result(),
                'name' => 'promo_category',
                'placeholder' => 'Pilih Kategori',
                'id' => 'filter_category_page',
                'value' => ''
            );
            $this->view('eselect', $data_cat);
            ?>
        </div>
    </div>

    <?php $this->view('common/loader_25_red'); ?>

    <div class='container_page_content'></div>

</div>