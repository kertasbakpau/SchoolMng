<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mstudent_model extends CI_Model {

    public function __construct(){
        parent::__construct();$this->load->library('session');
        $this->load->library('paging');
        $this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
    }

    public function get_alldata(){
        // get all data
        $query = $this->db->get('m_student');
        return $query->result();
    }

    public function get_data_by_id($id){  
        // get data by primary key
        $this->db->select('*');
        $this->db->from('m_student');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_datapages($page, $pagesize, $search = null){  
        // your datapages
        $this->db->select('*');
        $this->db->from('m_student');
        if(!empty($search))
        {
            $this->db->like('Name', $search);
        }
        $this->db->order_by('IOn','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();
    }

    public function save_data($data){  
        // your save data
        $this->db->insert('m_student', $data);
    }

    public function edit_data($data){  
        // your edit data
        $this->db->where('Id', $data['id']);
        $this->db->update('m_student', $data);
    }

    public function delete_data($id){
        // delete data
        $this->db->where('Id', $id);
        if(!$this->db->delete('m_student')){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function create_object($id = null, $nis = null , $name = null, $address = null, $placeofbirth = null,
    $dateofbirth = null, $mothername = null, $fathername = null, $yearofstudy = null,
    $ion = null, $iby = null, $uon = null, $uby = null){
        // create object goes here
        $data = array(
            "id" => $id,
            "nis" => $nis,
            "name" => $name,
            "address" => $address,
            "placeofbirth" => $placeofbirth,
            "dateofbirth" => $dateofbirth,
            "mothername" => $mothername,
            "fathername" => $fathername,
            "yearofstudy" => $yearofstudy,
            "ion" => $ion,
            "iby" => $iby,
            "uon" => $uon,
            "uby" => $uby
        );
        return $data;
    }

    public function create_object_tabel($id = null, $nis = null , $name = null, $address = null, $placeofbirth = null,
    $dateofbirth = null, $mothername = null, $fathername = null, $yearofstudy = null,
    $ion = null, $iby = null, $uon = null, $uby = null){
        //create object goes here
        $data = array(
            "id" => $id,
            "nis" => $nis,
            "name" => $name,
            "address" => $address,
            "placeofbirth" => $placeofbirth,
            "dateofbirth" => $dateofbirth,
            "mothername" => $mothername,
            "fathername" => $fathername,
            "yearofstudy" => $yearofstudy,
            "ion" => $ion,
            "iby" => $iby,
            "uon" => $uon,
            "uby" => $uby
        );
        return $data;
    }

    public function is_data_exist($nis = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_student');
        $this->db->where('Nis', $name);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function validate($model, $oldmodel = null){
        //validate goes here
        $nameexist = false;
        $warning = array();
        $resource = $this->set_resources();
        if(!empty($oldmodel))
        {
            if($model['nis'] != $oldmodel['nis'])
            {
                $nameexist = $this->is_data_exist($model['nis']);
            }
        }
        else{
            if(!empty($model['nis']))
            {
                $nameexist = $this->is_data_exist($model['nis']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_nis_can_not_null']));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>$resource['res_err_nis_exist']));
        }
        
        if(!isset($model['name']))
            $warning = array_merge($warning, array(0=>$resource['res_msg_name_can_not_null']));
        
        return $warning;
    }

    public function set_resources(){
        // resource language goes here
        $resource['res_master_student'] = $this->lang->line('ui_master_student');
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
        $resource['res_nis'] = $this->lang->line('ui_nis');
        $resource['res_dateofbirth'] = $this->lang->line('ui_dateofbirth');
        $resource['res_placeofbirth'] = $this->lang->line('ui_placeofbirth');
        $resource['res_address'] = $this->lang->line('ui_address');
        $resource['res_mothername'] = $this->lang->line('ui_mothername');
        $resource['res_fathername'] = $this->lang->line('ui_fathername');
        $resource['res_yearofstudy'] = $this->lang->line('ui_yearofstudy');

        $resource['res_err_nis_exist'] = $this->lang->line('err_msg_nis_exist');
        $resource['res_msg_nis_can_not_null'] = $this->lang->line('err_msg_nis_can_not_null');
        $resource['res_msg_name_can_not_null'] = $this->lang->line('err_msg_name_can_not_null');
        return $resource;
    }

}