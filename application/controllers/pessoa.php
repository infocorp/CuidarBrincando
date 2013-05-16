<?php
class Pessoa extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('pessoa_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[255]');
        $this->form_validation->set_rules('dataNascimento', 'Data de Nascimento', 'required|max_length[10]');
        $this->form_validation->set_rules('cpf', 'CPF', 'max_length[15]');
        $this->form_validation->set_rules('identidade', 'Identidade', 'max_length[15]');
        $this->form_validation->set_rules('tituloEleitor', 'Titulo de Eleitor', 'max_length[15]');
        $this->form_validation->set_rules('apelido', 'Apelido', 'max_length[50]');
        $this->form_validation->set_rules('foto', 'Foto', 'max_length[45]');//Arrumar o tamanho no banco
        $this->form_validation->set_rules('sexo', 'Sexo', 'validaSexo');
        $this->form_validation->set_rules('cor', 'Cor', 'validaCor');
        $this->form_validation->set_rules('escolaridade', 'validaEscolaridade');
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
        
    }
    public function cadastrarPessoa()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->cliente_model->savePessoa(array(
                    $this->input->post('nome'),
                    $this->input->post('telefone'),
                    $this->input->post('apelido'),
                    $this->input->post('dataNascimento'),
                    $this->input->post('sexo'),
                    $this->input->post('cor'),
                    $this->input->post('escolaridade'),
                    $this->input->post('foto'),
                    $this->input->post('identidade'),
                    $this->input->post('cpf'),
                    $this->input->post('tituloEleitor'),
                ));   
                
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('pessoa_view');
        }
    }
    
    public function mostrarTodasPessoas()
    {
        try {
            $pessoa = $this->pessoa_model->listAll();
            $this->load->view('pessoa_view', array(
                'pessoa' => $pessoa,
            ));

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function mostrarPessoa($id)
    {
        try {
            $pessoa = $this->pessoa_model->getById($id);
            $this->load->view('pessoa_view', array(
                'pessoa' => $pessoa
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function atualizarPessoa($id)
    {
        try {
            $pessoa = $this->pessoa_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->pessoa_model->updatePessoa($id, array(
                        $this->input->post('nome'),
                        $this->input->post('telefone'),
                        $this->input->post('apelido'),
                        $this->input->post('dataNascimento'),
                        $this->input->post('cor'),
                        $this->input->post('sexo'),
                        $this->input->post('escolaridade'),
                        $this->input->post('identidade'),
                        $this->input->post('cpf'),
                        $this->input->post('foto'),
                        $this->input->post('tituloEleitor'),
                    ));
                    $this->session->set_flashdata('feedback', 'Cadastro atualizado com sucesso!');
                } else {
                    $this->load->view('pessoa_view', array(
                        'pessoa' => $pessoa,
                    ));
                }
            } else {
                $this->load->view('pessoa_view', array(
                    'pessoa' => $pessoa,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarPessoa($id)
    {
         try {
            $this->pessoa_model->deletePessoa($id);
            $this->session->set_flashdata('feedback', 'Pessoa excluida com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }

    public function validaSexo($sexo)
    {
        if ($sexo == 'M' || $sexo == 'F' || $sexo == 'I'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function validaCor($cor)
    {
        if ($cor == 'PR' || $cor == 'PA' || $cor == 'AM' || $cor == 'BR'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function validaEscolaridade($esc)
    {
        if ($esc == 'N' || $esc == 'FI' || $esc == 'F' || $esc == 'MI' || $esc == 'M' || $esc == 'SI' || $esc == 'S'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
}