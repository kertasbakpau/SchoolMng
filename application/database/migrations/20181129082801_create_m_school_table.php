<?php

class Migration_create_m_school_table extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        if (!$this->db->table_exists('m_school')){
            $this->dbforge->add_field(array(
                'Id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => TRUE
                ),
                'NamaSekolah' => array(
                    'type'          => 'varchar',
                    'constraint'    => 150
                ),
                'Alamat'    =>array(
                    'type'          =>'varchar',
                    'constraint'    => 300
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
            $this->dbforge->create_table('m_school');
        }
    }

    public function down() {
        // $this->dbforge->drop_table('m_school');
    }

}