<?php
class Endereco_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Cadastra endereço de uma pessoa
     * 
     * @param array $info
     * @return boolean
     * @throws RuntimeException
     */
    public function save(array $info )
    {
        $sql = '
            INSERT INTO 
                endereco (
                    endereco, cidade, estado, pais
                ) VALUES (
                    ? , ? , ? , ? 
                )
        ';
        
        $this->db->query ($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Endereço não cadastrado!');
    }
    
    /**
     * Mostra endereço de uma pessoa
     * 
     * @param type $id
     * @return object endereco
     * @throws RuntimeException
     */
    public function listadress($id)
    {
        $sql= '
            SELECT
                endereco, cidade, estado, pais
            FROM
                pessoa
            WHERE
                id = ?
        ';
        
        $query = $this->db->query($sql, $id);
        
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('A pessoa não existe!');
        }
    }
    
    /**
     * Atualiza endereço
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function update($id, array $dados)
    {
        $sql= '
            UPDATE
                endereco
            SET
                endereco = ?,
                cidade = ?,
                estado = ?,
                pais = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Endereço não atualizado!');
    }
    
}