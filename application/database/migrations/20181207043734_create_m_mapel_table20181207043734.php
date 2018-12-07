<?php

class Migration_create_m_mapel_table20181207043734 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'KodeMapel'=> array(
                'type'          => 'varchar',
                'constraint'    => 15,
            ),
            'NamaMapel'=> array(
                'type'          => 'varchar',
                'constraint'    => 100,
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
        $this->dbforge->create_table('m_mapel');
    }

    public function down() {
        $this->dbforge->drop_table('m_mapel');
    }

}