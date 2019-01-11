<?php

class Migration_create_m_schedule_table20190101043513 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Hari' => array(
                'type' => 'int',
                'constraint' => 1
            ),
            'JamMulai' => array (
                'type' => 'Varchar',
                'constraint' => 5
            ),
            'JamAkhir' => array (
                'type' => 'Varchar',
                'constraint' => 5
            ),
            'Mapel' => array (
                'type' => 'int',
                'constraint' => 2
            ),
            'Kelas' =>array(
                'type' => 'int',
                'constraint' => 3
            ),
            'Guru' => array(
                'type' => 'int',
                'constraint' => 3
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
        $this->dbforge->create_table('m_schedule');
    }

    public function down() {
        $this->dbforge->drop_table('m_schedule');
    }

}