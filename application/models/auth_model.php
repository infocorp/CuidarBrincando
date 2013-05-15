<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Verifica se existe usuário cadastrado no banco de dados
     * 
     * @param User $user
     * @return boolean
     * @throws InvalidArgumentException
     */
    public function verificaLogin(User $user)
    {
        throw new InvalidArgumentException('Email ou Senha inválidos');
    }
}