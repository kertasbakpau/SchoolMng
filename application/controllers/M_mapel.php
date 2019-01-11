<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mapel extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('Mmapel_model', 'Mgroupuser_model'));
		$this->load->library(array('paging', 'session', 'helpers'));
		$this->load->helper('form');
		$this->paging->is_session_set();
	}

	public function index()
	{
		$form = $this->paging->get_form_name_id();
		if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_mapel'],'Read'))
		{
			$page 	= 1;
			$search = "";
			if(!empty($_GET["page"]))
			{
				$page	= $_GET["page"];
			}
			if(!empty($_GET["search"]))
			{
				$search = $_GET["search"];
			}

			$pagesize 	= $this->paging->get_config();
			$resuldata 	= $this->Mmapel_model->get_alldata();
			$datapages 	= $this->Mmapel_model->get_datapages($page, $pagesize['perpage'], $search);

			$rows 		= !empty($search) ? count($datapages) : count($resuldata);
			$resource 	= $this->Mmapel_model->set_resources();
			$data 		= $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
			$this->loadview('m_mapel/index', $data);
		}
		else
		{
			$data['resource'] = $this->paging->set_resources_forbidden_page();
			$this->load->view('forbidden/forbidden', $data);
		}
	}


	public function add(){
		$form = $this->paging->get_form_name_id();
		if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'], $form['m_user'], 'Write'))
		{
			$resource 	= $this->Mmapel_model->set_resources();
			$model 		= $this->Mmapel_model->create_object(null, null, null, null, null, null, null);
			$data 		= $this->paging->set_data_page_add($resource, $model);
			$this->loadview('m_mapel/add', $data);
		}
		else
		{
			$data['resource'] = $this->paging->set_resources_forbidden_page();
			$this->load->view('forbidden/forbidden', $data);
		}
	}

	public function addsave(){
		$warning 	= array();
		$err_exist	= false;
		$resource 	= $this->Mmapel_model->set_resources();
		$kodemapel	= $this->input->post('subject_code');
		$namamapel 	= $this->input->post('subject');

		$model 		= $this->Mmapel_model->create_object(null, $kodemapel, $namamapel, null, null, null, null);
		$modeltable = $this->Mmapel_model->create_object_table(null, $kodemapel, $namamapel, null, null, null, null);
		$validate 	= $this->Mmapel_model->validate($model);

		if($validate)
		{
			$this->session->set_flashdata('add_warning_msg', $validate);
			$data = $this->paging->set_data_page_add($resource, $model);
			$this->loadview('m_mapel/add', $data);
		}
		else
		{
			$date 	= date("Y-m-d H:i:s");
			$modeltable['ion'] 	= $date;
			$modeltable['iby'] 	= $_SESSION['userdata']['username'];

			$this->Mmapel_model->save_data($modeltable);
			$successmsg = $this->paging->get_success_message();
			$this->session->set_flashdata('success_msg', $successmsg);
			redirect('m_mapel');
		}


	}


	public function delete($id){
		$form = $this->paging->get_form_name_id();
		if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'], $form['m_mapel'], 'Delete'))
		{
			$delete 	= $this->Mmapel_model->delete_data($id);
			if(isset($delete)){
				$deletemsg = $this->helper->get_query_error_message($delete['code']);
				$this->session->set_flashdata('warning_msg', $deletemsg);
			}
			else
			{
				$deletemsg = $this->paging->get_delete_message();
				$this->session->set_flashdata('delete_msg', $deletemsg);
			}
			redirect('m_mapel');
		}
		else
		{
			$data['resource'] 	= $this->paging->set_resources_forbidden_page();
			$this->load->view('forbidden/forbidden', $data);
		}
	}

	public function edit($id){
		$form = $this->paging->get_form_name_id();
		if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'], $form['m_mapel'], 'Write'))
		{
			$resource 	= $this->Mmapel_model->set_resources();
			$edit 		= $this->Mmapel_model->get_data_by_id($id);
			$model 		= $this->Mmapel_model->create_object($edit->Id, $edit->KodeMapel, $edit->NamaMapel, null, null, null, null);
			$data 		= $this->paging->set_data_page_edit($resource, $model);

			$this->loadview('m_mapel/edit', $data);
		}
		else
		{
			$data['resource'] = $this->paging->set_resources_forbidden_page();
			$this->load->view('forbidden/forbidden', $data);
		}

	}

	public function editsave(){
		$resource 	= $this->Mmapel_model->set_resources();
		$userid 	= $this->input->post('userid');
		$kodemapel 	= $this->input->post('subjectcode');
		$namamapel 	= $this->input->post('subject');

		$edit 		= $this->Mmapel_model->get_data_by_id($userid);
		$model 		= $this->Mmapel_model->create_object($userid, $kodemapel, $namamapel, null, null, null, null);
		$oldmodel 	= $this->Mmapel_model->create_object($edit->Id, $edit->KodeMapel, $edit->NamaMapel, $edit->IOn, $edit->IBy, $edit->UOn, $edit->UBy);
		$modeltabel = $this->Mmapel_model->create_object_table($edit->Id, $kodemapel, $namamapel, $edit->IOn, $edit->IBy, null, null);

		$validate = $this->Mmapel_model->validate($model, $oldmodel);
		if($validate)
		{
			$this->session->set_flashdata('edit_warning_msg', $validate);
			$data = $this->paging->set_data_page_edit($resource, $model);
			$this->loadview('m_mapel/edit', $data);
		}
		else
		{
			$date = date("Y-m-d H:i:s");
			$modeltabel['uon'] 	= $date;
			$modeltabel['uby'] 	= $_SESSION['userdata']['username'];

			$this->Mmapel_model->edit_data($modeltabel);
			$successmsg = $this->paging->get_success_message();
			$this->session->set_flashdata('success_msg', $successmsg);
			redirect('m_mapel');
		}
	}



	public function mapelModal()
	{
		$page 		= $this->input->post("page");
		$search 	= $this->input->post("search");

		$pagesize 	= $this->paging->get_config();
		$resultdata = $this->Mmapel_model->get_alldata();
		$datapages 	= $this->Mmapel_model->get_datapages($page, $pagesize['perpagemodal'], $search);
		$rows 		= !empty($search) ? count($datapages) : count($resultdata);

		$resource 	= $this->Mmapel_model->set_resources();

		$data 		= $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_mapel');

		echo json_encode($data);

	}




	private function loadview($viewName, $data){
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
	}




}

/* End of file M_mapel.php */
/* Location: ./application/controllers/M_mapel.php */