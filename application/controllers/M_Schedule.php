<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

class M_Schedule extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Mschedule_model','Mgroupuser_model','Menum_model'));
		$this->load->library(array('paging','session', 'helpers'));
		$this->load->helpers('form');
		$this->paging->is_session_set();
	}

	public function index()
	{
		$form = $this->paging->get_form_name_id();
		if($this->Mgroupuser_model->is_permitted($_SESSION['userdata'] ['groupid'], $form['m_school'], 'Read'))
		{
			$page	= 1 ;
			$search = '' ;
			if(!empty($_GET['page']))
			{
				$page = $_GET['page'];
			}
			if(!empty($_GET['search']))
			{
				$search = $_GET['get'];
			}

			$pagesize 	= $this->paging->get_config();
			$resultdata	= $this->Mschedule_model->get_alldata();
			$datapages 	= $this->Mschedule_model->get_datapages($page, $pagesize['perpage'], $search);
			
			$rows		= !empty($search) ? count($datapages) : count($resultdata);
			$resource 	= $this->Mschedule_model->set_resources();

			$data 		= $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);

			$this->loadview('m_schedule/index', $data);
		}
		else
		{
			$data['resource'] = $this->paging->set_resource_forbidden_page();
			$this->loadview('forbidden/forbidden', $data);
		}
	}


	public function add()
	{
		$form = $this->paging->get_form_name_id();
		if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Write'))
		{
			$enum 					= $this->paging->get_enum_name();
            $enums['daysEnums'] 	= $this->Menum_model->get_data_by_id($enum['Days']);
            $enums['genderEnums'] 	= $this->Menum_model->get_data_by_id($enum['gender']);
			$resource 				= $this->Mschedule_model->set_resources();
			$model 					= $this->Mschedule_model->create_object(null, null, null, null, null,null, null, null, null, null, null);
			$data 					= $this->paging->set_data_page_add($resource, $model, $enums);
			$this->loadview('m_schedule/add', $data);
		}
		else
		{
			$data['resource'] 	= $this->paging->set_resource_forbidden_page();
			$this->loadview('forbidden/forbidden', $data);
		}

	}


	public function addSave()
	{

		$warning 	= array();
		$err_exist 	= false;
		$resource 	= $this->Mschedule_model->set_resources();
		$hari		= $this->input->post('hari');
		$jamMulai	= $this->input->post('jamMulai');
		$jamAkhir 	= $this->input->post('jamAkhir');
		$mapel		= $this->input->post('mapel');
		$kelas		= $this->input->post('kelas');
		$guru		= $this->input->post('guru');


		$model 		= $this->Mschedule_model->create_object(null, $hari, $jamMulai, $jamAkhir, $mapel, $kelas, $guru, null, null, null, null);
		$modeltable	= $this->Mschedule_model->create_model_table(null, $hari, $jamMulai, $jamAkhir, $mapel, $kelas, $guru, null, null, null, null);

		$validate	= $this->Mschedule_model->validate($model);

		if($validate)
		{
			$this->session->set_flashdata('add_warning_msg', $validate);
			$enum 					= $this->paging->get_enum_name();
			$enums['daysEnums'] 	= $this->Menum_model->get_data_by_id($enum['Days']);
			$data 	= $this->paging->set_data_page_add($resource, $model, $enums);
			$this->loadview('m_schedule/add', $data);
		}
		else
		{

			$date 				= date('Y-m-d H:i:s');
			$modeltable['ion']	= $date;
			$modeltable['iby'] 	= $_SESSION['userdata']['username'];

			$this->Mschedule_model->save_data($modeltable);
			$successmsg 	= $this->paging->get_success_message();
			$this->session->set_flashdata('success_msg', $successmsg);
			redirect('m_schedule');
		}

	}



	private function loadview($viewName, $data)
	{
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
	}




}
/* End of file M_Schedule.php */
/* Location: ./application/controllers/M_Schedule.php */