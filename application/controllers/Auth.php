<?php

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('client_model');
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == false) {
			$data['type_name'] = $this->client_model->get_type()->result_array();
			$this->load->view('client/v_client_header', $data);
			$this->load->view('v_login');
			$this->load->view('client/v_client_footer');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$checkAdmin = $this->auth_model->get_admin($username);

			if($checkAdmin->num_rows() == 1) {
				$hash = $checkAdmin->row('password');
				if (password_verify($password, $hash)) {
					$this->session->set_userdata("level", "admin");
					$this->session->set_userdata("admin-name", $checkAdmin->result_array()[0]['fullname']);
					redirect('admin');
				}
			} else {
				$this->session->set_flashdata("userErr", "Your account isn't registered yet!");
				redirect('auth/login');
			}
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	public function register() {
		$data['type_name'] = $this->client_model->get_type()->result_array();
		$this->load->view('client/v_client_header', $data);
		$this->load->view('v_register');
		$this->load->view('client/v_client_footer');
	}


	public function insert_admin_data() {
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');


		if ($this->form_validation->run() == false) {
			$data['type_name'] = $this->client_model->get_type()->result_array();
			$this->load->view('client/v_client_header', $data);
			$this->load->view('v_register');
			$this->load->view('client/v_client_footer');
		} else {
			$fullname = $this->input->post('fullname');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

			$checkUsernameEmail = $this->auth_model->check_username_email($username, $email);

			if ($checkUsernameEmail->row('username') == $username && $checkUsernameEmail->row('email') == $email) {
				$this->session->set_flashdata("regErr", "Your username and email is already used!");
				redirect('auth/register');
			} else if ($checkUsernameEmail->row('username') == $username) {
				$this->session->set_flashdata("regErr", "Your username is already used!");
				redirect('auth/register');
			} else if ($checkUsernameEmail->row('email') == $email) {
				$this->session->set_flashdata("regErr", "Your email is already used!");
				redirect('auth/register');
			} else {
				$dataAdmin = array(
					'fullname' => $fullname,
					'username' => strtolower($username),
					'email' => $email,
					'password' => $password
				);
				
				$this->auth_model->insert_admin('admins', $dataAdmin);
				$this->session->userdata("level", "admin");
				redirect('admin');
			}
		}
	}
}

?>