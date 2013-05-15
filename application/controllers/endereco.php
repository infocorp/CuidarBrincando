<?php
class Endereco extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('endereco_model');
        $this->load->helper('url_helper');
        $this->load->library(array('form_validation', 'session'));
        $this->form_validation->set_rules('endereco', 'Endereço', 'required|max_length[255]');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required|max_length[50]');
        $this->form_validation->set_rules('estado', 'Estado', 'required|max_length[20]');
        $this->form_validation->set_rules('pais', 'País', 'required|max_length[30]');
        
    }
    
    public function index()
    {
        $this->load->view('endereco_view');
    }
    
    public function cadastrar()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->endereco_model->save(array(
                    $this->input->post('endereco'),
                    $this->input->post('cidade'),                    
                    $this->input->post('estado'),                    
                    $this->input->post('pais'),                    
                ));   
                
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('endereco_view');
        }
    }
    
    public function atualizar($id) 
    {
        try {
            $endereco = $this->endereco_model->listadress($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->endereco_model->update($id, array(
                        $this->input->post('endereco'),
                        $this->input->post('cidade'),
                        $this->input->post('estado'),
                        $this->input->post('pais'),
                    ));
                    $this->session->set_flashdata('feedback', 'Cadastro de endereço atualizado com sucesso!');
                } else {
                    $this->load->view('endereco_view', array(
                        'endereco' => $endereco,
                    ));
                }
            } else {
                $this->load->view('endereco_view', array(
                    'endereco' => $endereco,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function mostra($id)
    {
        try {
            $endereco = $this->endereco_model->listadress($id);
            $this->load->view('endereco_view', array(
                'endereco' => $endereco,
            ));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
            
}