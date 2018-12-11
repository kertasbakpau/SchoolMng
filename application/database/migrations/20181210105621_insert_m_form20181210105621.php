<?php

class Migration_insert_m_form20181210105621 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' =>
            array(
                'FormName' => 'm_worker',
                'AliasName' => 'master worker',
                'LocalName' => 'master pekerja',
                'ClassName' => 'Master',
                'Resource' => 'res_worker',
                'IndexRoute' => 'mworker'
            ),
            array(
                'FormName' => 'm_mapel',
                'AliasName' => 'master subject',
                'LocalName' => 'master mata pelajaran',
                'ClassName' => 'Master',
                'Resource' => 'res_subject',
                'IndexRoute' => 'msubject'
            ));
        foreach ($data as $value){
            $mform = $this->db->query("SELECT * FROM m_form where FormName = '".$value["FormName"]."'")->row();
            if($mform){

            } else {
                $this->db->insert('m_form', $value);
            }
        }
    }

    public function down() {
        //$this->dbforge->drop_table('insert_m_form20181210105621');
    }

}