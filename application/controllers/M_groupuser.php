<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_groupuser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model('Mgroupuser_model');
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
        //echo $_SESSION['userdata']['username'];
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Read'))
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
            $resultdata = $this->Mgroupuser_model->get_alldata();
            $datapages = $this->Mgroupuser_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mgroupuser_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_groupuser/index', $data);
        }
        else
        {   $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function groupusermodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->Mgroupuser_model->get_alldata();
        $datapages = $this->Mgroupuser_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->Mgroupuser_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_groupuser');      
        
        echo json_encode($data);
    }

    public function add()
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Write'))
        {
            $resource = $this->Mgroupuser_model->set_resources();
            $model = $this->Mgroupuser_model->create_object(null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_groupuser/add', $data);  
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
        $resource = $this->Mgroupuser_model->set_resources();
        $name = $this->input->post('named');
        $description = $this->input->post('description');
        
        $model = $this->Mgroupuser_model->create_object(null, $name, $description, null, null, null, null);

        $validate = $this->Mgroupuser_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_groupuser/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mgroupuser_model->save_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mgroupuser');
        }
    }

    public function edit($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Write'))
        {
            $resource = $this->Mgroupuser_model->set_resources();
            $edit = $this->Mgroupuser_model->get_data_by_id($id);
            $model = $this->Mgroupuser_model->create_object($edit->Id, $edit->GroupName, $edit->Description, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_groupuser/edit', $data);  
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        } 
    }

    public function editsave()
    {
        $resource = $this->Mgroupuser_model->set_resources();

        $name = $this->input->post('named');
        $description = $this->input->post('description');

        $edit = $this->Mgroupuser_model->get_data_by_id($this->input->post('idgroupuser'));
        $model = $this->Mgroupuser_model->create_object($edit->Id, $name, $description, $edit->IOn, $edit->IBy, null , null);
        $oldmodel = $this->Mgroupuser_model->create_object($edit->Id, $edit->GroupName, $edit->Description, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);

        $validate = $this->Mgroupuser_model->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_groupuser/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $model['uon'] = $date;
            $model['uby'] = $_SESSION['userdata']['username'];

            $this->Mgroupuser_model->edit_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mgroupuser');
        }
    }

    public function editrole($groupid)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Write'))
        {
            $modelheader = $this->Mgroupuser_model->get_data_by_id($groupid);
            $modeldetail = $this->Mgroupuser_model->get_role($groupid);
            $resource = $this->Mgroupuser_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $modeldetail, null, null, null, $modelheader);
            
            $this->loadview('m_groupuser/roles', $data); 
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        } 
    }

    public function saverole()
    {
        $formid = $this->input->post("formid");
        $groupid = $this->input->post("groupid");
        $read = $this->input->post("read");
        $write = $this->input->post("write");
        $delete = $this->input->post("delete");
        $print = $this->input->post("print");
        $data = $this->Mgroupuser_model->create_object_role_tabel($groupid, $formid, $read, $write, $delete, $print);

        $this->Mgroupuser_model->save_role($data);
        //echo $data;
    }

    public function delete($id)
    {
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Delete'))
        {
            $delete = $this->Mgroupuser_model->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('mgroupuser');
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