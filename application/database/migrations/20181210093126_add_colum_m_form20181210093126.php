<?php

class Migration_add_colum_m_form20181210093126 extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        
        if ($this->db->table_exists('m_form')){
            if (!$this->db->field_exists('Resource', 'm_form'))
            {
                $fields = array(
                    'Resource' => array(
                        'type' => 'Varchar',
                        'constraint' => 50,
                        'null' => true
                    )
                );
                $this->dbforge->add_column('m_form', $fields);
            }

            if (!$this->db->field_exists('IndexRoute', 'm_form'))
            {
                $fields = array(
                    'IndexRoute' => array(
                        'type' => 'Varchar',
                        'constraint' => 50,
                        'null' => true
                    )
                );
                $this->dbforge->add_column('m_form', $fields);
            }
        }
    }

    public function down() {
        //$this->dbforge->drop_table('add_colum_m_form20181210093126');
    }

}