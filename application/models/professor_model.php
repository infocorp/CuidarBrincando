<?php
class Professor_Model extends CI_Model
{
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
     * @return query_row
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
    
    
}
