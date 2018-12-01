<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_schoolyear extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model(array('Mschoolyear_model', 'Mgroupuser_model'));
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        //echo $_SESSION['userdata']['username'];
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['id'],$form['m_schoolyear'],'Read'))
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

            $pagesize = $this->paging->get_config();
            $resultdata = $this->Mschoolyear_model->get_alldata();
            $datapages = $this->Mschoolyear_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mschoolyear_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_schoolyear/index', $data);
        }
        else
        {   $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function schoolyearmodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->Mschoolyear_model->get_alldata();
        $datapages = $this->Mschoolyear_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->Mschoolyear_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_schoolyear');      
        
        echo json_encode($data);
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['id'],$form['m_schoolyear'],'Write'))
        {
            $resource = $this->Mschoolyear_model->set_resources();
            $model = $this->Mschoolyear_model->create_object(null, null, null, null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_schoolyear/add', $data);  
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
        $warning = array();
        $err_exist = false;
        $resource = $this->Mschoolyear_model->set_resources();
        $name = $this->input->post('named');
        
        $model = $this->Mschoolyear_model->create_object(null, $name, null, null, null, null);

        $validate = $this->Mschoolyear_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_schoolyear/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mschoolyear_model->save_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschoolyear');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['id'],$form['m_schoolyear'],'Write'))
        {
            $resource = $this->Mschoolyear_model->set_resources();
            $edit = $this->Mschoolyear_model->get_data_by_id($id);
            $model = $this->Mschoolyear_model->create_object($edit->Id, $edit->Nama, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_schoolyear/edit', $data);  
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        } 
    }

    public function editsave()
    {
        $resource = $this->Mschoolyear_model->set_resources();

        $name = $this->input->post('named');

        $edit = $this->Mschoolyear_model->get_data_by_id($this->input->post('id'));
        $model = $this->Mschoolyear_model->create_object($edit->Id, $name, $edit->IOn, $edit->IBy, null , null);
        $oldmodel = $this->Mschoolyear_model->create_object($edit->Id, $edit->Nama, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);

        $validate = $this->Mschoolyear_model->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_schoolyear/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $model['uon'] = $date;
            $model['uby'] = $_SESSION['userdata']['username'];

            $this->Mschoolyear_model->edit_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mschoolyear');
        }
    }

    
    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['id'],$form['m_schoolyear'],'Delete'))
        {
            $delete = $this->Mschoolyear_model->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('mschoolyear');
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