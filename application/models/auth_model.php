<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Model extends CI_Model 
{
    /**
     * Verifica se existe usuário cadastrado no banco de dados
     * 
     * @param  User $user
     * @return QueryRow
     * @throws InvalidArgumentException
     */
    public function verificaLogin(User $user)
    {
        $query = $this->db->query('
            SELECT 
                id,
                email,
                tipo
            FROM 
                user 
            WHERE 
                email = ?
            AND 
                senha = ?
        ', array($user->getEmail(), $user->getPassword()));

        if ($query->num_rows() != 1) {
            throw new InvalidArgumentException('Email ou Senha inválidos');
        }

        return $query->row();
    }
}