<?php

class Select2_model extends CI_Model {

	/**
	 * @return list with all grouped items for select2 ajax-data
	 */
	public function get_select_items($field, $search_term) {
		$this->db->select("spieldauer AS id, spieldauer AS `text`");
		$this->db->like("", $search_term, 'after');
		$this->db->order_by('spieldauer');
		$query = $this->db->get('db_spiel');

		$result = $query->result();
		return $result;
	}
	
}
