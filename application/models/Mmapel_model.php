<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmapel_model extends CI_Model {
	public $id;
	public $kodemapel;
	public $namamapel;
	public $ion;
	public $iby;
	public $uon;
	public $uby;


	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Mgroupuser_model');
		$this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
	}

	public function get_alldata(){
		$query 	= $this->db->get('m_mapel');
		return $query->result();
	}

	public function get_datapages($page, $pagesize, $search=null){
		$this->db->select('*');
		$this->db->from('m_mapel');
		if(!empty($search))
		{
			$this->db->like('Username', $search);
		}

		$this->db->order_by('KodeMapel', 'ASC');
		$this->db->limit($pagesize, ($page-1)*$pagesize);
		$query = $this->db->get();
		return $query->result();
	}


	public function create_object($id, $kodemapel, $namamapel, $ion, $iby, $uon, $uby ){
		$data = array(
			'id' 		=> $id,
			'kodemapel'	=> $kodemapel,
			'namamapel'	=> $namamapel,
			'ion' 		=> $ion,
			'iby' 		=> $iby,
			'uon'		=> $uon,
			'uby'		=> $uby
		);
		return $data;
	}

	public function create_object_table($id, $kodemapel, $namamapel, $ion, $iby, $uon, $uby){

		$data = array(
			'id' 		=> $id,
			'kodemapel' => $kodemapel,
			'namamapel' => $namamapel,
			'ion'		=> $ion, 
			'iby' 		=> $iby,
			'uon'		=> $uon,
			'uby'		=> $uby
		);

		return $data;
	}

	public function save_data($data){
		$this->db->insert('m_mapel', $data);
	}

	public function is_data_exist($kodemapel=null){
		$exist 	= false;
		$this->db->select('*');
		$this->db->from('m_mapel');
		$this->db->where('KodeMapel', $kodemapel);
		$query = $this->db->get();

		$row = $query->result();
		if(count($row)>0){
			$exist = true;
		}
		return $exist;
	}

	public function validate($model, $oldmodel=null){
		$nameexist 	= false;
		$warning 	= array();
		$resource 	= $this->set_resources();

		if(!empty($oldmodel))
		{
			if($model['kodemapel'] != $oldmodel['kodemapel'])
			{
				$nameexist = $this->is_data_exist($model['kodemapel']);
			}
		}
		else
		{
			if(!empty($model['kodemapel']))
			{
				$nameexist = $this->is_data_exist($model['kodemapel']);
			}
			else
			{
				$warning = array_merge($warning, array(0=>$resource['res_msg_name_can_not_null']));
			}
		}

		if($nameexist)
			$warning = array_merge($warning, array(0=>$resource['res_err_name_exist']));
		if(empty($model['namamapel']))
			$warning = array_merge($warning, array(0=>$resource['res_password_can_not_null']));

		return $warning;
	}


	public function delete_data($id){
		$this->db->where('Id', $id);
		if(!$this->db->delete('m_mapel')){
			return $this->db->error();
		}
		else
		{
			return;
		}
	}

	public function get_data_by_id($id){
		$this->db->select('*');
		$this->db->from('m_mapel');
		$this->db->where('Id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function edit_data($data){
		$this->db->where('Id', $data['id']);
		$this->db->update('m_mapel', $data);
	}

	 public function set_resources()
    {
        $resource['res_master_school'] = $this->lang->line('ui_master_school');
        $resource['res_user'] = $this->lang->line('ui_user');
        $resource['res_group_user'] = $this->lang->line('ui_group_user');
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
        $resource['res_changepassword'] = $this->lang->line('ui_changepassword');
        $resource['res_password'] = $this->lang->line('ui_password');
        $resource['res_oldpassword'] = $this->lang->line('ui_oldpassword');
        $resource['res_newpassword'] = $this->lang->line('ui_newpassword');
        $resource['res_confirmpassword'] = $this->lang->line('ui_confirmpassword');
        $resource['res_isactive'] = $this->lang->line('ui_isactive');
        $resource['res_deactivate'] = $this->lang->line('ui_deactivate');
        $resource['res_activate'] = $this->lang->line('ui_activate');   

        $resource['res_err_name_exist'] = $this->lang->line('err_msg_name_exist');
        $resource['res_msg_name_can_not_null'] = $this->lang->line('err_msg_name_can_not_null');
        $resource['res_wrong_password'] = $this->lang->line('err_wrong_password');
        $resource['res_wrong_confirmed_password'] = $this->lang->line('err_wrong_confirmed_password');
        $resource['res_groupuser_can_not_null'] = $this->lang->line('err_msg_groupuser_can_not_null');
        $resource['res_password_can_not_null'] = $this->lang->line('err_msg_password_can_not_null');

        $resource['res_master_subject']	= $this->lang->line('ui_master_subject');
        $resource['res_subject_code']	= $this->lang->line('ui_subject_code');
        $resource['res_subject']		= $this->lang->line('ui_subject');

        return $resource;
    }
	

}

/* End of file Mmapel_model.php */
/* Location: ./application/models/Mmapel_model.php */