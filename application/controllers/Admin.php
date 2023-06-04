<?php

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->session->set_userdata('file_manager', true);
	}

	public function index() {
		if($this->session->userdata("level") == "admin") {
			$data['article_full'] = $this->admin_model->get_all_article()->result_array();
			$this->load->view('admin/v_admin_header');
			$this->load->view('admin/v_admin_landing', $data);
			$this->load->view('admin/v_admin_footer');
		} else {
			redirect('auth/login');
		}
	}

	public function check_session($page, $data) {
		if($this->session->userdata('level') == 'admin') {
			$this->load->view('admin/v_admin_header');
			$this->load->view($page, $data);
			$this->load->view('admin/v_admin_header');
		} else {
			redirect('auth/login');
		}
	}

	public function admin_view_news($id) {
		if($this->session->userdata('level') == 'admin') {
			$data['news_detail'] = $this->admin_model->get_news_single($id)->result_array();
			$this->load->view('admin/v_admin_header');
			$this->load->view('admin/v_admin_preview', $data);
			$this->load->view('admin/v_admin_footer');
		}
	}

	public function admin_create_news() {
		if($this->session->userdata('level') == 'admin') {
			$data['type_name'] = $this->admin_model->get_type()->result_array();
			$this->load->view('admin/v_admin_header');
			$this->load->view('admin/v_admin_create', $data);
			$this->load->view('admin/v_admin_footer');
		} else {
			redirect('auth/login');
		}
	}

	public function admin_edit_news($id) {
		if ($this->session->userdata('level') == 'admin') {
			$data['news_detail'] = $this->admin_model->get_news_single($id)->result_array();
			$data['type_name'] = $this->admin_model->get_type()->result_array();
			$this->load->view('admin/v_admin_header');
			$this->load->view('admin/v_admin_edit', $data);
			$this->load->view('admin/v_admin_footer');
		} else {
			redirect('auth/login');
		}
	}

	public function admin_update_news($id) {
		$config['upload_path'] = './assets/img/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$where = array(
			'article_id' => $id
		);

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
				$summary = $this->input->post('summary');
				$berita = $this->input->post('berita');
				$type_article = $this->input->post('type_article');

				$data = array(
					'article_title' => $jdl,
					'article_desc' => $summary,
					'article_type' => $type_article,
					'article_content' => $berita,
					'updated' => time(),
					'image' => $gambar
				);

				$this->admin_model->update_news_single($where, $data, 'articles');
				$this->session->set_flashdata('articleUpdated', "Article was updated");
				redirect('admin');
			} else {
				redirect('admin/create');						
			}
		} else {
			$jdl = $this->input->post('judul');
			$berita = $this->input->post('berita');
			$summary = $this->input->post('summary');
			$type_article = $this->input->post('type_article');

			$data = array(
				'article_title' => $jdl,
				'article_type' => $type_article,
				'article_desc' => $summary,
				'article_content' => $berita,
				'updated' => time()
			);

			$this->admin_model->update_news_single($where, $data, 'articles');
			$this->session->set_flashdata('articleUpdated', "Article was updated");
			redirect('admin');			
		}
	}

	public function admin_delete_news($id) {
		if ($this->session->userdata('level') == 'admin') {
			$where = array(
				'article_id' => $id
			);

			$this->admin_model->admin_delete_news($where, 'articles');
			$this->session->set_flashdata('articleDeleted', "Article with id $id was deleted");
			redirect('admin');
		} else {
			redirect('auth/login');
		}
	}

	public function admin_save_news() {
		$config['upload_path'] = './assets/img/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
		$config['max_size'] = 10240;

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
				// $config['max_size'] = 10240;
				// $config['width'] = 710;
				// $config['height'] = 420;
				$config['new_image'] = './assets/images/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar = $gbr['file_name'];
				$jdl = $this->input->post('judul');
				$summary = $this->input->post('summary');
				$berita = $this->input->post('berita');
				$type_article = $this->input->post('type_article');

				$this->admin_model->save_news($jdl, $berita, $gambar, $summary, $type_article);
				redirect('admin');
			} else {
				redirect('admin/admin_create_news');
			}
		} else {
			redirect('admin/create');			
		}
	}

  public function view() {
    $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
    $limit = $_POST['length']; // Ambil data limit per page
    $start = $_POST['start']; // Ambil data start
    $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
    $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
    $sql_total = $this->admin_model->count_all(); // Panggil fungsi count_all pada SiswaModel
    $sql_data = $this->admin_model->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada SiswaModel
    $sql_filter = $this->admin_model->count_filter($search); // Panggil fungsi count_filter pada SiswaModel
    $callback = array(
        'draw'=>$_POST['draw'], // Ini dari datatablenya
        'recordsTotal'=>$sql_total,
        'recordsFiltered'=>$sql_filter,
        'data'=>$sql_data
    );
    header('Content-Type: application/json');
    echo json_encode($callback); // Convert array $callback ke json
	}
	
	public function see_message() {
		$data['all_messages'] = $this->admin_model->get_all_feedback()->result_array();
		$this->load->view('admin/v_admin_header');
		$this->load->view('admin/v_admin_messages', $data);
		$this->load->view('admin/v_admin_footer');
	}
}

?>
