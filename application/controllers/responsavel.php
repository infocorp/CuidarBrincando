<?php

class Responsavel extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model(array(
            'responsavel_model',
            'pessoa_model',
            'endereco_model',
        ));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ajudaFamilia', 'Ajuda Familiar', 'required|ValidaAjudaFamilia');
        $this->form_validation->set_rules('renda', 'Renda', 'max_length[20]');
        $this->form_validation->set_rules('beneficios', 'Beneficios', 'validaBeneficios');
        $this->form_validation->set_rules('email', 'e-mail', 'max_lenght[45]');
    }

    public function index()
    {
        try {
            $this->load->model('responsavel_model');
            $this->load->view('header_menu');
            $this->load->view('painel_responsavel_view', array(
                'responsaveis' => $this->responsavel_model->getAll(),
            ));
            $this->load->view('footer');
        } catch (Exception $e) {
            $this->load->view('painel_responsavel_view', array(
                'erro' => $e->getMessage(),
            ));
        }
    }

    public function show($id)
    {
        try {
            $this->load->view('header_menu');
            $this->load->view('show_responsavel_view', array(
                'responsavel' => $this->responsavel_model->getById($id),
            ));
            $this->load->view('footer');
        } catch (Exception $e) {
                         
        }
    }

    public function create()
    {
        $this->load->view('header_menu');
        $this->load->view('create_responsavel_view');
        $this->load->view('footer');
    }

    public function cadastrarResponsavel()
    {
        try {
            if ($this->form_validation->run() === true) {
                $endereco    = array(
                    $this->input->post('endereco', true),
                    $this->input->post('cidade', true),
                    $this->input->post('estado', true),
                    $this->input->post('pais', true),
                );

                // Upload de foto
                $config = array(
                    'upload_path'   => base_url().'public/fotos',
                    'allowed_types' => 'gif|jpeg|png',
                    'max_size'      => '100',
                    'max_width'     => '1920',
                    'max_height'    => '1080',
                );
                $this->load->library('upload', $config);

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
                $responsavel = array(
                    $this->input->post('ajudaFamilia'),
                    $this->input->post('renda'),
                    $this->input->post('beneficios'),
                    $this->input->post('situacaoPsicologica'),
                    $this->input->post('email'),
                );

                $idEndereco = $this->endereco_model->save($endereco);
                $idPessoa   = $this->pessoa_model->save($pessoa, $idEndereco);
                $this->responsavel_model->save($responsavel, $idPessoa);   
            } else {
                $this->load->view('responsavel_view');
            }

            $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
        } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
        }
    }
    
    public function mostrarResponsavel($id)
    {
        try {
            $responsavel = $this->responsavel_model->getById($id);
            $this->load->view('responsavel_view', array(
                'responsavel' => $responsavel
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function atualizarResponsavel($id)
    {
        try {
            $responsavel = $this->responsavel_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->responsavel_model->update($id, array(
                        $this->input->post('ajudaFamilia'),
                        $this->input->post('renda'),
                        $this->input->post('beneficios'),
                        $this->input->post('situacaoPsicologica'),
                        $this->input->post('email'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados de responsavel atualizados com sucesso!');
                } else {
                    $this->load->view('responsavel_view', array(
                        'responsavel' => $responsavel,
                    ));
                }
            } else {
                $this->load->view('responsavel_view', array(
                    'responsavel' => $responsavel,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarResponsavel($id)
    {
         try {
            $this->responsavel_model->delete($id);
            $this->session->set_flashdata('feedback', 'Dados de responsavel excluidos com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
    
    
    
    public function validaBeneficios($beneficios)
    {
        if ($beneficios == 'F' || $beneficios == 'M' || $beneficios == 'FA' || $beneficios == 'N'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function validaAjudaFamilia($ajudaFamilia)
    {
        if ($ajudaFamilia == 'S' || $ajudaFamilia == 'A' || $ajudaFamilia == 'N'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}