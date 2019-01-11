<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mschedule_model extends CI_Model{

	public $id;
	public $hari;
	public $jamMulai;
	public $jamAkhir;
	public $mapel;
	public $guru;
	public $ion;
	public $iby;
	public $uon;
	public $uby;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Mgroupuser_model');
		$this->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));
		$this->lang->load('err_msg', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $this->config->item('language'));

	}


	public function get_alldata()
	{
		return $this->db->get('m_schedule')->result();
	}

	public function save_data($data)
	{
		$this->db->insert('m_schedule', $data);
	}

	public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('m_schedule');
        $this->db->where('Id', $id);
        $query = $this->db->get();
        return $query->row(); // a single row use row() instead of result()
    }


    public function get_datapages($page, $pagesize, $search = null)
    {  
        // your datapages
        $this->db->select('a.*, b.NamaMapel, c.Name, d.Nama');
        $this->db->from('m_schedule as a');
        $this->db->join('m_mapel as b', 'a.Mapel=b.Id');
        $this->db->join('m_worker as c', 'a.Guru=c.Id');
        $this->db->join('m_kelas as d', 'a.kelas=d.Id', 'left');

        // Query Di bahwa Juga Bisa
        // $this->db->select('*');
        // $this->db->from('m_schedule');
        // $this->db->join('m_mapel','m_schedule.Mapel=m_mapel.Id');

        if(!empty($search))
        {
            $this->db->like('Hari', $search);
        }
        $this->db->order_by('a.Hari','ASC');
        $this->db->limit($pagesize, ($page-1)*$pagesize);
        $query = $this->db->get();

        return $query->result();
    }






	public function create_object($id, $hari, $jamMulai, $jamAkhir, $mapel, $kelas, $guru, $ion, $iby, $uon, $uby)
	{
		$data = array(
			'id' 		=> $id,
			'hari'		=> $hari,
			'jamMulai'	=> $jamMulai,
			'jamAkhir'	=> $jamAkhir,
			'mapel'		=> $mapel,
			'kelas' 	=> $kelas,
			'guru'		=> $guru,
			'ion' 		=> $ion,
            'iby' 		=> $iby,
            'uon' 		=> $uon,
            'uby' 		=> $uby,
		);
		return $data;
	}

	public function create_model_table($id, $hari, $jamMulai, $jamAkhir, $mapel, $kelas, $guru, $ion, $iby, $uon, $uby)
	{
		$data = array(
			'id' 		=> $id,
			'hari'		=> $hari,
			'jamMulai'	=> $jamMulai,
			'jamAkhir'	=> $jamAkhir,
			'mapel'		=> $mapel,
			'kelas' 	=> $kelas,
			'guru'		=> $guru,
			'ion' 		=> $ion,
            'iby' 		=> $iby,
            'uon' 		=> $uon,
            'uby' 		=> $uby,
		);
		return $data;
	}



	public function is_data_exist($name = null)
    {
        $exist = false;
        $this->db->select('*');
        $this->db->from('m_school');
        $this->db->where('NamaSekolah', $name);
        $query = $this->db->get();

        $row = $query->result();
        if(count($row) > 0){
            $exist = true;
        }
        return $exist;
    }

    public function jam_tabrakan($hari, $jamMulai)
    {
    	$jTabrak = false;
    	$this->db->select('*');
        $this->db->from('m_schedule');
        $this->db->where('Hari', $hari);
        $this->db->where('JamMulai', $jamMulai);
        $query = $this->db->get();

        $row = $query->result();
    	if(count($row)>0)
    	{
    		$jTabrak = true;
    	}
    	return $jTabrak;
    }

    public function guru_tabrakan($hari, $jamMulai, $guru)
    {
    	$gTabrak = false;
    	$this->db->select('*');
        $this->db->from('m_schedule');
        $this->db->where('Hari', $hari);
        $this->db->where('JamMulai', $jamMulai);
        $this->db->where('Guru', $guru);
        $query = $this->db->get();

        $row = $query->result();
    	if(count($row)>0)
    	{
    		$gTabrak = true;
    	}
    	return $gTabrak;
    }

    public function kelas_tabrakan($hari, $jamMulai, $kelas)
    {
    	$kTabrak = false;
    	$this->db->select('*');
        $this->db->from('m_schedule');
        $this->db->where('Hari', $hari);
        $this->db->where('JamMulai', $jamMulai);
        $this->db->where('Kelas', $kelas);
        $query = $this->db->get();

        $row = $query->result();
    	if(count($row)>0)
    	{
    		$gTabrak = true;
    	}
    	return $gTabrak;
    }



    	public function validate($model, $oldmodel = null)
		    {
		        $nameexist = false;
		        $kTabrakan = false;
		        $gTabrakan = false;
		        $warning = array();
		        $resource = $this->set_resources();
		        if(!empty($oldmodel))
		        {
		            if($model['hari'] != $oldmodel['hari'])
		            {
		                $nameexist = $this->is_data_exist($model['hari']);
		            }
		        }
		        else
		        {
		            if(!empty($model['hari']['jamMulai']['kelas']))
		            {
		                $kTabrakan = $this->kelas_tabrakan($model['hari'], $model['jamMulai'], $model['kelas']);
		            }
		            // elseif (!empty($model['hari']['jamMulai']['kelas'])) 
		            // {
		            // 	$gtabrakan = $this->guru_tabrakan($model['hari'], $model['jamMulai'], $model['guru']);
		            // }
		            else
		            {
		                $warning = array_merge($warning, array(0=>$resource['res_msg_name_can_not_null']));
		            }
		        }
		        if($nameexist)
		        {
		            $warning = array_merge($warning, array(0=>$resource['res_err_name_exist']));
		        }
		        if($kTabrakan)
		        {
		            $warning = array_merge($warning, array(0=>$resource['err_msg_teacher_can_not_same']));
		        }
		        if($gTabrakan)
		        {
		            $warning = array_merge($warning, array(0=>$resource['err_msg_teacher_can_not_same']));
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
        $resource['res_msg_name_can_not_null'] = $this->lang->line('err_msg_name_can_not_null');


        $resource['res_master_schedule']	= $this->lang->line('ui_master_schedule');
        $resource['res_day']	= $this->lang->line('ui_day');
        // $resource['res_sunday']	= $this->lang->line('ui_sunday');
        $resource['res_monday']		= $this->lang->line('ui_monday');
        $resource['res_tuesday']	= $this->lang->line('ui_tuesday');
        $resource['res_wednesday']	= $this->lang->line('ui_wednesday');
        $resource['res_thursday']	= $this->lang->line('ui_thursday');
        $resource['res_friday']		= $this->lang->line('ui_friday');
        $resource['res_saturday']	= $this->lang->line('ui_saturday');

        $resource['res_start_time']	= $this->lang->line('ui_start_time');
        $resource['res_end_time']	= $this->lang->line('ui_end_time');
        $resource['res_subject']	= $this->lang->line('ui_subject');
        $resource['res_class']		= $this->lang->line('ui_class');
        $resource['res_teacher']	= $this->lang->line('ui_teacher');
        $resource['res_time']		= $this->lang->line('ui_time');

        $resource['err_msg_time_can_not_same'] 		= $this->lang->line('err_msg_time_can_not_same');
        $resource['err_msg_teacher_can_not_same'] 	= $this->lang->line('err_msg_teacher_can_not_same');


        return $resource;
    }



}

/* End of file Mschedule_model.php */
/* Location: ./application/models/Mschedule_model.php */