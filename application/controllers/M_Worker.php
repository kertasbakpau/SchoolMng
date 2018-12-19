<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Worker extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model(array('MWorker_model','Mgroupuser_model','Menum_model'));
        $this->load->library(array('paging', 'session','helpers'));
        $this->load->helper('form');
        $this->paging->is_session_set();
    }

    public function index()
    {
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
            $resultdata = $this->MWorker_model->get_alldata();
            $datapages = $this->MWorker_model->get_datapages($page,  $pagesize['perpage'], $search);
            $rows = !empty($search) ? count($datapages) : count($resultdata);

            $resource = $this->MWorker_model->set_resources();

            $data =  $this->paging->set_data_page_index($resource, $datapages, $rows, $page, $search);
            
            $this->loadview('m_worker/index', $data);
        }
        else
        {   $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        }
    }

    public function workermodal()
    {
        $page = $this->input->post("page");
        $search = $this->input->post("search");

        $pagesize = $this->paging->get_config();
        $resultdata = $this->MWorker_model->get_alldata();
        $datapages = $this->MWorker_model->get_datapages($page,  $pagesize['perpagemodal'], $search);
        $rows = !empty($search) ? count($datapages) : count($resultdata);

        $resource = $this->MWorker_model->set_resources();

        $data =  $this->paging->set_data_page_modal($resource, $datapages, $rows, $page, $search, null, 'm_worker');      
        
        echo json_encode($data);
    }

    public function add()
    {   
        // your add method goes here
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Write'))
        {
            $enum =  $this->paging->get_enum_name();
            $enums['genderenum'] = $this->Menum_model->get_data_by_id($enum['gender']);
            $enums['religionenum'] = $this->Menum_model->get_data_by_id($enum['religion']);
            $enums['workstatusenum'] = $this->Menum_model->get_data_by_id($enum['WorkStatus']);
            $resource = $this->MWorker_model->set_resources();
            $model = $this->MWorker_model->create_object(null, null, null, null, null,  null, null, null, null, null, null, null, null, null, null);
            $data =  $this->paging->set_data_page_add($resource, $model,$enums);

            $data['Nama'] = $this->MWorker_model->getClass();
            $this->loadview('m_worker/add', $data);  
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
        $warning = array();
        $err_exist = false;
        $resource = $this->MWorker_model->set_resources();

        $classid = $this->input->post('classid');
        $nip = $this->input->post('nip');
        $name = $this->input->post('name');
        $place_of_birth = $this->input->post('place_of_birth');
        $date_of_birth = $this->input->post('date_of_birth');
        $gender = $this->input->post('gender');
        $religion = $this->input->post('religion');
        $address = $this->input->post('address');
        $telephone = $this->input->post('telephone');
        $work_status = $this->input->post('worker_status');
        $model = $this->MWorker_model->create_object(null, $classid, $nip, $name,$place_of_birth, $date_of_birth, $gender, $religion, $address, $telephone, $work_status, null, null, null, null);

        $validate = $this->MWorker_model->validate($model);
 
        if($validate)
        {
            $this->session->set_flashdata('add_warning_msg',$validate);
            $data =  $this->paging->set_data_page_add($resource, $model);
            $this->loadview('m_worker/add', $data);   
        }
        else{
            $date = date("Y-m-d H:i:s");
            $model['ion'] = $date;
            $model['iby'] = $_SESSION['userdata']['username'];
    
            $this->MWorker_model->save_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mworker');
        }
    }

    public function edit($id)
    {   
        // your edit method goes here
        $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Write'))
        {
            $resource = $this->MWorker_model->set_resources();
            $edit = $this->MWorker_model->get_data_by_id($id);
            $model = $this->MWorker_model->create_object($edit->Id, $edit->ClassId,$edit->NIP,$edit->Name,$edit->Place_of_birth,$edit->Date_of_birth,$edit->Gender,$edit->Religion,$edit->Address,$edit->Telephone,$edit->Worker_Status, null, null, null, null);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_worker/edit', $data);  
        }
        else
        {
            $data['resource'] = $this->paging->set_resources_forbidden_page();
            $this->load->view('forbidden/forbidden', $data);
        } 
    }

    public function editsave()
    {   
        // your editsave method goes here
        $resource = $this->MWorker_model->set_resources();

        $classid = $this->input->post('classid');
        $nip = $this->input->post('nip');
        $name = $this->input->post('name');
        $place_of_birth = $this->input->post('place_of_birth');
        $date_of_birth = $this->input->post('date_of_birth');
        $gender = $this->input->post('gender');
        $religion = $this->input->post('religion');
        $address = $this->input->post('address');
        $telephone = $this->input->post('telephone');
        $work_status = $this->input->post('work_status');

        $edit = $this->MWorker_model->get_data_by_id($this->input->post('id'));
        $model = $this->MWorker_model->create_object($edit->Id, $classid,$nip,$name,$place_of_birth,$date_of_birth,$gender,$religion,$address,$telephone,$work_status, $edit->IOn, $edit->IBy, null , null);
        $oldmodel = $this->MWorker_model->create_object($edit->Id, $edit->ClassId,$edit->NIP,$edit->Name,$edit->Place_of_Birth,$edit->Date_of_Birth,$edit->Gender,$edit->Religion,$edit->Address,$edit->Telephone,$edit->Work_Status, $edit->IOn, $edit->IBy, $edit->UOn , $edit->UBy);

        $validate = $this->MWorker_model->validate($model, $oldmodel);
        if($validate)
        {
            $this->session->set_flashdata('edit_warning_msg',$validate);
            $data =  $this->paging->set_data_page_edit($resource, $model);
            $this->loadview('m_worker/edit', $data);   
        }
        else
        {
            $date = date("Y-m-d H:i:s");
            $model['uon'] = $date;
            $model['uby'] = $_SESSION['userdata']['username'];

            $this->MWorker_model->edit_data($model);
            $successmsg = $this->paging->get_success_message();
            $this->session->set_flashdata('success_msg', $successmsg);
            redirect('mworker');
        }
    }

    public function delete($id){
        // your delete method goes here
                $form = $this->paging->get_form_name_id();
        if($this->Mgroupuser_model->is_permitted($_SESSION['userdata']['groupid'],$form['m_groupuser'],'Delete'))
        {
            $delete = $this->MWorker_model->delete_data($id);
            if(isset($delete)){
                $deletemsg = $this->helpers->get_query_error_message($delete['code']);
                $this->session->set_flashdata('warning_msg', $deletemsg);
            } else {
                $deletemsg = $this->paging->get_delete_message();
                $this->session->set_flashdata('delete_msg', $deletemsg);
            }
            redirect('mworker');
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