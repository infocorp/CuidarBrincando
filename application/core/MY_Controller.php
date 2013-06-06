<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    public function setPessoaValidations()
    {
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[255]');
        $this->form_validation->set_rules('dataNascimento', 'Data de Nascimento', 'required|max_length[10]');
        $this->form_validation->set_rules('tituloEleitor', 'Titulo de Eleitor', 'max_length[15]');
        $this->form_validation->set_rules('apelido', 'Apelido', 'max_length[50]');
        $this->form_validation->set_rules('foto', 'Foto', 'max_length[45]');//Arrumar o tamanho no banco
        $this->form_validation->set_rules('sexo', 'Sexo', 'validaSexo');
        $this->form_validation->set_rules('cor', 'Cor', 'validaCor');
        $this->form_validation->set_rules('escolaridade', 'validaEscolaridade');

        $this->form_validation->set_message('required', 'O Campo %s é obrigatório!');
    }
}

/* End of file pessoa_controller.php */
/* Location: ./application/core/pessoa_controller.php */