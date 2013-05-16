<?php
class Educador extends CI_Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('educador_model');
        $this->load->model('pessoa_model');
        $this->load->model('endereco_model');
        $this->load->library(array('form_validation', 'session'));
        $this->form_validation->set_rules('curso', 'Curso', 'required|max_length[50]');
        $this->form_validation->set_rules('semestreEntrada', 'Semestre de Entrada', 'required|max_length[6]');
        $this->form_validation->set_rules('rga', 'RGA', 'required|max_length[15]');
        $this->form_validation->set_rules('renda', 'Renda', 'required|max_length[30]');
        $this->form_validation->set_rules('curriculo', 'Curriculo', 'required');//Quando não é requerido, mas é do tipo text, o que fazer com max_length?
        $this->form_validation->set_rules('bolsista', 'Bolsista', 'required|max_length[4]');
        
        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
        
    }
    
    public function cadastrarEducador()
    {
        
        if ($this->form_validation->run() === true) {
            try {
                $this->educador_model->saveEducador(array(
                    $this->input->post('curso'),
                    $this->input->post('semestreEntrada'),
                    $this->input->post('rga'),
                    $this->input->post('renda'),
                    $this->input->post('curriculo'),
                    $this->input->post('bolsista'),
                    $this->input->post('tipoBolsa'),                    
                ));
                
                $this->session->set_flashdata('message', 'Cadastro efetuado com sucesso.');
                redirect('educador');
            } catch (Exception $e) {
                    $this->session->set_flashdata('message', $e->getMessage());
            }
        } else {
            $this->load->view('educador_view');
        }
                
    }
    
    public function mostrarEducador($id)
    {
        try {
            $educador = $this->educador_model->getById($id);
            $this->load->view('educador_view', array(
                'educador' => $educador
            ));            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function atualizarEducador($id)
    {
        try {
            $educador = $this->educador_model->getById($id);
            if ($this->input->post()) {
                if ($this->form_validation->run() === true) {
                    $this->educador_model->update($id, array(
                        $this->input->post('curso'),
                        $this->input->post('semestreEntrada'),
                        $this->input->post('rga'),
                        $this->input->post('renda'),
                        $this->input->post('curriculo'),
                        $this->input->post('bolsista'),
                        $this->input->post('tipoBolsa'),
                    ));
                    $this->session->set_flashdata('feedback', 'Dados de Educador atualizados com sucesso!');
                } else {
                    $this->load->view('educador_view', array(
                        'educador' => $educador,
                    ));
                }
            } else {
                $this->load->view('educador_view', array(
                    'educador' => $educador,
                ));
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function apagarEducador($id)
    {
        try {
            $this->educador_model->delete($id);
            $this->session->set_flashdata('feedback', 'Dados de educador excluídos com sucesso!');
        } catch (Exception $e){ 
            $this->session->set_flashdata('feedback', $e->getMessage());
        }
    }
    
    public function validaBolsista($bolsista)
    {
        if ($bolsista == 'S' || $bolsista == 'N'){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}