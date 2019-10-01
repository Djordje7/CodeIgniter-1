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
				$insert['autor'] = $this->input->post('autor');
				$insert['alter'] = $this->input->post('alter');
				$insert['azspieler'] = $this->input->post('azspieler');
				$insert['jahr'] = $this->input->post('jahr');
				$insert['inhalt'] = $this->input->post('inhalt');
				$insert['gesperrt'] = ($this->input->post('gesperrt')=="1")?1:0;
				$insert['beschreibung_titel'] = $this->input->post('beschreibung_titel');
				$insert['alter_bis'] = $this->input->post('alter_bis');
				$insert['spieldauer'] = $this->input->post('spieldauer');
				$insert['externe_id'] = $this->input->post('externe_id');
				$insert['beschreibung'] = $this->input->post('beschreibung');
				$insert['sprache_regeln'] = $this->input->post('sprache_regeln');
				$insert['sprache'] = $this->input->post('sprache');
				$insert['level'] = ($this->input->post('level')=="")?NULL:$this->input->post('level');
				$insert['text_im_spiel'] = ($this->input->post('text_im_spiel')=="")?NULL:$this->input->post('text_im_spiel');
				$insert['artikelnr_verlag'] = ($this->input->post('artikelnr_verlag')=="")?NULL:$this->input->post('artikelnr_verlag');
				$insert['zielgruppe'] = ($this->input->post('zielgruppe')=="")?NULL:$this->input->post('zielgruppe');
				$insert['herkunft_id'] = ($this->input->post('herkunft_id')=="")?NULL:$this->input->post('herkunft_id');

				$this->db->insert('db_spiel', $insert);

				$last_id = $this->db->insert_id();
				$genres = $this->input->post('genres');
				foreach($genres as $id_genre){ 
					$data = ['id_spiel' => $last_id,
							 'id_genre' => $id_genre ];
					$this->db->insert('db_spiel_genre', $data); 
				}

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
				$data['genre'] = $this->spieldb->get_genre();
					
				$this->render($data);
			}
		}

		public function get_json($field) {
			$search_term = $this->input->get('term');
			$data = $this->spieldb->get_select_items($field, $search_term);		
			$json =  json_encode(["results" => $data]);

			echo $json;
		}

		private function render($data){
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$data['page'].'.php', $data);
			$this->load->view('templates/footer', $data);
		}

	}
