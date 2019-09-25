<?php

class Select2_model extends CI_Model {

	/**
	 * @return list with all verlage for select2 ajax-data
	 */
	public function get_verlage($search_term) {
		$this->db->select("verlag AS id, verlag AS `text`");
		$this->db->like("verlag", $search_term, 'after');
		$this->db->group_by('verlag');
		$query = $this->db->get('db_spiel');

		$result = $query->result();
		return $result;
	}

	/**
	 * @return list with all verlage for select2 ajax-data
	 */
	public function get_azspieler($search_term) {
		$this->db->select("azspieler AS id, azspieler AS `text`");
		$this->db->like("azspieler", $search_term, 'after');
		$this->db->group_by('azspieler');
		$query = $this->db->get('db_spiel');

		$result = $query->result();
		return $result;
	}

}
