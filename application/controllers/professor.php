<?php
class Professor extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'professor_model',
            'pessoa_model',
            'endereco_model',
        ));
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
    
    public function cadastrarProfessor()
    {
        try {
            if ($this->form_validation->run() === true) {
                $endereco    = array(
                    $this->input->post('endereco', true),
                    $this->input->post('cidade', true),
                    $this->input->post('estado', true),
                    $this->input->post('pais', true),
                );
                $pessoa      = array(
                    $this->input->post('nome', true),
                    $this->input->post('telefone', true),
                    $this->input->post('apelido', true),
                    $this->input->post('dataNascimento', true),
                    $this->input->post('sexo', true),
                    $this->input->post('cor', true),
                    $this->input->post('escolaridade', true),
                    $this->input->post('foto', true),
                    $this->input->post('identidade', true),
                    $this->input->post('cpf', true),
                    $this->input->post('tituloEleitor', true),
                );
                $professor = array(
                    $this->input->post('graduacao', true),
                    $this->input->post('mestrado', true),
                    $this->input->post('doutorado', true),
                    $this->input->post('phd', true),
                );

                $idEndereco = $this->endereco_model->save($endereco);
                $idPessoa   = $this->pessoa_model->save($pessoa, $idEndereco);
                $this->professor_model->save($professor, $idPessoa);   
            } else {
                $this->load->view('professor_view');
            }

            $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
        } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
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
                    $this->professor_model->update($id, array(
                        $this->input->post('graduacao'),
                        $this->input->post('mestrado'),
                        $this->input->post('doutorado'),
                        $this->input->post('phd'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados de professor atualizados com sucesso!');
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