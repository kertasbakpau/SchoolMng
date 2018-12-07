<?php

class Migration_create_m_accesrole_view extends CI_Migration {

    public function up() {
        $this->load->helper('db_helper');
        $sql = "CREATE OR REPLACE VIEW view_m_accessrole
                as
                select a.Id AS GroupId,
                    b.Id AS FormId, 
                    b.FormName AS FormName,
                    b.AliasName AS AliasName,
                    b.LocalName AS LocalName,
                    ifnull(c.Read,0) AS Readd,
                    ifnull(c.Write,0) AS Writee,
                    ifnull(c.Delete,0) AS Deletee,
                    ifnull(c.Print,0) AS Printt,
                    b.ClassName AS ClassName,
                    0 AS Header
                from ((school_management.m_groupuser a join school_management.m_form b) 
                left join school_management.m_accessrole c on(((c.FormId = b.Id) 
                    and (c.GroupId = a.Id)))) 
                union all 
                select distinct NULL,
                    NULL,
                    NULL,
                    school_management.m_form.ClassName AS ClassName,
                    NULL,
                    NULL,
                    NULL,
                    NULL,
                    NULL,
                    school_management.m_form.ClassName AS ClassName,
                    1 AS Header 
                from school_management.m_form order by 10,11";
        $query = $this->db->query($sql);
    }

    public function down() {
        //$this->dbforge->drop_table('create_m_accesrole_view');
    }

}