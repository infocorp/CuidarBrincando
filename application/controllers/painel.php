<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends CI_Controller {

    public function index()
    {
        $this->load->view('header_menu');
        //$this->load->view('');
        $this->load->view('footer');
    }

    public function responsavel()
    {
        try {
            $this->load->model('responsavel_model');
            $this->load->view('header_menu');
            $this->load->view('painel_responsavel_view', array(
                'responsaveis' => $this->responsavel_model->getAll(),
            ));
            $this->load->view('footer');
        } catch (Exception $e) {
            
        }
    }
}