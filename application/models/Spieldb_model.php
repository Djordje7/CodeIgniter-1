<?php

class Spieldb_model extends CI_Model {

	public function get_genres() {
		$query = $this->db->get('db_genre');
		return $query->result();
	}

	public function get_genre($id) {
		$query = $this->db->get_where('db_genre', array('id' => $id));
		return $query->row();
	}

	public function del_genre($id) {
		$this->db->where('id', $id);
		$this->db->delete('db_genre');
	}

	public function get_herkunft() {
		$query = $this->db->get('db_herkunft');
		return $query->result();
	}

}
