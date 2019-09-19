<?php
    class Pages extends CI_Controller {
		public function index() {
			$data['page'] = "genres";
			$data['title'] = "Genres";

			$data['genres'] = $this->spieldb->get_genres();
			$this->render($data);
		}

		public function genre($id) {
			$data['id'] = $id;
			$data['page'] = "genre";
			$data['title'] = "Genre";

			$data['genre'] = $this->spieldb->get_genre($id);

			$this->render($data);
		}

		public function delete($id) {
			$this->spieldb->del_genre($id);
			redirect(site_url('/pages/index'), 'location', 301);
		}

		public function herkunft() {
			$data['page'] = "herkunft";
			$data['title'] = "Herkunft";

			$data['herkunft'] = $this->spieldb->get_herkunft();
			$this->render($data);
		}


		private function render($data){
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$data['page'].'.php', $data);
			$this->load->view('templates/footer', $data);
		}

	}
