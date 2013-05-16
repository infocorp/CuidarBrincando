<?php
class Professor_Model extends CI_Model
{
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
    
    /**
     * Retorna lista de pessoas cadastradas
     * 
     * @return object todas as pessoas cadastradas
     * @throws RuntimeException
     */
    public function listname()
    {
        $sql= '
            SELECT
                id, nome
            FROM
                pessoa
        ';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Não existem pessoas cadastradas.');
        }
    }
    
    /**
     * busca pessoa por id
     * 
     * @param type $id
     * @return query_row
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                id, nome 
            FROM
                pessoa
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Pessoa não encontrada!');
        }
        
    }
    
    
}
