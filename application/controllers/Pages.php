<?php

class Pages extends CI_Controller {
	public function index() {
		$this->not_found();
	}

	public function not_found() {
		$data['page'] = "not_found";
		$data['title'] = "Fehlende Spiele";
		$this->spieldb->update_existing_ean();
		$data['not_found'] = $this->spieldb->get_not_found();
		$this->render($data);
	}

	public function zugriff() {
		$data['page'] = "zugriff";
		$data['title'] = "Zugriff";
		$this->spieldb->update_existing_ean();
		$data['zugriff'] = $this->spieldb->get_zugriff();
		$this->render($data);
	}

	/**
	 * shows form to add toy or saves formdata and opens then list with all missing toys
	 *
	 * @param $ean to add
	 */

	public function add_spiel($ean) {

		if ($this->input->post('ean')) {
			//form was sent

			$ean = $this->input->post('ean');

			$insert['ean'] = $ean;
			$insert['titel'] = $this->input->post('titel');
			$insert['verlag'] = $this->input->post('verlag');
			$insert['illustration'] = $this->input->post('illustration');
			$insert['autor'] = $this->input->post('autor');
			$insert['alter'] = $this->input->post('alter');
			$insert['azspieler'] = $this->input->post('azspieler');
			$insert['jahr'] = $this->input->post('jahr');
			$insert['inhalt'] = $this->input->post('inhalt');
			$insert['gesperrt'] = ($this->input->post('gesperrt') == "1") ? 1 : 0;
			$insert['beschreibung_titel'] = $this->input->post('beschreibung_titel');
			$insert['alter_bis'] = $this->input->post('alter_bis');
			$insert['spieldauer'] = $this->input->post('spieldauer');
			$insert['externe_id'] = $this->input->post('externe_id');
			$insert['beschreibung'] = $this->input->post('beschreibung');
			$insert['sprache_regeln'] = $this->input->post('sprache_regeln');
			$insert['sprache'] = $this->input->post('sprache');
			$insert['level'] = ($this->input->post('level') == "") ? NULL : $this->input->post('level');
			$insert['text_im_spiel'] = ($this->input->post('text_im_spiel') == "") ? NULL : $this->input->post('text_im_spiel');
			$insert['artikelnr_verlag'] = ($this->input->post('artikelnr_verlag') == "") ? NULL : $this->input->post('artikelnr_verlag');
			$insert['zielgruppe'] = ($this->input->post('zielgruppe') == "") ? NULL : $this->input->post('zielgruppe');
			$insert['herkunft_id'] = ($this->input->post('herkunft_id') == "") ? NULL : $this->input->post('herkunft_id');

			$this->db->insert('db_spiel', $insert);

			$last_id = $this->db->insert_id();
			$genres = $this->input->post('genres');

			if ($genres != NULL) {
				foreach ($genres as $id_genre) {
					$data = ['id_spiel' => $last_id,
							 'id_genre' => $id_genre];
					$this->db->insert('db_spiel_genre', $data);
				}
			}


			$url = $this->input->post('youtube_url');
			$titel = $this->input->post('youtube_titel');
			if ($url != "") {
				$data = [
					'id_spiel'     => $last_id,
					'doc_code'     => 'youtube',
					'titel'        => $titel,
					'original_url' => $url,
				];
				$this->db->insert('db_spiel_dokument', $data);
			}


			//save manual
			$url = $this->input->post('manual_url');
			$titel = $this->input->post('manual_titel');
			if ($url != "") {
				$data = [
					'id_spiel'     => $last_id,
					'doc_code'     => 'manual',
					'titel'        => $titel,
					'dateiname'    => $ean . '.pdf',
					'original_url' => $url,
				];
				$this->db->insert('db_spiel_dokument', $data);
			}

			if ($url !== null) {
				$manual = file_get_contents($url);
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				$mimetype = $finfo->buffer($manual);

				$filename = FCPATH . 'pdf_manuals\\' . $ean . '.pdf';

				if ($mimetype == 'application/pdf') {
					file_put_contents($filename, $manual);
				} else {
					//TODO: Funktioniert nicht wenn mehrere errors auftreten
					$this->session->set_flashdata('error', "Falsches Dateiformat: <b>$mimetype</b>. Nur pdf-Files sind erlaubt.");
				}
			}


			//save image
			$url = $this->input->post('bild_link');

			if ($url !== null) {
				$image = file_get_contents($url);
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				$mimetype = $finfo->buffer($image);

				$filename = FCPATH . 'img_spiele\\' . $ean . '.jpg';

				if ($mimetype == 'image/jpeg') {
					file_put_contents($filename, $image);
				} elseif ($mimetype == 'image/png') {
					$image = imagecreatefrompng($url);
					$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
					imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
					imagealphablending($bg, TRUE);
					imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
					imagedestroy($image);
					$quality = 75;
					imagejpeg($bg, $filename, $quality);
					imagedestroy($bg);
				} else {
					//TODO: Funktioniert nicht wenn mehrere errors auftreten
					$this->session->set_flashdata('error', "Falsches Dateiformat: <b>$mimetype</b>. Nur jpeg- und png-Bilddateien sind erlaubt.");
				}
			}

			$this->session->set_flashdata('msg', 'Spiel ' . $this->input->post('ean') . ' wurde hinzugefügt.');

			//list not found toys
			redirect('pages/not_found');
		} else {
			$data['page'] = "add_spiel";
			$data['title'] = "Spiel erfassen";
			$data['ean'] = $ean;
			$data['level'] = $this->spieldb->get_level();
			$data['zielgruppe'] = $this->spieldb->get_zielgruppe();
			$data['herkunft'] = $this->spieldb->get_herkunft();
			$data['genre'] = $this->spieldb->get_genre();

			$this->render($data);
		}
	}

	public function get_json($field) {
		$search_term = $this->input->get('term');
		$data = $this->spieldb->get_select_items($field, $search_term);
		$json = json_encode(["results" => $data]);

		echo $json;
	}

	private function render($data) {
		$this->load->view('templates/header', $data);
		$this->load->view('pages/' . $data['page'] . '.php', $data);
		$this->load->view('templates/footer', $data);
	}

}
