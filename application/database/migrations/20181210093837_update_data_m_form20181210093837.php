<?php

class Migration_update_data_m_form20181210093837 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');

        $data = array('data' => 
            array(
                'Id' => 1,
                'Resource' => 'res_school',
                'IndexRoute' => 'mschool'
            ),
            array(
                'Id' => 2,
                'Resource' => 'res_class',
                'IndexRoute' => 'mclass'
            ),
            array(
                'Id' => 3,
                'Resource' => 'res_groupuser',
                'IndexRoute' => 'mgroupuser'
            ),
            array(
                'Id' => 4,
                'Resource' => 'res_user',
                'IndexRoute' => 'muser'
            ),
            array(
                'Id' => 5,
                'Resource' => 'res_schoolyear',
                'IndexRoute' => 'mschoolyear'
            ),
        );

        foreach($data as $value){
            $this->db->set('Resource', $value['Resource']);
            $this->db->set('IndexRoute', $value['IndexRoute']);
            $this->db->where('Id', $value['Id']);
            $this->db->update('m_form');
        }
    }

    public function down() {
        //$this->dbforge->drop_table('update_data_m_form20181210093837');
    }

}