<?php
    class Pages extends CI_Controller {
		public function index() {
			$this->not_found();
		}

		public function not_found () {
			$data['page'] = "not_found";
			$data['title'] = "Fehlende Spiele";
			$this->spieldb->update_existing_ean();
			$data['not_found'] = $this->spieldb->get_not_found();
			$this->render($data);
		}

		public function zugriff () {
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
			
			if($this->input->post('ean')){
				//form was sent
			
				
				$insert['ean'] = $this->input->post('ean');
				$insert['titel'] = $this->input->post('titel');
				$insert['verlag'] = $this->input->post('verlag');
				$insert['illustration'] = $this->input->post('illustration');
				$insert['alter'] = $this->input->post('alter');
				$insert['alter_bis'] = $this->input->post('alter_bis');
				$insert['spieldauer'] = $this->input->post('spieldauer');
				$insert['herkunft_id'] = $this->input->post('herkunft_id');
				$insert['externe_id'] = $this->input->post('externe_id');
				$insert['zielgruppe'] = $this->input->post('zielgruppe');
				$insert['sprache_regeln'] = $this->input->post('sprache_regeln');
				$insert['level'] = ($this->input->post('level')=="")?NULL:$this->input->post('level');
				$insert['text_im_spiel'] = ($this->input->post('text_im_spiel')=="")?NULL:$this->input->post('text_im_spiel');
				$insert['artikelnr_verlag'] = ($this->input->post('artikelnr_verlag')=="")?NULL:$this->input->post('artikelnr_verlag');
				
				$this->db->insert('db_spiel', $insert);
				
				$this->session->set_flashdata('msg', 'Spiel '.$this->input->post('ean').' wurde hinzugefügt.');
				
				//list not found toys
				redirect('pages/not_found');
			} else {
				$data['page'] = "add_spiel";
				$data['title'] = "Spiel erfassen";
				$data['ean'] = $ean;
				$data['level'] = $this->spieldb->get_level();
				$data['zielgruppe'] = $this->spieldb->get_zielgruppe();
				$data['herkunft'] = $this->spieldb->get_herkunft();

				$this->render($data);
			}
		}

		public function get_json($type) {
			$term = $this->input->get('term');
			switch ($type){
				case 'verlag';
					$data = $this->select2->get_verlage($term);
					break;
				case 'azspieler';
					$data = $this->select2->get_azspieler($term);
					break;
				case 'spieldauer';
					$data = $this->select2->get_spieldauer($term);
					break;
			}

			$json =  json_encode(["results" => $data]);

			echo $json;
		}

		private function render($data){
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$data['page'].'.php', $data);
			$this->load->view('templates/footer', $data);
		}

	}