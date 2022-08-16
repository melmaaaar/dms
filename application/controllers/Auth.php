<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('System_users_model','M_system_user');
        $this->load->model('System_user_roles_model','M_system_user_role');
    }

	public function index()
	{
        $data['page_info'] = array(
            'styles_path' => '',
            'scripts_path' => array(
                'assets/js/pages/login'
            )
        );

        if (!($this->session->userdata('username')))
		{
		    $this->load->view('pages/login',$data);
        }
        else
        {
            redirect('dashboard'); 
        }
	}

    public function login()
    {
        // default status and message
        $response['status'] = 0;
        $response['message'] = 'Incorrect credentials. Please try again.';

        // this is to avoid brute force of functions
        if(!($this->input->post()))
            redirect('/');

        if (!($this->session->userdata('username'))) //check if their is no active session
		{
            //clean the fields to avoid cross site scripting and sql injection
		    $username = $this->security->xss_clean($this->input->post('username'));
		    $password = $this->security->xss_clean($this->input->post('password'));

            $result = $this->M_system_user->check($username); //check if username exists in database and get the info

            if ( !empty($result) ) //if the result is not empty
			{
                
                //check if how many login attemps - to avoid brute force attacks
                if($result[0]->login_attempt>=4)
                {
                    //if attempts are greater or equal to 4, disable the account!
                    $response['message'] = 'You have reached the maximum retries allowed. Account blocked. Please contact your system administrator.';
                    echo json_encode($response);
                    return;
                }

                //check if the hashed password is verified
				$verified = password_verify($password, $result[0]->password);

                if($verified)
				{

                    //if verified, get the role of the user
                    $role = $this->M_system_user_role->get_by_user_id($result[0]->id);
                    
                    if(empty($role) || $role[0]->id<=0)
                    { 

                        //if no roles assigned.
                        $response['message'] = 'You do not have permission to access the system. Please contact your system administrator.';
                        echo json_encode($response);
                        return;
                    }

                    //store necessary info from result set to an array
                    $user_data = array( 
                        'user_id' => $result[0]->id,
                        'role_id' => $role[0]->role_id,
                        'department_id' => $result[0]->department_id,
                        'division_id' => $result[0]->division_id,
                        'username'  => $result[0]->username, 
                        'first_name'  => $result[0]->first_name, 
                        'middle_name'  => $result[0]->middle_name, 
                        'last_name'  => $result[0]->last_name,
                        'job_title'  => $result[0]->job_title,  
                        'img_path'  => $result[0]->img_path, 
                        'logged_in' => TRUE,
                        'system_web_module' => 'Dashboard',
                        'system_web_section' => ''
                     );  

                    //apply user data into the session
                    $this->session->set_userdata($user_data);
                    
                    //start: reset the login attempts
                    $login_attempt = array (
                        'login_attempt' => 0
                    );
                    $this->M_system_user->update($login_attempt,$result[0]->id);
                    //end: reset the login attempts
                    
                    
                    // record the login 
                    // $logs = array (
                    //     'action' => ucwords($result[0]->first_name) . ' ' . ucwords($result[0]->last_name) . ' has logged in.',
                    //     'reference_id' => $result[0]->id,
                    //     'created_by' => $this->session->userdata('user_id'),
                    //     'created_at' => date('y-m-d H:i:s')
                    // );

                    // $this->M_user_action_history_log->save($logs);
                    //change the status and message into success
					$response['status'] = 1;
       		 		$response['message'] = 'Logged in successfully!';

				}else{
                    //if the password is not verified, probably incorrect
                    //start: increment the login attempt
                    $login_attempt = array (
                        'login_attempt' => $result[0]->login_attempt + 1
                    );

                    $this->M_system_user->update($login_attempt,$result[0]->id);
                    //end: increment the login attempt

                    echo json_encode($response);
                    return;
                }

			}
        }
        else
        {
            //if there are active session redirect to dashboard
             redirect('dashboard'); 
        }

        //return the default message and status
		echo json_encode($response);
    }

    public function logout()
    {   
        $response['status'] = 1;
        $response['message'] = 'You have logged out.';

        if (!($this->session->userdata('username')))
		{
		    redirect('/'); 
        }
        
        $user_data = array( 
            'user_id' => '',
            'role_id' => '',
            'department_id' => '',
            'division_id' => '',
            'username'  => '', 
            'first_name'  => '',
            'middle_name'  => '',
            'last_name'  => '',
            'job_title'  => '',
            'img_path'  => '',
            'logged_in' => FALSE,
            'system_web_module' => '',
            'system_web_section' => ''
         );  

		$this->session->unset_userdata($user_data);
        $this->session->sess_destroy();
        
    }

	
}
