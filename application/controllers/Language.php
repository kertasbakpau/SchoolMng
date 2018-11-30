<?php
class Language extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->database('naturedisaster', TRUE);
        $this->load->model(array('Muser_model'));
        $this->load->library('session');

    }

    public function change_language()
    {
        $language = "english";
        if(!empty($_GET['language']))
        {
            $language = array(
                'language' => $_GET['language']
            );
            $this->session->set_userdata("language", $language);
            $this->Muser_model->changeLanguage($_SESSION['userdata']['username'], $_GET['language']);
        }

        redirect(base_url('home'));
    }
}