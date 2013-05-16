<?php
class Crianca extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('crianca_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('escola', 'Escola', 'max_length[50]');
        $this->form_validation->set_rules('serie', 'Série', 'max_length[45]');
        $this->form_validation->set_rules('diagnostico', 'Diagnóstico', 'required|max_length[50]');
        //$this->form_validation->set_rules('composicaoFamiliar', 'Composição Familiar', 'max_length[50]');
         $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
    
     public function index()
    {
        $this->load->view('crianca_view');
    }
    
    public function cadastrar()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->crianca_model->save(array(
                    $this->input->post('serie'),
                    $this->input->post('escola'),
                    $this->input->post('diagnostico'),
                    $this->input->post('composicaoFamiliar'),
                    $this->input->post('dataInternacao'),
                    $this->input->post('dataAlta'),
                    $this->input->post('atividades'),
                ));   
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('crianca_view');
        }
    }
    
    public function mostrarCrianca($id)
    {
        try {
            $professor = $this->crianca_model->getById($id);
            $this->load->view('crianca_view', array(
                'crianca' => $crianca
            ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    public function atualizarCrianca($id)
    {
        try {
            $crianca = $this->crianca_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->crianca_model->updateCrianca($id, array(
                        $this->input->post('serie'),
                        $this->input->post('escola'),
                        $this->input->post('diagnostico'),
                        $this->input->post('composicaoFamiliar'),
                        $this->input->post('dataAlta'),
                        $this->input->post('dataInternacao'),
                        $this->input->post('atividades'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados atualizados com sucesso!');
                } else {
                    $this->load->view('crianca_view', array(
                        'crianca' => $crianca,
                    ));
                }
            } else {
                $this->load->view('crianca_view', array(
                    'crianca' => $crianca,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarCrianca($id)
    {
         try {
            $this->crianca_model->deleteCrianca($id);
            $this->session->set_flashdata('feedback', 'Criança excluida com sucesso!');
        } catch (Exception $e) {
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
}