<?php

class Migration_insert_m_form20181207163422 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');

            //insert data
         
        $data = array('data' =>
                
                array(
                    'Name' => 'WorkerStatus'
                ));
            foreach ($data as $value){
                $this->db->insert('m_enum', $value);
            }
        

            //insert data
            $data = array('data' =>
                
                array(
                    'EnumId' => 4,
                    'Value' => 1,
                    'EnumName' => 'Administration',
                    'Ordering' => 1,
                    'Resource' => 'res_admin'
                ),
                array(
                    'EnumId' => 4,
                    'Value' => 2,
                    'EnumName' => 'Teacher',
                    'Ordering' => 2,
                    'Resource' => 'res_teacher'
                ),
                array(
                    'EnumId' => 4,
                    'Value' => 99,
                    'EnumName' => 'Other',
                    'Ordering' => 99,
                    'Resource' => 'res_other'
                ));
            foreach ($data as $value){
                $this->db->insert('m_enumdetail', $value);
            }
        }
    public function down() {
        // $this->dbforge->drop_table('insert_m_form20181207163422');
    }

}