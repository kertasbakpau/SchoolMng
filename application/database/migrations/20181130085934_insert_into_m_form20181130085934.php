<?php

class Migration_insert_into_m_form20181130085934 extends CI_Migration {

    private $table = 'm_form';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            
            array(
                'FormName' => 'm_schoolyear',
                'AliasName' => 'master school year',
                'LocalName' => 'master tahun ajaran',
                'ClassName' => 'Master'
            ));
        foreach ($data as $value){
            $this->db->insert($this->table, $value);
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_into_m_form20181130085934');
    }

}