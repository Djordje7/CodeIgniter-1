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
				$data['spiel']['ean'] = $this->input->post('ean');
				$data['spiel']['titel'] = $this->input->post('titel');
				$data['spiel']['verlag'] = $this->input->post('verlag');
				$data['spiel']['illustration'] = $this->input->post('illustration');
				$data['spiel']['alter'] = $this->input->post('alter');
				$data['spiel']['alter_bis'] = $this->input->post('alter_bis');
				$data['spiel']['spieldauer'] = $this->input->post('spieldauer');
				$this->spieldb->add_spiel($data['spiel']);

				$this->session->set_flashdata('msg', 'Spiel '.$this->input->post('ean').' wurde hinzugefügt.');

				//list not found toys
				redirect('pages/not_found');
			} else {
				$data['page'] = "add_spiel";
				$data['title'] = "Spiel erfassen";
				$data['ean'] = $ean;

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
