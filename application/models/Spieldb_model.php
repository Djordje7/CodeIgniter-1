<?php

class Spieldb_model extends CI_Model {

	public function get_not_found() {
		$query = $this->db->query('SELECT ean, COUNT(ean) AS anzahl
									FROM db_not_found
									WHERE ISNULL(existiert_seit)
									GROUP BY ean
									ORDER BY anzahl DESC;');
		return $query->result();
	}

	public function update_existing_ean() {
		$this->db->query('UPDATE db_not_found 
									LEFT JOIN db_spiel USING(ean) 
									SET existiert_seit=erstellt_am 
									WHERE NOT ISNULL(db_spiel.id);');
	}

	public function get_zugriff(){
		$query = $this->db->query('SELECT
									ludo AS ludothek, 
									COUNT(db_zugriff.id) AS zugriff_found
									, not_found_and_still_missing
									, not_found_but_existing_now
								FROM
									db_zugriff
									LEFT JOIN julu_lupo_ludothek ON nummer = ludo_nummer
									LEFT JOIN (SELECT COUNT(id) AS not_found_and_still_missing, ludo_nummer FROM db_not_found WHERE ISNULL(existiert_seit) GROUP BY ludo_nummer) AS t_not_found_missing  USING(ludo_nummer)
									LEFT JOIN (SELECT COUNT(id) AS not_found_but_existing_now, ludo_nummer FROM db_not_found WHERE NOT ISNULL(existiert_seit) GROUP BY ludo_nummer) AS t_not_found_existing_now  USING(ludo_nummer)
								GROUP BY ludo_nummer
								ORDER BY zugriff_found DESC;');
		return $query->result();
	}

	/**
	 * @param $spiel array with data to add
	 */
	public function add_spiel($data) {
		$this->db->insert('db_spiel', $data);
	}

	/**
	 * @return list with all grouped items for select2 ajax-data
	 */
	public function get_verlage($search_term) {
		$this->db->select("verlag AS id, verlag AS `text`");
		$this->db->like("verlag", $search_term, 'after');
		$this->db->group_by('verlag');
		$query = $this->db->get('db_spiel');

		$return = $query->result();
		return $return;
	}

	/**
	 * @return list with all grouped items for select2 ajax-data
	 */
	public function get_azspieler($search_term) {
		$this->db->select("azspieler AS id, azspieler AS `text`");
		$this->db->like("azspieler", $search_term, 'after');
		$this->db->group_by('azspieler');
		$query = $this->db->get('db_spiel');

		$return = $query->result();
		return $return;
	}

}
