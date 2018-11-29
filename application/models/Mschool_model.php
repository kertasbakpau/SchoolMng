<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mschool_model extends CI_Model {


	var $table="m_school";

	public $id;
    public $namasekolah; //groupname
    public $alamat; //description
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


    public function get_alldata(){
    	return $this->db->get($this->table)->result();
    }

    public function get_data_by_id($id){
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$this->db->where('Id', $id);
    	$query = $this->db->get();
    	return $query->row();
    }

    public function get_datapages($page, $pagesize, $search=null){
    	$this->db->select('*');
    	$this->db->from($this->table);
    	if(!empty($search)){
    		$this->db->like('namasekolah', $search);
    	}
    	$this->db->order_by('IOn', 'ASC');
    	$this->db->limit($pagesize, ($page-1)*$pagesize);
    	$query = $this->db->get();

    	return $query->result();
    }


    public function get_role($groupid){
    	$this->db->select('*');
    	$this->db->form('view_m_accessrole');
    	$this->db->where('GroupId', $groupid);
        $this->db->or_where('GroupId', null);
        $this->db->order_by('ClassName', 'ASC');
        $this->db->order_by('Header', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }

    public function save_data($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update($this->table, $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        if(!$this->db->delete($this->table)){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function save_role($data)
    {
        $this->db->select('*');
        $this->db->from('m_accessrole');
        $this->db->where('GroupId', $data['groupid']);
        $this->db->where('FormId', $data['formid']);
        $query = $this->db->get()->row();
        if($query)
        {
            $this->db->where('GroupId', $data['groupid']);
            $this->db->where('FormId', $data['formid']);
            $this->db->update('m_accessrole', $data);
        }
        else
        {
            $this->db->insert('m_accessrole', $data);
        }
    }

    public function create_object($id, $namasekolah, $alamat, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'NamaSekolah' => $namasekolah,
            'Alamat' => $alamat,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function create_object_role_tabel($groupid, $formid, $read, $write, $delete, $print)
    {
        $data = array(
            'groupid' => $groupid,
            'formid' => $formid,
            'read' => $read,
            'write' => $write,
            'delete' => $delete,
            'print' => $print
        );

        return $data;
    }

    public function create_object_role($groupid, $formid, $formname, $aliasname, $read, $write, $delete, $print)
    {
        $data = array(
            'groupid' => $groupid,
            'formid' => $formid,
            'formname' => $formname,
            'aliasname' => $aliasname,
            'read' => $read,
            'write' => $write,
            'delete' => $delete,
            'print' => $print
        );

        return $data;
    }

    public function is_data_exist($namasekolah = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('NamaSekolah', $namasekolah);
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
            if($model['namasekolah'] != $oldmodel['namasekolah'])
            {
                $nameexist = $this->is_data_exist($model['namasekolah']);
            }
        }
        else{
            if(!empty($model['namasekolah']))
            {
                $nameexist = $this->is_data_exist($model['namasekolah']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_group_name_can_not_null']));
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
        $resource['res_master_groupuser'] = $this->lang->line('ui_master_groupuser');
        $resource['res_groupuser'] = $this->lang->line('ui_groupuser');
        $resource['res_data'] =  $this->lang->line('ui_data');
        $resource['res_add'] =  $this->lang->line('ui_add');
        $resource['res_name'] =$this->lang->line('ui_name');
        $resource['res_alamat'] = $this->lang->line('ui_alamat');
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
        $resource['res_msg_group_name_can_not_null'] = $this->lang->line('err_msg_namasekolah_can_not_null');

        return $resource;
    }

















}

/* End of file Mschool.php */
/* Location: ./application/models/Mschool.php */{}