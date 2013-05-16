<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends CI_Controller {

    public function index()
    {
        $this->load->view('header_menu');
        //$this->load->view('');
        $this->load->view('footer');
    }

}