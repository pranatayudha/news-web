<?php 

class Client_model extends CI_Model {

	public function get_article_data($ordering = null, $limit = null) {
		if($ordering != null) {
			if($ordering == 'RAND()') {
				$query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering");
			} else if($ordering == 'num_like') {
				$query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering DESC, num_view DESC limit $limit");
			} else if($ordering == 'num_view') {
				$query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering DESC, num_like DESC limit $limit");
			} else {
				$query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id order by $ordering DESC limit $limit");
			}
		} else {
			$query = $this->db->query("SELECT article_id, article_title, type_name, type_id, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id ORDER BY article_id DESC");
		}
		return $query;
	}

	public function get_article_data_specific($type_index) {
		$query = $this->db->query("SELECT article_id, article_title, type_name, class, article_content, article_desc, created, author, updated, num_view, num_like, image FROM articles A, types T WHERE A.article_type = T.type_id AND A.article_type = $type_index ORDER BY article_id DESC");
		return $query;
	}

	public function get_single_article($id) {
		$query = $this->db->query("SELECT *, type_name, type_id, class from articles A, types T WHERE A.article_type = T.type_id AND article_id = $id");
		return $query;
	}

	public function get_type() {
		$query = $this->db->query("SELECT * FROM types");
		return $query;
	}

	public function incrementValue ($article_id, $column) {
		$query = $this->db->query("UPDATE articles SET $column = $column + 1 WHERE article_id = $article_id");
		return $query;
	}

	public function save_feedback($data) {
		// $query = $this->db->query("INSERT INTO messages (sender_name, sender_email, subject, message) VALUES ($data['sender_name'], $data['sender_email'], $data['subject'], $data['message'])");
		$query = $this->db->insert('messages', $data);
		return $query;
	}

}

?>
