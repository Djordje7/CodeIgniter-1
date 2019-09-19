<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		echo "index";
	}

	public function hi()
	{
        $test = $this->uri->segment(3, 0);
        $this->load->view('welcome_message', array('data'=>$test));
	}
}