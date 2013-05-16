<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller 
{

	public function index()
	{
		$this->load->library('form_validation');
		$this->load->view('header');
		$this->load->view('login_view');
		$this->load->view('footer');
	}
}