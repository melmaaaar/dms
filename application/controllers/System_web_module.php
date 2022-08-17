<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_web_module extends CI_Controller {
	
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

        // Load Class Models
    }

    // Load Index View
	public function index()
	{
		$_SESSION['system_web_module'] = 'System Setup';
		$_SESSION['system_web_section'] = 'Web Modules';

		$data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/system_web_module/index'
            )
        );

		$this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/system_web_module/index',$data); // content
		$this->load->view('includes/footer',$data);
		
	}

    // for user role of VIEW ONLY
    public function view($id=NULL)
    {
        if (!($this->session->userdata('username')))
		{
			redirect('auth/logout'); 
		}

        $_SESSION['system_web_module'] = 'System Setup';
		$_SESSION['system_web_section'] = 'Web Modules';

        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/system_web_module/view'
            )
        );

        $data['system_web_module'] = $this->M_system_web_module->get($id); // GET
        $this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/system_web_module/view',$data);
		$this->load->view('includes/footer',$data);

    }

    // Function to Get All on Table
    public function get_all()
    {
        $data['system_web_module'] = $this->M_system_web_module->get_all();
        
        echo json_encode($data);

    }

    // Function to load the view of Create
    public function create()
    {
        if (!($this->session->userdata('username')))
		{
			redirect('auth/logout'); 
		}

        $_SESSION['system_web_module'] = 'System Setup';
		$_SESSION['system_web_section'] = 'Web Modules';

        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/system_web_module/create'
            )
        );

        $this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/system_web_module/create',$data);
		$this->load->view('includes/footer',$data);
    }

    public function save()
    {
        $response['status'] = 0;
        $response['message'] = 'Something went wrong. Please contact your technical support.';

        if($this->input->post())
        {
            $name = $this->security->xss_clean($this->input->post('name'));
            $code = $this->security->xss_clean($this->input->post('code'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $link = $this->security->xss_clean($this->input->post('link'));
            $icon = $this->security->xss_clean($this->input->post('icon'));
            $ctr = $this->security->xss_clean($this->input->post('ctr'));

            if($name!=='' &&  $code!=='')
            {
                $data = array (
                    'name' => $this->security->xss_clean($this->input->post('school_id')),
                    'code' => $this->security->xss_clean($this->input->post('name')),
                    'description' => $this->security->xss_clean($this->input->post('code')),
                    'link' => $this->security->xss_clean($this->input->post('description')),
                    'icon' => $this->security->xss_clean($this->session->userdata('user_id')),
                    'ctr' => $this->security->xss_clean(date('y-m-d H:i:s')),
                    'created_by' => $this->security->xss_clean($this->session->userdata('user_id')),
                    'created_at' => $this->security->xss_clean(date('y-m-d H:i:s')),
                );



            }else{
                $response['message'] = 'Please fill up the required fields. Thank you.';
            }
        }

        echo json_encode($response);


        $school_id = $this->input->post('school_id');
        $name = $this->input->post('name'); 
        $code = $this->input->post('code');
        $description = $this->input->post('description');

        if($name!=='' && $code!=='' && $school_id>=1)
        {   

            $data = array (
                'school_id' => $this->security->xss_clean($this->input->post('school_id')),
                'name' => $this->security->xss_clean($this->input->post('name')),
                'code' => $this->security->xss_clean($this->input->post('code')),
                'description' => $this->security->xss_clean($this->input->post('description')),
                'created_by' => $this->security->xss_clean($this->session->userdata('user_id')),
                'created_at' => $this->security->xss_clean(date('y-m-d H:i:s')),
            );

            $id = $this->M_campus->save($data);

            if($id)
            {
                $user_res = $this->M_user->get($this->session->userdata('user_id'));

                $logs = array (
                    'action' => ucwords($user_res[0]->first_name) . ' ' . ucwords($user_res[0]->last_name) . ' has created a campus.',
                    'reference_id' => $id,
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('y-m-d H:i:s')
                );

                $this->M_user_action_history_log->save($logs);
                
                $response['status'] = 1;
                $response['message'] = 'Save Successful!';
            }

            echo json_encode($response);
            return;
        }       
        else{

            $response['message'] = 'Please complete all required fields! Please try again.';
        }

        echo json_encode($response);

    }
    

    public function edit($id=NULL)
    {
        if (!($this->session->userdata('username')))
		{
			redirect('auth/logout'); 
		}

        $_SESSION['system_web_module'] = 'System Setup';
		$_SESSION['system_web_section'] = 'Web Modules';

        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/system_web_module/edit'
            )
        );

        $this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/system_web_module/edit',$data);
		$this->load->view('includes/footer',$data);
    }

    public function update()
    {
        $response['status'] = 0;
        $response['message'] = 'Something went wrong. Please contact your technical support.';

        $id = $this->input->post('id');
        $school_id = $this->input->post('school_id');
        $name = $this->input->post('name'); 
        $code = $this->input->post('code');
        $description = $this->input->post('description');

        if($name!=='' && $code!=='' && $school_id>=1)
        {   

            $data = array (
                'school_id' => $this->security->xss_clean($this->input->post('school_id')),
                'name' => $this->security->xss_clean($this->input->post('name')),
                'code' => $this->security->xss_clean($this->input->post('code')),
                'description' => $this->security->xss_clean($this->input->post('description')),
                'updated_by' => $this->security->xss_clean($this->session->userdata('user_id')),
                'updated_at' => $this->security->xss_clean(date('y-m-d H:i:s')),
            );

            $id = $this->M_campus->update($data,$id);

            if($id)
            {
                $user_res = $this->M_user->get($this->session->userdata('user_id'));

                $logs = array (
                    'action' => ucwords($user_res[0]->first_name) . ' ' . ucwords($user_res[0]->last_name) . ' has updated a campus.',
                    'reference_id' => $id,
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('y-m-d H:i:s')
                );

                $this->M_user_action_history_log->save($logs);

                $response['status'] = 1;
                $response['message'] = 'Update Successful!';
            }

            echo json_encode($response);
            return;
        }       
        else{

            $response['message'] = 'Please complete all required fields! Please try again.';
        }

        echo json_encode($response);
    }

    public function delete($id=NULL)
    {
        $response['status'] = 0;
        $response['message'] = 'Something went wrong. Please contact your technical support.';

        $data = array (
            'deleted_by' => $this->security->xss_clean($this->session->userdata('user_id')),
            'deleted_at' => date('y-m-d H:i:s'),
        );

        $result = $this->M_campus->delete($data,$id);

        if($result)
        {
            $user_res = $this->M_user->get($this->session->userdata('user_id'));

            $logs = array (
                'action' => ucwords($user_res[0]->first_name) . ' ' . ucwords($user_res[0]->last_name) . ' has deleted a campus.',
                'reference_id' => $id,
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('y-m-d H:i:s')
            );

            $this->M_user_action_history_log->save($logs);

            $response['status'] = 1;
            $response['message'] = 'Delete Successful!';
        }   

        echo json_encode($response);
        
    }

	
}
