<?php 

class Auth_model extends CI_Model {

	public function get_admin($username) {
		$query = $this->db->query("SELECT * FROM admins WHERE username = lower('$username') OR email = lower('$username')");
		return $query;
	}

	public function check_username_email($username, $email) {
		$query = $this->db->query("SELECT * FROM admins WHERE username = lower('$username') OR email = lower('$email')");
		return $query;
	}

	public function insert_admin($table, $data) {
		$this->db->insert($table, $data);
	}
	
}

?>