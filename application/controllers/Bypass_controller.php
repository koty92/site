<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bypass_controller extends CI_Controller {

    public function test_increment_row_index() {
        $this->db->set('page_row_index', 'page_row_index+1', false);
        $this->db->where('promo_category_pid', '10');
        $this->db->update('page_row');
    }

    public function insert_page_grid2() {
        $arr_rpid = array('50', '51', '52', '53', '54');
        $arr_gpid = array(
            array('144'),
            array('145', '146', '147', '148'),
            array('149', '150', '151', '152'),
            array('153', '154', '155', '156'),
            array('157', '158'),
        );

        for($i = 0; $i < 5; $i++) {
            $index = 1;
            $data = array();

            foreach($arr_gpid[$i] as $g) {
                $row['page_row_pid'] = $arr_rpid[$i];
                $row['page_grid_index'] = $index;
                $row['page_grid_col'] = 1;
                $row['page_grid_x'] = 1;
                $row['page_grid_y'] = 1;
                $row['campaign_pid'] = $g;
                array_push($data, $row);
                $index++;
            }

            if($this->db->insert_batch('page_grid', $data)) {
                echo '1';
            }
        }
    }

    public function insert_page_grids() {
        // Row
        $category_pid = '11';
        $row_index = '2';
        $row_y = '6';

        // Grid
        $arr_cpid = array('97', '98', '99');
        $grid_x = '2';
        $grid_y = '6';

        $data_row = array(
            'promo_category_pid' => $category_pid,
            'page_row_index' => $row_index,
            'page_row_y' => $row_y,
        );

        if($this->db->insert('page_row', $data_row)) {
            $row_id = $this->db->insert_id();

            $data = array();
            $i = 1;
            foreach($arr_cpid as $e) {
                $row['page_row_pid'] = $row_id;
                $row['page_grid_index'] = $i;
                $row['page_grid_x'] = $grid_x;
                $row['page_grid_y'] = $grid_y;
                $row['campaign_pid'] = $e;
                array_push($data, $row);
                $i++;
            }

            //if($this->db->insert_batch('page_grid', $data)) {
             //   echo '1';
            //}

            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
    }

    public function insert_page_cols() {
        $query = $this->db->get('page_grid');
        $result = $query->result();
        $data = array();

        foreach($result as $r) {
            $pgpid = $r -> page_grid_pid;
            $row['page_grid_pid'] = $pgpid;
            $row['page_grid_col'] = $r -> page_grid_x;
            array_push($data, $row);
        }

        //if($this->db->update_batch('page_grid', $data, 'page_grid_pid')) {
            //echo '1';
        //}
    }

    public function input_kelurahan() {
        if(isset($_POST['kecamatan_pid'])) {
            $kecamatan_pid = $this->input->post('kecamatan_pid');
            $kelurahan_name = array_filter($this->input->post('kelurahan_name'));
            $kode_pos = array_filter($this->input->post('kode_pos'));

            $data = array();
            for($i = 0; $i < count($kelurahan_name); $i++) {
                $row['kecamatan_pid'] = $kecamatan_pid;
                $row['kelurahan_name'] = $kelurahan_name[$i];
                $row['kode_pos'] = $kode_pos[$i];
                array_push($data, $row);
            }

            if($this->db->insert_batch('data_kelurahan', $data)) {
                redirect(base_url() . 'bypass_controller/input_kelurahan');
            }

            /*
            echo '<pre>';
            print_r($kecamatan_pid);
            print_r($kelurahan_name);
            print_r($kode_pos);
            echo '</pre>';
            */
        } else {
            echo '<form method="post" action="' . base_url() . 'bypass_controller/input_kelurahan">';
            echo '<input type="submit" name="Save" />';
            echo '<input type="text" name="kecamatan_pid" autocomplete="off"><br />';
            for($i = 0; $i < 30; $i++) {
                echo '<input type="text" name="kelurahan_name[]" autocomplete="off">';
                echo '<input type="text" name="kode_pos[]" autocomplete="off">';
                echo '<br />';
            }
            echo '</form>';
        }
    }

    public function add_kelurahan() {
        $kecamatan_pid = array('1', '2', '3');
        $kelurahan_name = array(
            array(
                'Cempaka Putih Barat',
                'Cempaka Putih Timur',
                'Rawasari'
            ),
            array(
                'Cideng',
                'Duri Pulo',
                'Gambir',
                'Kebon Kelapa',
                'Petojo Selatan',
                'Petojo Utara'
            ),
            array(
                'Galur',
                'Johar Baru',
                'Kampung Rawa',
                'Tanah Tinggi'
            )
        );

        $kode_pos = array(
            array(
                '10520',
                '10510',
                '10570'
            ),
            array(
                '10150',
                '10140',
                '10110',
                '10120',
                '10160',
                '10130'
            ),
            array(
                '10530',
                '10560',
                '10550',
                '10540'
            )
        );

        $data = array();

        for($i = 0; $i < count($kecamatan_pid); $i++) {
            foreach($kelurahan_name[$i] as $e) {
                $row['kecamatan_pid'] = $kecamatan_pid[$i];
                $row['kelurahan_name'] = $e;
                array_push($data, $row);
            }
        }

        if($this->db->insert_batch('data_kelurahan', $data)) {
            echo '1';
        }
    }

    public function test_date() {
        if(checkmydate('10', '01', '2018')) {
            echo '1';
        } else {
            echo '0';
        }
    }

    
}

function checkmydate($y, $m, $d) {
    return checkdate($y, $m, $d);
}

?>