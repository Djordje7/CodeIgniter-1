<?php

class Spieldb_model extends CI_Model {

	public function get_not_found() {
		$query = $this->db->query('SELECT ean, COUNT(ean) AS Anzahl
									FROM db_not_found
									GROUP BY ean
									ORDER BY Anzahl DESC;');
		return $query->result();
	}

	public function update_existing_ean() {
		$this->db->query('UPDATE db_not_found 
									LEFT JOIN db_spiel USING(ean) 
									SET existiert_seit=erstellt_am 
									WHERE NOT ISNULL(db_spiel.id);');
	}

}
