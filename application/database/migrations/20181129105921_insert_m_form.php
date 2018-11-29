<?php

class Migration_insert_m_form_20181129105921 extends CI_Migration {

    private $table = 'm_form';
    public function up() {
        $this->load->helper('db_helper');
        //$data = array();
        $data = array('data' =>
            
            array(
                'FormName' => 'm_groupuser',
                'AliasName' => 'master group user',
                'LocalName' => 'master grup pengguna',
                'ClassName' => 'Master'
            ),
            array(
                'FormName' => 'm_user',
                'AliasName' => 'master user',
                'LocalName' => 'master pengguna',
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