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
                $this->professor_model->save(array(
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
    
    public function mostrarProfessor($id)
    {
        try {
            $professor = $this->professor_model->getById($id);
            $this->load->view('professor_view', array(
                'professor' => $professor
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function atualizarProfessor($id)
    {
        try {
            $professor = $this->professor_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->professor_model->updateProfessor($id, array(
                        $this->input->post('mestrado'),
                        $this->input->post('graduacao'),
                        $this->input->post('doutorado'),
                        $this->input->post('phd'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados atualizados com sucesso!');
                } else {
                    $this->load->view('professor_view', array(
                        'professor' => $professor,
                    ));
                }
            } else {
                $this->load->view('professor_view', array(
                    'professor' => $professor,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarProfessor($id)
    {
         try {
            $this->professor_model->deleteProfessor($id);
            $this->session->set_flashdata('feedback', 'Professor excluido com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
}