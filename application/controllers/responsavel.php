<?php

class Responsavel extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('responsavel_model');
        $this->load->helper('url_helper');
        $this->load->library(array ('form_validation', 'session'));
        $this->form_validation->set_rules('ajudaFamilia', 'Ajuda Familiar', 'required|ValidaAjudaFamilia');
        $this->form_validation->set_rules('renda', 'Renda', 'max_length[20]');
        $this->form_validation->set_rules('beneficios', 'Beneficios', 'validaBeneficios');
        $this->form_validation->set_rules('email', 'e-mail', 'max_lenght[45]');
    }
    
    public function cadastrarResponsavel()
    {
        if ($this->form_validation->run() === true) {
            try {
                $this->cliente_model->save(array(
                    $this->input->post('ajudaFamilia'),
                    $this->input->post('renda'),
                    $this->input->post('beneficios'),
                    $this->input->post('situacaoPsicologica'),
                    $this->input->post('email'),
                ));   
                
                $this->session->set_flashdata('message', 'Cadastro feito com sucesso!');
           } catch (Exception $e) {
                $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('responsavel_view');
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