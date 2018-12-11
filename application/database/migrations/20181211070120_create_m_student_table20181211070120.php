<?php

class Migration_create_m_student_table20181211070120 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $data = array('data' =>
            array(
                'FormName' => 'm_student',
                'AliasName' => 'master student',
                'LocalName' => 'master siswa',
                'ClassName' => 'Master',
                'Resource' => 'res_student',
                'IndexRoute' => 'mstudent'
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
        //$this->dbforge->drop_table('create_m_student_table20181211070120');
    }

}