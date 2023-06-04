<?php

class Client extends CI_Controller
{

  public function __construct() {
		parent::__construct();
		$this->load->model('client_model');
		$this->session->set_userdata('file_manager', true);
	}

	public function index() {
		$data['article'] = $this->client_model->get_article_data('RAND()')->result_array();
		$data['article_latest'] = $this->client_model->get_article_data()->result_array();
		$data['article_trend'] = $this->client_model->get_article_data('num_like', 3)->result_array();
		$data['article_most_viewed'] = $this->client_model->get_article_data('num_view', 5)->result_array();
		$data['type_name'] = $this->client_model->get_type()->result_array();
		$this->load->view('client/v_client_header', $data);
		$this->load->view('client/v_landing');
		$this->load->view('client/v_client_footer');
	}

	public function save_news(){
		$config['upload_path'] = './assets/img/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['filefoto']['name'])) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
				// Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/'.$gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 710;
				$config['height'] = 420;
				$config['new_image'] = './assets/images/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$jdl = $this->input->post('judul');
				$berita = $this->input->post('berita');

				$this->client_model->save_news($jdl, $berita, $gambar);
				redirect('admin');
			} else {
				redirect('admin/create');
			}
		} else {
			redirect('admin/create');			
		}
	}

	public function list_news($index_type) {
		$data['article'] = $this->client_model->get_article_data_specific($index_type)->result_array();
		$data['article_most_viewed'] = $this->client_model->get_article_data('num_view', 5)->result_array();
		$data['type_name'] = $this->client_model->get_type()->result_array();
		$this->load->view('client/v_client_header', $data);
		$this->load->view('client/v_list_news');
		$this->load->view('client/v_client_footer');
	}

	public function detail_news($id) {
		$this->client_model->incrementValue($id, 'num_view');
		$data['detail_news'] = $this->client_model->get_single_article($id)->result_array();
		$data['article_most_viewed'] = $this->client_model->get_article_data('num_view', 5)->result_array();
		$data['related_news'] = $this->client_model->get_article_data('RAND()')->result_array();
		$data['type_name'] = $this->client_model->get_type()->result_array();
		$this->load->view('client/v_client_header', $data);
		$this->load->view('client/v_client_single_news');
		$this->load->view('client/v_client_footer');
	}

	public function increment_like($id) {
		$this->client_model->incrementValue($id, 'num_like');
		echo "<div>WOWW</div>";
	}

	public function login() {
		if($this->session->userdata('level') == 'admin') {
			redirect('admin');
		} else {
			$data['type_name'] = $this->client_model->get_type()->result_array();
			$this->load->view('client/v_client_header', $data);
			$this->load->view('v_login');
			$this->load->view('client/v_client_footer');
		}
	}

	public function contact() {
		$data['type_name'] = $this->client_model->get_type()->result_array();
		$this->load->view('client/v_client_header', $data);
		$this->load->view('client/v_client_contact');
		$this->load->view('client/v_client_footer');
	}

	public function send_feedback() {

		$this->form_validation->set_rules('from_name', 'Username', 'required');
		$this->form_validation->set_rules('from_email', 'Email', 'required');
		$this->form_validation->set_rules('from_subject', 'Subject', 'required');
		$this->form_validation->set_rules('from_message', 'Message', 'required');

		if ($this->form_validation->run() == false) {
			$data['type_name'] = $this->client_model->get_type()->result_array();
			$this->load->view('client/v_client_header', $data);
			$this->load->view('client/v_client_contact');
			$this->load->view('client/v_client_footer');
		} else {
			$from_name = $this->input->post('from_name');
			$from_email = $this->input->post('from_email');
			$from_subject = $this->input->post('from_subject');
			$from_message = $this->input->post('from_message');

			$dataSubmit = array(
				"sender_name" => $from_name,
				"sender_email" => $from_email,
				"subject" => $from_subject,
				"message_text" => $from_message
			);

			$this->client_model->save_feedback($dataSubmit);
			$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your message has been sent successfully!</div>');
			redirect('client/contact');

		}

	}
}

?>
