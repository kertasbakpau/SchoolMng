<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MWorker_model extends CI_Model {

    public $id;
    public $classid;
    public $nip;
    public $name;
    public $place_of_birth;
    public $date_of_birth;
    public $gender;
    public $religion;
    public $address;
    public $telephone;
    public $work_status;
    public $ion;
    public $iby;
    public $uon;
    public $uby;

    public function __construct(){
                parent::__construct();
        $this->load->library('session');
        $this->load->library('paging');
        $this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
        $this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
    }

    public function get_alldata(){
        // get all data
        $query = $this->db->get('m_worker');
        return $query->result();
    }

     public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_worker');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }


    public function get_datapages($page, $pagesize, $search = null){  
        // your datapages
        $this->db->select('*');
        $this->db->from('m_worker');
        if(!empty($search))
        {
            $this->db->like('Name', $search);
        }
        $this->db->order_by('Ion','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();
    }

    public function save_data($data){  
        // your save data
        $this->db->insert('m_worker', $data);
    }

    public function edit_data($data){  
        // your edit data
        $this->db->where('Id', $data['id']);
        $this->db->update('m_worker', $data);
    }

    public function delete_data($id){
        // delete data
        $this->db->where('Id', $id);
        if(!$this->db->delete('m_worker')){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function create_object($id, $classid, $nip, $name,$place_of_birth, $date_of_birth,$gender, $religion, $address, $telephone, $work_status, $ion, $iby, $uon, $uby){
        // create object goes here
        $data = array(
            'id' => $id,
            'classid' => $classid,
            'nip' => $nip,
            'name' => $name,
            'place_of_birth' => $place_of_birth,
            'date_of_birth' => $date_of_birth,
            'gender' => $gender,
            'religion' => $religion,
            'address' => $address,
            'telephone' => $telephone,
            'work_status' => $work_status,
            'ion' => $ion,
            'iby' => $iby,
            'ion' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

public function is_data_exist($name = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_worker');
        $this->db->where('Name', $name);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    function getClass(){
        $query = $this->db->query('SELECT * FROM m_kelas');
        return $query->result();
    }


    public function validate($model, $oldmodel = null)
    {
        $nameexist = false;
        $warning = array();
        $resource = $this->set_resources();
        if(!empty($oldmodel))
        {
            if($model['name'] != $oldmodel['name'])
            {
                $nameexist = $this->is_data_exist($model['name']);
            }
        }
        else{
            if(!empty($model['name']))
            {
                $nameexist = $this->is_data_exist($model['name']);
            }
            else{
                $warning = array_merge($warning, array(0=>$resource['res_msg_name_can_not_null']));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>$resource['res_err_name_exist']));
        }
        
        return $warning;
    }

        
    public function set_resources()
    {
        $resource['res_master_worker'] = $this->lang->line('ui_master_worker');
        $resource['res_groupuser'] = $this->lang->line('ui_groupuser');
        $resource['res_data'] =  $this->lang->line('ui_data');
        $resource['res_add'] =  $this->lang->line('ui_add');
        $resource['res_classid'] =$this->lang->line('ui_classid');
        $resource['res_nip'] =$this->lang->line('ui_nip');
        $resource['res_name'] =$this->lang->line('ui_name1');
        $resource['res_place_of_birth'] =$this->lang->line('ui_place_of_birth');
        $resource['res_place_of_birth1'] =$this->lang->line('ui_place_of_birth1');
        $resource['res_date_of_birth'] =$this->lang->line('ui_date_of_birth');
        $resource['res_gender'] =$this->lang->line('ui_gender');
        $resource['res_religion'] =$this->lang->line('ui_religion');
        $resource['res_address'] =$this->lang->line('ui_address');
        $resource['res_telephone'] =$this->lang->line('ui_telephone');
        $resource['res_work_status'] = $this->lang->line('ui_work_status');
        $resource['res_male'] = $this->lang->line('ui_male');
        $resource['res_female'] = $this->lang->line('ui_female');
        $resource['res_islam'] = $this->lang->line('ui_islam');
        $resource['res_kristen'] = $this->lang->line('ui_kristen');
        $resource['res_katholik'] = $this->lang->line('ui_katholik');
        $resource['res_hindu'] = $this->lang->line('ui_hindu');
        $resource['res_budha'] = $this->lang->line('ui_budha');
        $resource['res_none'] = $this->lang->line('ui_none');
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