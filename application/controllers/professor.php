<?php
class Professor extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('professor_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mestrado', 'Mestrado', 'required|max_length[50]');
        $this->form_validation->set_rules('graduacao', 'Graduação', 'required|max_length[100]');
        $this->form_validation->set_rules('doutorado', 'Doutorado', 'required|max_length[100]');
        $this->form_validation->set_rules('phd', 'PhD', 'required|max_length[100]');
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
                    $this->input->post('graduacao'),
                    $this->input->post('mestrado'),
                    $this->input->post('doutorado'),
                    $this->input->post('phd'),
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