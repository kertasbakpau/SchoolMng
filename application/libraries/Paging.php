<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paging {

    public function get_config()
    {
        $data["perpage"] = 10;
        $data["perpagemodal"] = 5;
        $data["pagelen"] = 5;
        return $data;
    }

    public function get_form_name_id()
    {
        $data["m_school"] = 1;
        $data["m_kelas"] = 2;
        $data["m_groupuser"] = 3;
        $data["m_user"] = 4;
        $data["m_schoolyear"] = 5;
        $data["m_mapel"] = 6;
        return $data;
    }

    public function get_enum_name()
    {
        $data["months"] = 1;
        $data["gender"] = 2;
        $data["religion"] = 3;
        return $data;
    }

    public function load_header()
    {

        $CI =& get_instance();
        $resource = $this->set_resources_header_page();
        $CI->load->model(array("Mform_model"));
        $mastermenu = $CI->Mform_model->get_data_by_classname("Master");

        $data['resource'] = $resource;
        $data['mastermenu'] = $mastermenu;

        $CI->load->view('template/header', $data); 
    }

    public function load_footer()
    {
        $CI =& get_instance();
        $CI->load->view('template/footer');
    }

    public function set_resources_forbidden_page()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        $resource['res_page_forbidden'] = $CI->lang->line('ui_page_forbidden');
        $resource['res_contact_your_admin'] = $CI->lang->line('ui_contact_your_admin');
        return $resource;
    }

    public function set_resources_maintenance_page()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        $resource['res_page_maintenance'] = $CI->lang->line('ui_page_maintenance');
        return $resource;
    }

    private function set_resources_header_page()
    {
        
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        
        $resource['res_warning'] = $CI->lang->line('ui_warning');
        $resource['res_success'] = $CI->lang->line('ui_success');
        $resource['res_danger'] = $CI->lang->line('ui_danger');
        $resource['res_info'] = $CI->lang->line('ui_info');
        $resource['res_want_delete'] = $CI->lang->line('ui_want_delete');
        $resource['res_cancel'] = $CI->lang->line('ui_cancel');
        $resource['res_confirm'] = $CI->lang->line('ui_confirm');

        $resource['res_general'] = $CI->lang->line('ui_general');
        $resource['res_disaster'] = $CI->lang->line('ui_disaster');
        $resource['res_groupuser'] = $CI->lang->line('ui_groupuser');
        $resource['res_user'] = $CI->lang->line('ui_user');
        $resource['res_logout'] = $CI->lang->line('ui_logout');
        $resource['res_changepassword'] = $CI->lang->line('ui_changepassword');
        $resource['res_province'] = $CI->lang->line('ui_province');
        $resource['res_city'] = $CI->lang->line('ui_city');
        $resource['res_village'] = $CI->lang->line('ui_village');
        $resource['res_subcity'] = $CI->lang->line('ui_subcity');
        $resource['res_familycard'] = $CI->lang->line('ui_familycard');
        $resource['res_animal'] = $CI->lang->line('ui_animal');
        $resource['res_barrack'] = $CI->lang->line('ui_barrack');
        $resource['res_transaction'] = $CI->lang->line('ui_transaction');
        $resource['res_disaster_occur'] = $CI->lang->line('ui_disaster_occur');
        $resource['res_receiveitem'] = $CI->lang->line('ui_receiveitem');
        $resource['res_inventory'] = $CI->lang->line('ui_inventory');
        $resource['res_item'] = $CI->lang->line('ui_item');
        $resource['res_master_item'] = $CI->lang->line('ui_master_item');
        $resource['res_uom'] = $CI->lang->line('ui_uom');
        $resource['res_master_uom'] = $CI->lang->line('ui_master_uom');
        $resource['res_warehouse'] = $CI->lang->line('ui_warehouse');
        $resource['res_sitestatus'] = $CI->lang->line('ui_sitestatus');
        $resource['res_class'] = $CI->lang->line('ui_class');
        $resource['res_school'] = $CI->lang->line('ui_school');
        $resource['res_schoolyear'] = $CI->lang->line('ui_schoolyear');

        $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/US.png');
        if($_SESSION['language']['language'] === 'indonesia'){
            $resource['flag'] = base_url('assets/bootstrapdashboard/img/flags/16/ID.png');;
        }

        return $resource;
    }

    public function is_session_set()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->model(array('Login_model'));
        //$sitestatus = $CI->Gsitestatus_model->get_alldata();
        //if(isset($sitestatus) && $sitestatus->Status == 2){
            //echo json_encode($sitestatus);
            if(isset($_SESSION['userdata']))
            {
                //redirect('home');
            }
            else
            {
                redirect('login');
            }
        // }
        // else{
        //     //echo json_encode($sitestatus);
        //     //echo json_encode("aaa");
        //     //$data['resource'] = $CI->paging->set_resources_forbidden_page();
        //     if(isset($_SESSION['userdata']) && $_SESSION['userdata']['username'] !== "superadmin")
        //         redirect('maintenance');
        // }
        
    }

    public function set_data_page_add($resource, $model = null, $enums = null)
    {
        $data['resource'] = $resource;
        $data['model'] = $model;
        $data['enums'] = $enums;
        return $data;
    }

    public function set_data_page_edit($resource, $model = null, $enums = null)
    {
        $data['resource'] = $resource;
        $data['model'] = $model;
        $data['enums'] = $enums;
        return $data;
    }

    public function is_superadmin($user)
    {
        $permited = false;
        if($user == "superadmin")
        {
            $permited = true;
        }
        return $permited;
    }

    public function set_data_page_index($resource, $modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $pagesize = null)
    {
        $config = $this->get_config();
        $pagesz = $config['perpage']; //5 or whatever
        if(!empty($pagesize))
        {
            $pagesz = $pagesize;
        }
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        if($totalrow)
        {
            $totalpage = ceil($totalrow / $pagesz);
            if($totalpage > $config["pagelen"])
            {
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        } else {
            
            $firstpage = 0;
            $lastpage = 0;
        }

        $data['modelheader'] = $modelheader;
        $data['modeldetail'] = $modeldetail;
        $data['totalrow'] = $totalrow;
        $data['totalpage'] = $totalpage;
        $data['currentpage'] = (int)$currentpage;
        $data['firstpage'] = $firstpage;
        $data['lastpage'] = $lastpage;
        $data['search'] = $search;
        $data['resource'] = $resource;
        return $data;
    }

    public function get_success_message(){
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        $msg = array();

        $msg = array_merge($msg, array(0=>$CI->lang->line('ui_datasaved')));
        return $msg;
    }

    public function get_delete_message(){
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->lang->load('form_ui', $_SESSION['language']['language']);

        $msg = array();

        $msg = array_merge($msg, array(0=>$CI->lang->line('ui_datadeleted')));
        return $msg;
    }

    public function set_data_page_modal($resource, $modeldetail, $totalrow = null, $currentpage = 0, $search = null, $modelheader = null, $tabelname = null)
    {
        $config = $this->get_config();
        $totalpage = 0;
        $firstpage = 1;
        $lastpage = 3;
        if($totalrow)
        {
            $totalpage = ceil($totalrow / $config['perpagemodal']);
            if($totalpage > $config["pagelen"])
            {
                //$firstpage = $page - 2;
                $lastpage = $currentpage + 2;
                if($lastpage > $totalpage)
                {
                    $lastpage = $totalpage;
                    if($lastpage - $config['pagelen'] < 0)
                    {
                        $firstpage = 1;
                    }
                    else
                    {
                        $firstpage = $totalpage - $config['pagelen'] + 1;;
                    }
                }
                else{
                    //$lastpage = $config['pagelen'];
                    if($lastpage < $config['pagelen'])
                    {
                        $firstpage = 1;
                        $lastpage = $config['pagelen'];
                    }
                    else{
                        if($currentpage >= $totalpage - 2)
                        {
                            $firstpage = $totalpage - $config['pagelen'] + 1;
                            $lastpage = $totalpage;
                        }
                        else
                        {
                            $firstpage = $lastpage - $config['pagelen'] + 1;
                        }
                    }
                }
            }
            else{
                $lastpage = $totalpage;
            }
        } else {
            
            $firstpage = 0;
            $lastpage = 0;
        }

        $data[$tabelname]['modelheadermodal'] = $modelheader;
        $data[$tabelname]['modeldetailmodal'] = $modeldetail;
        $data[$tabelname]['totalrowmodal'] = $totalrow;
        $data[$tabelname]['totalpagemodal'] = $totalpage;
        $data[$tabelname]['currentpagemodal'] = (int)$currentpage;
        $data[$tabelname]['firstpagemodal'] = $firstpage;
        $data[$tabelname]['lastpagemodal'] = $lastpage;
        $data[$tabelname]['searchmodal'] = $search;
        $data[$tabelname]['resourcemodal'] = $resource;
        return $data;
    }

}