<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mstudent_model','Mgroupuser_model'));
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper(array('form','helpers'));
        $this->paging->is_session_set();
    }

    public function index()
    {
        // your index goes here
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_student'],'Read'))
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
            $resultdata = $this->Mstudent_model->get_alldata();
            $datapages = $this->Mstudent_model->get_datapages($page,  $pagesize['perpage'], $search);
            
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->Mstudent_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            //echo json_encode($resource);
            $this->loadview('m_student/index', $data);
        }
       else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function add()
    {   
        // your add method goes here
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_student'],'Write'))
        {
            $resource = $this->Mstudent_model->set_resources();
            $model = $this->Mstudent_model->create_object();
            $data = $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_student/add', $data);   
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function addsave()
    {   
        // your addsave method goes here
        $warning    = array();
        $resource   = $this->Mstudent_model->set_resources();

        $nis    = $this->input->post('nis');
        $name   = $this->input->post('named');
        $address  = $this->input->post('address');
        $placeofbirth  = $this->input->post('placeofbirth');
        $dateofbirth  = date("Y-m-d H:i:s", strtotime($this->input->post('dateofbirth')));
        $mothername   = $this->input->post('mothername');
        $fathername   = $this->input->post('fathername');
        $yearofstudy   = $this->input->post('yearofstudy');

        $model  = $this->Mstudent_model->create_object(null,$nis, $name, $address, $placeofbirth, $dateofbirth, $mothername, $fathername, $yearofstudy, null, null, null, null);
        $modeltabel = $this->Mstudent_model->create_object_tabel(null,$nis, $name, $address, $placeofbirth, $dateofbirth, $mothername, $fathername, $yearofstudy, null, null, null, null);

        $validate = $this->Mstudent_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_student/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $modeltabel['ion'] = $date;
            $modeltabel['iby'] = $_SESSION['userdata']['username'];
    
            $this->Mstudent_model->save_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mstudent');
        }
    }

    public function edit($id)
    {   
        // your edit method goes here
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_student'],'Write'))
        {
            $resource = $this->Mstudent_model->set_resources();
            $edit = $this->Mstudent_model->get_data_by_id($id);
            $model = $this->Mstudent_model->create_object($edit->Id, $edit->Nis, $edit->Name, $edit->Address, $edit->PlaceOfBirth, 
            formatDateString($edit->DateOfBirth), $edit->MotherName, $edit->FatherName,$edit->YearOfStudy, $edit->IOn, $edit->IBy, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            //echo json_encode($edit);
            $this->loadview('m_student/edit', $data);   
        }
        else{
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function editsave()
    {   
        // your editsave method goes here
        $resource   = $this->Mstudent_model->set_resources();

        $studentid = $this->input->post('idstudent');
        $nis    = $this->input->post('nis');
        $name   = $this->input->post('named');
        $address  = $this->input->post('address');
        $placeofbirth  = $this->input->post('placeofbirth');
        $dateofbirth  = date("Y-m-d H:i:s", strtotime($this->input->post('dateofbirth')));
        $mothername   = $this->input->post('mothername');
        $fathername   = $this->input->post('fathername');
        $yearofstudy   = $this->input->post('yearofstudy');

        $edit       = $this->Mstudent_model->get_data_by_id($studentid);
        $model      = $this->Mstudent_model->create_object($edit->Id, $nis, $name, $address, $placeofbirth, $dateofbirth, $mothername, $fathername, $yearofstudy, $edit->IOn, $edit->IBy, null , null);
        $oldmodel   = $this->Mstudent_model->create_object($edit->Id, $edit->Nis, $edit->Name, $edit->Address, $edit->PlaceOfBirth, 
                        formatDateString($edit->DateOfBirth), $edit->MotherName, $edit->FatherName,$edit->YearOfStudy, $edit->IOn, $edit->IBy, null, null);
        
        $modeltabel = $this->Mstudent_model->create_object_tabel($edit->Id, $nis, $name, $address, $placeofbirth, $dateofbirth, $mothername, $fathername, $yearofstudy, $edit->IOn, $edit->IBy, null , null);

        $validate   = $this->Mstudent_model->validate($model, $oldmodel);
 
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_user/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $modeltabel['uon'] = $date;
            $modeltabel['uby'] = $_SESSION['userdata']['username'];

            $this->Mstudent_model->edit_data($modeltabel);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mstudent');
        }
    }

    public function delete($id){
        // your delete method goes here
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_student'],'Delete'))
        {
            $delete = $this->Mstudent_model->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('mstudent');
        }
        else
        {   
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        } 

    }

    private function loadview($viewName, $data)
	{
        // your load view method goes here
		$this->paging->load_header();
		$this->load->view($viewName, $data);
        $this->paging->load_footer();
    } 

}