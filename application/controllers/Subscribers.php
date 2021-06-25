<?php 

class Subscribers extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Users';
		

		$this->load->model('Model_subscribers');
	}
	public function index(){
		redirect('subscribers/manage', 'refresh');
	}
	public function manage()
	{

		if(!in_array('viewUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$user_data = $this->Model_subscribers->getUserData();

		$result = array();
		foreach ($user_data as $k => $v) {

			$result[$k]['user_info'] = $v;

		}

		$this->data['user_data'] = $result;

		$this->render_template('subscribers/index', $this->data);
	}


	public function edit($id = null)
	{

		if(!in_array('updateUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if($id) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('phone', 'Phone Number', 'required|regex_match[/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/]');
			$this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('subscription_for', 'Subscription For', 'required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password'))) {
		        	$data = array(
		        		'email' => $this->input->post('email'),
		        		'first_name' => $this->input->post('first_name'),
		        		'last_name' => $this->input->post('last_name'),
						'phone' => $this->input->post('phone'),
						'dob' => $this->input->post('dob'),
						'subscription_for' => $this->input->post('subscription_for'),
						'is_email_verified' => 'yes'
		        	);

		        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully created');
		        		redirect('users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('users/edit/'.$id, 'refresh');
		        	}
		        }
		        else {
		        	//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					//$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {


						$data = array(
			        		'email' => $this->input->post('email'),
			        		'first_name' => $this->input->post('first_name'),
			        		'last_name' => $this->input->post('last_name'),
							'phone' => $this->input->post('phone'),
							'dob' => $this->input->post('dob'),
							'subscription_for' => $this->input->post('subscription_for'),
							'is_email_verified' => 'yes'
			        	);

			        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('users/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('users/edit/'.$id, 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getUserData($id);
						$this->data['user_data'] = $user_data;
						$this->session->set_flashdata('errors', 'Error occurred!!');
						$this->render_template('subscribers/edit', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->model_users->getUserData($id);

	        	$this->data['user_data'] = $user_data;


				$this->render_template('subscribers/edit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{

		if(!in_array('deleteUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if($id) {
			if($this->input->post('confirm')) {

				
					$delete = $this->model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/delete/'.$id, 'refresh');
		        	}

			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('users/delete', $this->data);
			}	
		}
	}

	public function profile()
	{

		if(!in_array('viewProfile', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$user_id = $this->session->userdata('id');

		$user_data = $this->model_users->getAdminUserData($user_id);
		$this->data['user_data'] = $user_data;


        $this->render_template('users/profile', $this->data);
	}


}