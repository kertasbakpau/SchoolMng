<?php

class Migration_insert_m_form extends CI_Migration {

    private $table = 'm_form';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            
            array(
                'FormName' => 'm_school',
                'AliasName' => 'master school',
                'LocalName' => 'master sekolah',
                'ClassName' => 'Master'
            ),
            array(
                'FormName' => 'm_kelas',
                'AliasName' => 'master class',
                'LocalName' => 'master kelas',
                'ClassName' => 'Master'
            ));
        foreach ($data as $value){
            $this->db->insert($this->table, $value);
        }
    }

    public function down() {
        $this->dbforge->drop_table('insert_m_form');
    }

}