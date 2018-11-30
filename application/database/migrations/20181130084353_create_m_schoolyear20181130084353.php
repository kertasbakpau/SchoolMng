<?php

class Migration_create_m_schoolyear20181130084353 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Name' => array(
                'type' => 'VARCHAR',
                'constraint' => 50
            ),
            'FromYear' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'ToYear' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'MonthStart' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
            'IsActive' => array(
                'type' => 'TINYINT',
                'constraint' => 11
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
        $this->dbforge->create_table('m_schoolyear');
    }

    public function down() {
        $this->dbforge->drop_table('m_schoolyear');
    }

}