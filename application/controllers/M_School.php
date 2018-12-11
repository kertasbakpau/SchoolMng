<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_School extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->load->database('natureuser', TRUE);
        $this->load->model(array('Mschool_model','Mgroupuser_model'));
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        //echo json_encode($_SESSION);
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_school'],'Read'))
        {
            $page = 1;
            $search = "";
            if(!empty($_GET["page"]))
            {
                $page = $_GET["page"];
            }
            if(!empty($_GET["search"]))
            {
                $search = $_GET["search"];
            }

            $pagesize 	= $this->paging->get_config();
            $resultdata = $this->Mschool_model->get_alldata();
            $datapages 	= $this->Mschool_model->get_datapages($page,  $pagesize['perpage'], $search);
            
            $rows 		= !empty($search) ? count($datapages) : count($resultdata);

            $resource 	= $this->Mschool_model->set_resources();

            $data 		=  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_school/index', $data);
        }
       else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Write'))
        {
            $resource 	= $this->Mschool_model->set_resources();
            $model 		= $this->Mschool_model->create_object(null, null,null, null, null, null, null, null, null);
            $data 		=  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_school/add', $data);   
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function addsave()
    {
        //$date = new DateTime();
        $warning 	    = array();
        $err_exist 	    = false;
        $resource 	    = $this->Mschool_model->set_resources();
        $namasekolah    = $this->input->post('named');
        $alamat 	    = $this->input->post('addres');
        //echo  $username;
        $model  	= $this->Mschool_model->create_object(null, $namasekolah, $alamat, null, null, null, null);
        $modeltabel = $this->Mschool_model->create_object_tabel(null, $namasekolah, $alamat, null, null, null , null);

        $validate 	= $this->Mschool_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_school/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $modeltabel['ion'] = $date;
            $modeltabel['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mschool_model->save_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschool');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Write'))
        {
            $resource 	= $this->Mschool_model->set_resources();
            $edit 		= $this->Mschool_model->get_data_by_id($id);
            $model 		= $this->Mschool_model->create_object($edit->Id, $edit->NamaSekolah, $edit->Alamat, null, null, null, null);
            $data 		=  $this->paging->set_data_page_edit($resource, $model);
            //echo json_encode($edit);
            $this->loadview('m_school/edit', $data);   
        }
        else{
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function editsave()
    {
        $resource 	    = $this->Mschool_model->set_resources();
        $userid 	    = $this->input->post('userid');
        $namasekolah 	= $this->input->post('named');
        $alamat 	    = $this->input->post('addres');

        $edit 		= $this->Mschool_model->get_data_by_id($userid);
        $model 		= $this->Mschool_model->create_object($edit->Id, $namasekolah,  $alamat, $edit->IOn, $edit->IBy, null , null);
        $oldmodel 	= $this->Mschool_model->create_object($edit->Id, $edit->NamaSekolah,  $edit->Alamat, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);
        $modeltabel = $this->Mschool_model->create_object_tabel($edit->Id, $namasekolah, $alamat, $edit->IOn, $edit->IBy, null , null);


        $validate = $this->Mschool_model->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_school/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['username'];

            $this->Mschool_model->edit_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('m_school');
        }
    }

    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Delete'))
        {
            $delete = $this->Mschool_model->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('m_school');
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }   
    }

    public function activate($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_user'],'Write'))
        {
            $this->Muser_model->activate_data($id);
            redirect('muser');
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }   
    }


    private function loadview($viewName, $data)
	{
		$this->paging->load_header();
		$this->load->view($viewName, $data);
		$this->paging->load_footer();
    }

}

/* End of file M_School.php */
/* Location: ./application/controllers/M_School.php */