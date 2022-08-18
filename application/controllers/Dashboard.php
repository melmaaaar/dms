<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		//Load User Models
		$this->load->model('System_users_model','M_system_user');
		$this->load->model('System_user_roles_model','M_system_user_role');

		//Load Page Models
		$this->load->model('System_web_modules_model','M_system_web_module');
		$this->load->model('System_web_sections_model','M_system_web_section');

		//Load Page Access Models
		$this->load->model('System_user_role_module_access_model','M_system_user_role_module_access');
		$this->load->model('System_user_role_section_access_model','M_system_user_role_section_access');
    }

	public function index()
	{
		if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

		$_SESSION['system_web_module'] = 'Dashboard';
		$_SESSION['system_web_section'] = '';

		$data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/logout',
				'assets/plugins/chart.js/Chart.min',
				'assets/js/pages/dashboard3',
				'assets/dist/js/demo'
            )
        );


		$this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/dashboard',$data);
		$this->load->view('includes/footer',$data);
		
	}

	
}
