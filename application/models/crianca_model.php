<?php
class Crianca_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function save()
    {
         $sql = '
            INSERT INTO
                crinca (
                    escola, serie, dataInternacao, dataAlta, composicaoFamiliar, diagnostico, atividades
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?
                )
        ';
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Cadastro da criança não efetuado!');
    }
    
    /**
     * busca dados da criança
     * 
     * @param type $id
     * @return object professor
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                 escola, serie, dataInternacao, dataAlta, composicaoFamiliar, diagnostico, atividades
            FROM
                crianca
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Dados da criança não encontrado!');
        }
    }
    
    public function updateCrianca($id, array $dados)
    {
        $sql= '
            UPDATE
                crianca
            SET
                escola = ?, 
                serie = ?, 
                dataAlta = ?, 
                dataInternacao = ?, 
                composicaoFamiliar = ?, 
                diagnostico = ?, 
                atividades = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
    }
    
    public function deleteCrianca($id)
    {
        $sql = '
            DELETE FROM crianca WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar criança!');
    }
}