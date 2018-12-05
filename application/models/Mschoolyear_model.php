<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mschoolyear_model extends CI_Model {

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
        $query = $this->db->get('m_schoolyear');
        return $query->result();
    }

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_schoolyear');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }

    public function get_datapages($page, $pagesize, $search = null)
    {
        
        $this->db->select('*');
        $this->db->from('m_schoolyear');
        if(!empty($search))
        {
            $this->db->like('Name', $search);
        }
        $this->db->order_by('IOn','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();

    }

    public function save_data($data)
    {
        $this->db->insert('m_schoolyear', $data);
    }

    public function edit_data($data)
    {
        $this->db->where('Id', $data['id']);
        $this->db->update('m_schoolyear', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('Id', $id);
        if(!$this->db->delete('m_schoolyear')){
            return $this->db->error();
        }
        else{
            return;
        }
    }

    public function create_object($id, $name, $fromyear, $toyear, $monthstart, $isactive, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'name' => $name,
            'fromyear' => $fromyear,
            'toyear' => $toyear,
            'monthstart' => $monthstart,
            'isactive' => $isactive,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function create_object_tabel($id, $name, $fromyear, $toyear, $monthstart, $isactive, $ion, $iby, $uon, $uby)
    {
        $data = array(
            'id' => $id,
            'name' => $name,
            'fromyear' => $fromyear,
            'toyear' => $toyear,
            'monthstart' => $monthstart,
            'isactive' => $isactive,
            'ion' => $ion,
            'iby' => $iby,
            'uon' => $uon,
            'uby' => $uby,
        );

        return $data;
    }

    public function is_data_exist($name = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_schoolyear');
        $this->db->where('Name', $name);
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
        $resource['res_master_schoolyear'] = $this->lang->line('ui_master_schoolyear');
        $resource['res_schoolyear'] = $this->lang->line('ui_schoolyear');
        $resource['res_isactive'] = $this->lang->line('ui_isactive');
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
        $resource['res_fromyear'] = $this->lang->line('ui_fromyear');
        $resource['res_toyear'] = $this->lang->line('ui_toyear');
        $resource['res_monthstart'] = $this->lang->line('ui_monthstart');   
        $resource['res_january'] = $this->lang->line('ui_january');   
        $resource['res_february'] = $this->lang->line('ui_february');   
        $resource['res_march'] = $this->lang->line('ui_march');   
        $resource['res_april'] = $this->lang->line('ui_april');   
        $resource['res_may'] = $this->lang->line('ui_may');   
        $resource['res_june'] = $this->lang->line('ui_june');   
        $resource['res_july'] = $this->lang->line('ui_july');   
        $resource['res_august'] = $this->lang->line('ui_august');   
        $resource['res_september'] = $this->lang->line('ui_september');   
        $resource['res_october'] = $this->lang->line('ui_october');    
        $resource['res_november'] = $this->lang->line('ui_november');   
        $resource['res_december'] = $this->lang->line('ui_december'); 

        $resource['res_err_name_exist'] = $this->lang->line('err_msg_name_exist');
        $resource['res_msg_group_name_can_not_null'] = $this->lang->line('err_msg_name_can_not_null');

        return $resource;
    }
    
}