<?php

class Migration_create_m_student_table20181207034011 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $this->dbforge->add_field(array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'Nis' => array(
                'type' => 'varchar',
                'constraint' => 50,
            ),
            'Name' => array(
                'type' => 'varchar',
                'constraint' => 300,
            ),
            'Address' => array(
                'type' => 'varchar',
                'constraint' => 300,
            ),
            'PlaceOfBirth' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'DateOfBirth' => array(
                'type' => 'Datetime',
            ),
            'MotherName' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'FatherName' => array(
                'type' => 'varchar',
                'constraint' => 100,
            ),
            'YearOfStudy' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
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
        $this->dbforge->create_table('m_student');
    }

    public function down() {
        $this->dbforge->drop_table('m_student');
    }

}