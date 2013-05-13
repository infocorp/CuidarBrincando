<?php
class Professor_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function save(array $info)
    {
        $sql = '
            INSERT INTO 
                pessoa (
                    nome, telefone, email, apelido, dataNascimento, cor, escolaridade, sexo, foto, endereco_id 
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                );
            INSERT INTO
                professor (
                    graduacao, mestrado, doutorado, phd, pessoa_id, senha
                ) VALUES (
                    ?, ?, ?, ?, ?, ?
                )
        ';
        
        
        
        
    }
}
