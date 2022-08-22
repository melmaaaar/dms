<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {
	
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
        $this->load->model('Documents_model','M_document');
        
    }

    
    // Load Index View
	public function index()
	{
        if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_access)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

		$_SESSION['system_web_module'] = 'Documents';
		$_SESSION['system_web_section'] = '';

		$data['page_info'] = array(
            'styles_path' => array(
                'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min',
                'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min',
                'assets/plugins/datatables-buttons/css/buttons.bootstrap4.min'
            ),
            'scripts_path' => array(
                'assets/plugins/datatables/jquery.dataTables.min',
                'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min',
                'assets/plugins/datatables-responsive/js/dataTables.responsive.min',
                'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min',
                'assets/plugins/datatables-buttons/js/dataTables.buttons.min',
                'assets/plugins/datatables-buttons/js/buttons.bootstrap4.min',
                'assets/plugins/jszip/jszip.min',
                'assets/plugins/pdfmake/pdfmake.min',
                'assets/plugins/pdfmake/vfs_fonts',
                'assets/plugins/datatables-buttons/js/buttons.html5.min',
                'assets/plugins/datatables-buttons/js/buttons.print.min',
                'assets/plugins/datatables-buttons/js/buttons.colVis.min',
                'assets/js/pages/document/index'
            )
        );

		$this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/document/index',$data); // content
		$this->load->view('includes/footer',$data);
		
	}

    public function get_role()
    {
        $role = $this->M_system_user_role_module_access->get_access(1,'document');
    }

    // for user role of VIEW ONLY
    public function view($id=NULL)
    {
        if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_view)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }
		
        $_SESSION['system_web_module'] = 'Documents';
		$_SESSION['system_web_section'] = '';

        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/document/view'
            )
        );

        $data['document'] = $this->M_system_web_module->get($id); // GET
        $this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/document/view',$data);
		$this->load->view('includes/footer',$data);

    }

    // Function to Get All on Table
    public function get_all()
    {

        if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_view)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

        $data['document'] = $this->M_document->get_all();
        echo json_encode($data);

    }

    public function datatable_get_all()
    {
        if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_view)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

        $data['data'] = $this->M_document->get_all();
        echo json_encode($data);

    }

    // Function to load the view of Create
    public function create()
    {
        // To check if may session if wala then i logout ka nya
        if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_create)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }
            
        $_SESSION['system_web_module'] = 'Documents';
		$_SESSION['system_web_section'] = '';

        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/plugins/jquery-validation/jquery.validate.min',
                'assets/plugins/jquery-validation/additional-methods.min',
                'assets/js/pages/document/create'
            )
        );

        $this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/document/create',$data);
		$this->load->view('includes/footer',$data);
    }

    public function save()
    {
        $response['status'] = 0;
        $response['message'] = 'Something went wrong. Please contact your technical support.';

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_create)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

        if($this->input->post())
        {
            $name = $this->security->xss_clean($this->input->post('name'));
            $code = $this->security->xss_clean($this->input->post('code'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $link = $this->security->xss_clean($this->input->post('link'));
            $icon = $this->security->xss_clean($this->input->post('icon'));
            $ctr = $this->security->xss_clean($this->input->post('ctr'));
            $is_active = $this->security->xss_clean($this->input->post('is_active'));

            if($name!=='' &&  $code!=='')
            {
                $data = array (
                    'name' => $name,
                    'code' => $code,
                    'description' => $description,
                    'link' => $link,
                    'icon' => $icon,
                    'ctr' => $ctr,
                    'is_active' => $is_active,
                    'created_by' => $_SESSION['user_id'],
                    'created_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                );

                $id = $this->M_system_web_module->insert($data);

                if($id){

                    if($_SESSION['role_id']==1){
                        $data = array (
                            'role_id' => 1,
                            'web_module_id' => $id,
                            'can_access' => 1,
                            'can_view' => 1,
                            'can_create' => 1,
                            'can_edit' => 1,
                            'can_delete' => 1,
                            'created_by' => $_SESSION['user_id'],
                            'created_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                        );

                        $this->M_system_user_role_module_access->insert($data);
                    }
                    
                    $response['status'] = 1;
                    $response['message'] = 'Successful!';

                    //abang para sa user action logs

                    echo json_encode($response);
                    return;
                }

            }else{
                $response['message'] = 'Please fill up the required fields. Thank you.';
            }
        }

        echo json_encode($response);

    }
    

    public function edit($id=NULL)
    {
        if (!($this->session->userdata('username')))
			redirect('auth/logout'); 
		
        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_edit)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

        $_SESSION['system_web_module'] = 'Documents';
		$_SESSION['system_web_section'] = '';

        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/plugins/jquery-validation/jquery.validate.min',
                'assets/plugins/jquery-validation/additional-methods.min',
                'assets/js/pages/document/edit'
            )
        );

        $data['document'] = $this->M_system_web_module->get($id);
        $this->load->view('includes/header',$data);
		$this->load->view('includes/navbar',$data);
		$this->load->view('includes/sidebar',$data);
		$this->load->view('pages/document/edit',$data);
		$this->load->view('includes/footer',$data);
    }

    public function update()
    {
        $response['status'] = 0;
        $response['message'] = 'Something went wrong. Please contact your technical support.';

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_edit)
        {
            
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

        if($this->input->post())
        {
            
            $id = $this->security->xss_clean($this->input->post('id'));
            
            $name = $this->security->xss_clean($this->input->post('name'));
            $code = $this->security->xss_clean($this->input->post('code'));
            $description = $this->security->xss_clean($this->input->post('description'));
            $link = $this->security->xss_clean($this->input->post('link'));
            $icon = $this->security->xss_clean($this->input->post('icon'));
            $ctr = $this->security->xss_clean($this->input->post('ctr'));
            $is_active = $this->security->xss_clean($this->input->post('is_active'));

            if($name!=='' &&  $code!=='')
            {


                $data = array (
                    'name' => $name,
                    'code' => $code,
                    'description' => $description,
                    'link' => $link,
                    'icon' => $icon,
                    'ctr' => $ctr,
                    'is_active' => $is_active,
                    'updated_by' => $_SESSION['user_id'],
                    'updated_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                );

                $id = $this->M_system_web_module->update($data,$id);

                if($id){

                    $response['status'] = 1;
                    $response['message'] = 'Successful!';

                    //abang para sa user action logs

                    echo json_encode($response);
                    return;
                }
                

            }else{
                $response['message'] = 'Please fill up the required fields. Thank you.';
            }

        }

        echo json_encode($response);
    }

    public function delete($id=NULL)
    {
        if (!($this->session->userdata('username')))
		    redirect('auth/logout'); 

        $response['status'] = 0;
        $response['message'] = 'Something went wrong. Please contact your technical support.';

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_delete)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

        $data = array (
            'deleted_by' => $_SESSION['user_id'],
            'deleted_at' => date('y-m-d H:i:s'),
        );

        $result = $this->M_system_web_module->delete($data,$id);

        if($result)
        {
            $response['status'] = 1;
            $response['message'] = 'Delete Successful!';
        }   
        
        echo json_encode($response);
        
    }

	
}
