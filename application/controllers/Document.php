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
        $this->load->model('Document_attachments_model','M_document_attachment');
        $this->load->model('System_departments_model','M_department');
        $this->load->model('System_divisions_model','M_division');

        $this->document_path = 'assets/documents/';
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
                'assets/plugins/bs-custom-file-input/bs-custom-file-input.min',
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

        $department = $this->M_department->get($_SESSION['department_id']);
        $division = $this->M_division->get($_SESSION['division_id']);

        $file_dir = $this->document_path . $department[0]->name . '/' . $division[0]->name . '/';

        $role = $this->M_system_user_role_module_access->get_access($_SESSION['role_id'],'document');
        if (!$role[0]->can_create)
        {
            $response['message'] = 'You are not authorized for this action. Please contact your technical support.';
            echo json_encode($response);
            return;
        }

            if($this->input->post())
            {
                $reference_number = $this->security->xss_clean($this->input->post('reference_number'));
                $title = $this->security->xss_clean($this->input->post('title'));
                $rgv_document_type_id = $this->security->xss_clean($this->input->post('rgv_document_type_id'));
                $rgv_document_tlp_code_id = $this->security->xss_clean($this->input->post('rgv_document_tlp_code_id'));
                $rgv_document_status_id = $this->security->xss_clean($this->input->post('rgv_document_status_id'));
                $document_date = $this->security->xss_clean($this->input->post('document_date'));
                $document_time = $this->security->xss_clean($this->input->post('document_time'));
                $remarks = $this->security->xss_clean($this->input->post('remarks'));
                $is_walk_in = ($rgv_document_type_id==6) ? 1 : 0;
                $completion_date = ($rgv_document_status_id==7) ? date('y-m-d H:i:s') : NULL;

                if($reference_number!=='' &&  $title!=='' && $rgv_document_type_id>0 &&  $rgv_document_tlp_code_id>0 && $rgv_document_status_id>0 && $document_date!=='' && $document_time!=='')
                {
                    $data = array (
                        'reference_number' => $reference_number,
                        'title' => $title,
                        'rgv_document_type_id' => $rgv_document_type_id,
                        'rgv_document_tlp_code_id' => $rgv_document_tlp_code_id,
                        'rgv_document_status_id' => $rgv_document_status_id,
                        'document_date' => $document_date,
                        'document_time' => $document_time,
                        'remarks' => $remarks,
                        'is_walk_in' => $is_walk_in,
                        'completion_date' => $completion_date,
                        'created_by' => $_SESSION['user_id'],
                        'created_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                    );

                    $id = $this->M_document->insert($data);

                    if($id){

                        if (!empty($_FILES['attachments']['name'][0]))
                        { 

                            

                            //Directory does not exist, so lets create it.
                            if(!is_dir($file_dir))
                            {
                                if (!mkdir($file_dir, 0755, true)) {
                                    $response['info'] = array (
                                        'file_dir' => 'Failed to create directories...'
                                    );
                                    
                                }else{
                                    $response['info'] = array (
                                        'file_dir' => 'create success!'
                                    );
                                }
                            }

                            // if(!is_dir($file_dir . '/' + $department[0]->name . '/'))
                            //     mkdir($file_dir . '/' + $department[0]->name . '/', 0755);

                            // if(!is_dir($file_dir . '/' + $department[0]->name .'/' + $division[0]->name . '/'))
                            //     mkdir($file_dir . '/' + $department[0]->name . '/' + $division[0]->name . '/', 0755);

                            // $document_path = $file_dir + '/' + $department[0]->name + '/' + $division[0]->name + '/';

                            $countfiles = count($_FILES['attachments']['name']);
                            // To store uploaded files path
                            $files_arr = array();

                            // Loop all files
                            for($index = 0;$index < $countfiles;$index++){

                                if(isset($_FILES['attachments']['name'][$index]) && $_FILES['attachments']['name'][$index] != ''){
                                    // File name
                                    $filename = $_FILES['attachments']['name'][$index];

                                    // Get extension
                                    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                                    // Valid image extension
                                    // $valid_ext = array("png","jpeg","jpg");

                                    // Check extension
                                    // if(in_array($ext, $valid_ext)){
                                        if(!is_dir($file_dir .'/'. $id. '/'))
                                            mkdir($file_dir .'/'. $id. '/',0755,true);

                                        // File path
                                        $path = $file_dir .'/'. $id. '/' . $filename;
                                        
                                        // Upload file
                                        if(move_uploaded_file($_FILES['attachments']['tmp_name'][$index],$path)){
                                            $files_arr[] = $path;

                                            $data = array (
                                                'document_id' => $id,
                                                'document_routing_id' => 0,
                                                'file_name' => $filename,
                                                'file_path' => $file_dir,
                                                'created_by' => $_SESSION['user_id'],
                                                'created_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                                            );

                                            $this->M_document_attachment->insert($data);
                                        }
                                    // }
                                }
                            }

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

        $data['document'] = $this->M_document->get($id);
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
                $reference_number = $this->security->xss_clean($this->input->post('reference_number'));
                $title = $this->security->xss_clean($this->input->post('title'));
                $rgv_document_type_id = $this->security->xss_clean($this->input->post('rgv_document_type_id'));
                $rgv_document_tlp_code_id = $this->security->xss_clean($this->input->post('rgv_document_tlp_code_id'));
                $rgv_document_status_id = $this->security->xss_clean($this->input->post('rgv_document_status_id'));
                $document_date = $this->security->xss_clean($this->input->post('document_date'));
                $document_time = $this->security->xss_clean($this->input->post('document_time'));
                $remarks = $this->security->xss_clean($this->input->post('remarks'));
                $is_walk_in = ($rgv_document_type_id==6) ? 1 : 0;
                $completion_date = ($rgv_document_status_id==7) ? date('y-m-d H:i:s') : NULL;

                if($reference_number!=='' &&  $title!=='' && $rgv_document_type_id>0 &&  $rgv_document_tlp_code_id>0 && $rgv_document_status_id>0 && $document_date!=='' && $document_time!=='')
                {
                    $data = array (
                        'reference_number' => $reference_number,
                        'title' => $title,
                        'rgv_document_type_id' => $rgv_document_type_id,
                        'rgv_document_tlp_code_id' => $rgv_document_tlp_code_id,
                        'rgv_document_status_id' => $rgv_document_status_id,
                        'document_date' => $document_date,
                        'document_time' => $document_time,
                        'remarks' => $remarks,
                        'is_walk_in' => $is_walk_in,
                        'completion_date' => $completion_date,
                        'updated_by' => $_SESSION['user_id'],
                        'updated_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                    );

                    $id = $this->M_document->update($data,$id);

                    if($id){

                        if (!empty($_FILES['attachments']['name'][0]))
                        { 
                            //Directory does not exist, so lets create it.
                            if(!is_dir($file_dir))
                            {
                                if (!mkdir($file_dir, 0755, true)) {
                                    $response['info'] = array (
                                        'file_dir' => 'Failed to create directories...'
                                    );
                                    
                                }else{
                                    $response['info'] = array (
                                        'file_dir' => 'create success!'
                                    );
                                }
                            }

                            $countfiles = count($_FILES['attachments']['name']);
                            // To store uploaded files path
                            $files_arr = array();

                            // Loop all files
                            for($index = 0;$index < $countfiles;$index++){

                                if(isset($_FILES['attachments']['name'][$index]) && $_FILES['attachments']['name'][$index] != ''){
                                    // File name
                                    $filename = $_FILES['attachments']['name'][$index];

                                    if(!is_dir($file_dir .'/'. $id. '/'))
                                        mkdir($file_dir .'/'. $id. '/',0755,true);

                                    // File path
                                    $path = $file_dir .'/'. $id. '/' . $filename;
                                    
                                    if(file_exists($path)){

                                        $document_attatchment_id = $this->M_document_attachment->get_by_document($id,$filename);

                                        chmod($path, 0777);
                                        unlink($path);

                                        // Upload file
                                        if(move_uploaded_file($_FILES['attachments']['tmp_name'][$index],$path)){
                                            $files_arr[] = $path;

                                            $data = array (
                                                'updated_by' => $_SESSION['user_id'],
                                                'updated_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                                            );

                                            $this->M_document_attachment->update($data,$document_attatchment_id);
                                        }


                                    }else{
                                        // Upload file
                                        if(move_uploaded_file($_FILES['attachments']['tmp_name'][$index],$path)){
                                            $files_arr[] = $path;

                                            $data = array (
                                                'document_id' => $id,
                                                'document_routing_id' => 0,
                                                'file_name' => $filename,
                                                'file_path' => $file_dir,
                                                'created_by' => $_SESSION['user_id'],
                                                'created_at' => $this->security->xss_clean(date('y-m-d H:i:s'))
                                            );

                                            $this->M_document_attachment->insert($data);
                                        }
                                    }
                                    
                                }
                            }

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

    public function tab_info($id=NULL)
    {
        $data['document'] = $this->M_document->get($id);
        $this->load->view('pages/document/_tab_info',$data);
    }

    public function tab_routes($id=NULL)
    {
        $data['document'] = $this->M_document->get($id);
        $this->load->view('pages/document/_tab_routes',$data);
    }

    public function preview_card($id=NULL)
    {
        $data['document'] = $this->M_document->get($id);
        $this->load->view('pages/document/preview_card',$data);
    }
}
