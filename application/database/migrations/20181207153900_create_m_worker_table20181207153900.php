<?php

class Migration_create_m_worker_table20181207153900 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        if (!$this->db->table_exists('m_worker')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'ClassId' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => true
                ),
                'NIP' => array(
                    'type' => 'varchar',
                    'constraint' => 20,
                    'null' => true
                ),
                'Name' => array(
                    'type' => 'varchar',
                    'constraint' => 200,
                    'null' => true
                ),
                'Place_of_birth' => array(
                    'type' => 'varchar',
                    'constraint' => 200,
                    'null' => true
                ),
                'Date_of_birth' => array(
                    'type' => 'datetime',
                    'null' => true
                ),
                'Gender' => array(
                    'type' => 'varchar',
                    'constraint' => 1,
                    'null' => true
                ),
                'Religion' => array(
                    'type' => 'varchar',
                    'constraint' => 150,
                    'null' => true
                ),
                'Address' => array(
                    'type' => 'varchar',
                    'constraint' => 250,
                    'null' => true
                ),
                'Telephone' => array(
                    'type' => 'varchar',
                    'constraint' => 16,
                    'null' => true
                ),
                'Worker_Status' => array(
                    'type' => 'INT',
                    'constraint' => 1
                ),

                'IOn' => array(
                    'type' => 'datetime',
                    'null' => true
                ),
                'IBy' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => true
                ),
                'UOn' => array(
                    'type' => 'datetime',
                    'null' => true
                ),
                'UBy' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => true
            )
            ));
            $this->dbforge->add_key('Id', TRUE);
            $this->dbforge->create_table('m_worker');
            $this->db->query(add_foreign_key('m_worker', 'ClassId', 'm_kelas(Id)', 'RESTRICT', 'CASCADE'));
        }

        }


    public function down() {
        //$this->dbforge->drop_table('create_m_teacher_table20181207153900');
    }

}