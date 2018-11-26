<?php

class Migration_create_m_from_table extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'FormName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'AliasName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'LocalName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
            'ClassName' => array(
                'type' => 'varchar',
                'constraint' => 100
            ),
        ));
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table('m_form');
    }

    public function down() {
        $this->dbforge->drop_table('m_form');
    }

}