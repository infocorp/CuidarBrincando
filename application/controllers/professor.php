<?php
class Professor extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('professor_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|max_length[50]');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
        
    }
    
    public function index()
    {
        $this->load->view('professor_view');
    }
    
    public function cadastrar()
    {
        
        if ($this->form_validation->run() === true) {
            try {
                $this->cliente_model->save(array(
                    $this->input->post('nome'),
                    $this->input->post('telefone'),
                    $this->input->post('email'),
                    $this->input->post('apelido'),
                    $this->input->post('dataNascimento'),
                    $this->input->post('sexo'),
                    $this->input->post('cor'),
                    $this->input->post('escolaridade'),
                    $this->input->post('foto'),
                    $this->input->post('endereco_id'),//verificar
                    $this->input->post('graduacao'),
                    $this->input->post('mestrado'),
                    $this->input->post('doutorado'),
                    $this->input->post('phd'),
                    $this->input->post('pessoa_id'),//verificar
                    $this->input->post('senha'),
                ));   
                
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
                redirect('professor'); 
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('cliente_view');
        }
    }
    
}