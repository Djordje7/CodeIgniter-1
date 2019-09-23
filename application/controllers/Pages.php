<?php
    class Pages extends CI_Controller {
		public function index() {
			$this->not_found();
		}

		public function not_found () {
			$data['page'] = "not_found";
			$data['title'] = "not_found";
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
		private function render($data){
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$data['page'].'.php', $data);
			$this->load->view('templates/footer', $data);
		}
	}
