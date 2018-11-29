<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model('Mkelas_model');
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        //echo $_SESSION['userdata']['username'];
        $form = $this->paging->get_form_name_id();
        if($this->Mkelas_model->is_permitted($_SESSION['userdata']['id'],$form['m_kelas'],'Read'))
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
            $resultdata = $this->Mkelas_model->get_alldata();
            $datapages = $this->Mkelas_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mkelas_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_kelas/index', $data);
        }
        else
        {   $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function kelasmodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->Mkelas_model->get_alldata();
        $datapages = $this->Mkelas_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->Mkelas_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_kelas');      
        
        echo json_encode($data);
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mkelas_model->is_permitted($_SESSION['userdata']['id'],$form['m_kelas'],'Write'))
        {
            $resource = $this->Mkelas_model->set_resources();
            $model = $this->Mkelas_model->create_object(null, null, null, null, null,  null);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_kelas/add', $data);  
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
        $resource = $this->Mkelas_model->set_resources();
        $name = $this->input->post('named');
        
        $model = $this->Mkelas_model->create_object(null, $name, null, null, null, null);

        $validate = $this->Mkelas_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_kelas/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mkelas_model->save_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mkelas');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mkelas_model->is_permitted($_SESSION['userdata']['id'],$form['m_kelas'],'Write'))
        {
            $resource = $this->Mkelas_model->set_resources();
            $edit = $this->Mkelas_model->get_data_by_id($id);
            $model = $this->Mkelas_model->create_object($edit->Id, $edit->Nama, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_kelas/edit', $data);  
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        } 
    }

    public function editsave()
    {
        $resource = $this->Mkelas_model->set_resources();

        $name = $this->input->post('named');

        $edit = $this->Mkelas_model->get_data_by_id($this->input->post('id'));
        $model = $this->Mkelas_model->create_object($edit->Id, $name, $edit->IOn, $edit->IBy, null , null);
        $oldmodel = $this->Mkelas_model->create_object($edit->Id, $edit->Nama, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);

        $validate = $this->Mkelas_model->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_kelas/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $model['uon'] = $date;
            $model['uby'] = $_SESSION['userdata']['username'];

            $this->Mkelas_model->edit_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mkelas');
        }
    }

    
    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mkelas_model->is_permitted($_SESSION['userdata']['id'],$form['m_kelas'],'Delete'))
        {
            $delete = $this->Mkelas_model->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('mkelas');
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