<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mkelas_model extends CI_Model {
    public $id;
    public $nama;
    public $ion;
    public $iby;
    public $uon;
    public $uby;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('paging');
        $this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
    }
    
    public function get_alldata()
    {
        $query = $this->db->get('m_kelas');
        return $query->result();
    }

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_kelas');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }

    public function get_datapages($page, $pagesize, $search = null)
    {
        
        $this->db->select('*');
        $this->db->from('m_kelas');
        if(!empty($search))
        {
            $this->db->like('Nama', $search);
        }
        $this->db->order_by('Ion','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

    }


    public function save_data($data)
    {
        $this->db->insert('m_kelas', $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('m_kelas', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        if(!$this->db->delete('m_kelas')){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function create_object($id, $nama, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'ion' => $ion,
            'iby' => $iby,
            'ion' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function is_data_exist($nama = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_kelas');
        $this->db->where('Nama', $nama);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null)
    {
        $nameexist = false;
        $warning = array();
        $resource = $this->set_resources();
        if(!empty($oldmodel))
        {
            if($model['nama'] != $oldmodel['nama'])
            {
                $nameexist = $this->is_data_exist($model['nama']);
            }
        }
        else{
            if(!empty($model['nama']))
            {
                $nameexist = $this->is_data_exist($model['nama']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_nama_can_not_null']));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>$resource['res_err_name_exist']));
        }
        
        return $warning;
    }

        

public function has_role($groupid, $formid, $role)
    {
        $permitted = false;
        $this->db->select('*');
        $this->db->from('m_accessrole');
        $this->db->where('GroupId', $groupid);
        $this->db->where('FormId', $formid);
        $this->db->where($role, 1);
        $query = $this->db->get();
        $result = $query->row();
        if($result)
        {
            $permitted = true;
        }

        return $permitted;
    }


public function is_permitted($groupid = null, $formid = null, $role = null)
    {
        $permitted = false;
        if($this->paging->is_superadmin($_SESSION['userdata']['username'])
            ||  $this->has_role($groupid,$formid,$role)
        )
        {
            $permitted = true;
        }
        return $permitted;
    }

    public function set_resources()
    {
        $resource['res_master_kelas'] = $this->lang->line('ui_master_kelas');
        $resource['res_groupuser'] = $this->lang->line('ui_groupuser');
        $resource['res_data'] =  $this->lang->line('ui_data');
        $resource['res_add'] =  $this->lang->line('ui_add');
        $resource['res_name'] =$this->lang->line('ui_name');
        $resource['res_description'] = $this->lang->line('ui_description');
        $resource['res_edit'] = $this->lang->line('ui_edit');
        $resource['res_delete'] =$this->lang->line('ui_delete');
        $resource['res_search'] = $this->lang->line('ui_search');
        $resource['res_save'] = $this->lang->line('ui_save');
        $resource['res_add_data'] = $this->lang->line('ui_add_data');
        $resource['res_edit_data'] = $this->lang->line('ui_edit_data');
        $resource['res_role'] = $this->lang->line('ui_role');
        $resource['res_read'] = $this->lang->line('ui_read');
        $resource['res_write'] = $this->lang->line('ui_write');
        $resource['res_print'] = $this->lang->line('ui_print');
        $resource['res_module'] = $this->lang->line('ui_module');

        $resource['res_err_name_exist'] = $this->lang->line('err_msg_name_exist');
        $resource['res_msg_nama_can_not_null'] = $this->lang->line('err_msg_nama_can_not_null');

        return $resource;
    }
    
}