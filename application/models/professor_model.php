<?php
class Professor_Model extends CI_Model
{
    /**
     * Cadastra os dados do professor
     * 
     * @param array $info
     * @return boolean
     * @throws RuntimeException
     */
    public function save(array $info)
    {
        $sql = '
            INSERT INTO
                professor (
                    graduacao, mestrado, doutorado, phd
                ) VALUES (
                    ?, ?, ?, ?
                )
        ';
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Cadastro dos dados de professor não efetuado!');
    }
    
    /**
     * busca dados de professor sem pessoa e endereço
     * 
     * @param type $id
     * @return object professor
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                graduacao, mestrado, doutorado, phd 
            FROM
                professor
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Dados de professor não encontrado!');
        }
        
    }
    
    /**
     * Atualiza dados do professor
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
     public function updateProfessor($id, array $dados)
    {
        $sql= '
            UPDATE
                professor
            SET
                mestrado = ?,
                phd = ?,
                graduacao = ?,
                doutorado = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Dados não atualizados!');
    }
    
    /**
     * Apaga os dados do professor
     * 
     * @param type $id
     * @return boolean
     * @throws RuntimeException
     */
    public function deletePessoa($id)
    {
        $sql = '
            DELETE FROM professor WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar professor!');
    }
    
}
