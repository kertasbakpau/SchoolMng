<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menum_model extends CI_Model {

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_enumdetail', $id);
        $this->db->where('EnumId', $id);
        $this->db->order_by('Ordering');
        $query = $this->db->get();
        return $query->result();
    }
}