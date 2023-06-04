<?php 

class Admin_model extends CI_Model {

	public function get_all_article() {
		$query = "SELECT * FROM articles A, types T WHERE A.article_type = T.type_id order by created DESC";
		return $this->db->query($query);
	}

	public function get_type() {
		$query = $this->db->query("SELECT * FROM types");
		return $query;
	}

	public function get_news_single($id) {
		$query = $this->db->query("SELECT *, type_name, class from articles A, types T WHERE A.article_type = T.type_id AND article_id = $id");
		return $query;
	}

	public function update_news_single ($where, $data, $table) {
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function admin_delete_news($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function save_news($jdl,$berita,$gambar, $article_desc, $article_type) {
		$time = time();
		$hsl=$this->db->query("INSERT INTO articles (article_title, article_type, article_desc, article_content, author, created, updated, num_view, num_like, image) VALUES ('$jdl', $article_type, '$article_desc', '$berita', 'Yudha', $time, $time, 0, 0, '$gambar')");
		return $hsl;
	}

	public function filter($search, $limit, $start, $order_field, $order_ascdesc) {
		$query = "
		SELECT *
		FROM 
			`articles`
		JOIN
			`types` ON `types`.`type_id` = `articles`.`article_type`
		WHERE
			`type_name` LIKE '%$search%' ESCAPE '!'
				OR
			`article_title` LIKE '%$search%' ESCAPE '!'
				OR  
			`article_type` LIKE '%$search%' ESCAPE '!'
				OR  
			`article_content` LIKE '%$search%' ESCAPE '!'
				OR  
			`created` LIKE '%$search%' ESCAPE '!'
				OR  
			`updated` LIKE '%$search%' ESCAPE '!'
		ORDER BY 
			`$order_field` $order_ascdesc
		LIMIT
			$start, $limit
		";
		
		return $this->db->query($query)->result_array();
		// $this->db->query($query);

		// return $this->db->get('article')->result_array(); // Eksekusi query sql sesuai kondisi diatas
		// $this->db->get('article')->result_array(); // Eksekusi query sql sesuai kondisi diatas
		
		// return print_r($this->db->last_query());
	}
	
	public function count_all() {
    return $this->db->count_all('articles'); // Untuk menghitung semua data siswa
	}
	

	public function count_filter($search) {
    // $this->db->like('article_title', $search); // Untuk menambahkan query where LIKE
    // $this->db->or_like('article_type', $search); // Untuk menambahkan query where OR LIKE
    // $this->db->or_like('article_content', $search); // Untuk menambahkan query where OR LIKE
    // $this->db->or_like('created', $search); // Untuk menambahkan query where OR LIKE
    // $this->db->or_like('updated', $search); // Untuk menambahkan query where OR LIKE
		// return $this->db->get('article')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
		
		$query = "
		SELECT *
		FROM 
			`articles`
		JOIN
			`types` ON `types`.`type_id` = `articles`.`article_type`
		WHERE
			`type_name` LIKE '%$search%' ESCAPE '!'
				OR
			`article_title` LIKE '%$search%' ESCAPE '!'
				OR  
			`article_type` LIKE '%$search%' ESCAPE '!'
				OR  
			`article_content` LIKE '%$search%' ESCAPE '!'
				OR  
			`created` LIKE '%$search%' ESCAPE '!'
				OR  
			`updated` LIKE '%$search%' ESCAPE '!'
		";
		
		return $this->db->query($query)->num_rows();
	}

	public function get_all_feedback() {
		return $this->db->query("SELECT * FROM messages ORDER BY message_id DESC");
	}
	
}

?>